<?php
/**
 * ---------------------------------------
 * Constants
 * ---------------------------------------
*/
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('CHILD_THEME_PATH', get_stylesheet_directory());
define('CHILD_THEME_URL', get_stylesheet_directory_uri());

/**
 * ---------------------------------------
 * Includes
 * Include any PHP app files here.
 * The order is important
 * ---------------------------------------
*/
if (! defined('AUTOLOAD_INCLUDED')) {
	require_once THEME_PATH . '/autoload.php';
}

/**
 * ---------------------------------------
 * WordPress Functionality
 * ---------------------------------------
*/

/**
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_setup')) {
	function theme_setup() {
		global $content_width;
		$content_width = 600;

		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		# add_theme_support('post-thumbnails');
		add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);

		remove_action('wp_head', 'wp_generator'); // Remove the generator meta tag
		remove_action('wp_head', 'wlwmanifest_link'); // Remove support for Windows Live Writer
		remove_action('wp_head', 'rsd_link');

		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');

		# Use a human-readable representation of the image size e.g '300x200', as opposed to words like 'thumb-small' or 'hero'.
		# add_image_size($name, $width, $height, array('center', 'center'));

		# Reduces the file size of images uploaded to the media library
		// add_filter('jpeg_quality', function() { return 70; });
	}
	add_action('after_setup_theme', 'theme_setup');
}


/**
 * Add tags into the head of the site
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_add_head_data')) {
	function theme_add_head_data() {
		// Include favicon data
		// Generate your favicons with http://realfavicongenerator.net
		include THEME_PATH . '/includes/favicon.php';
	}
	add_action('wp_head', 'theme_add_head_data');
}


/**
 * Add image size to the media insert popup
 * @author Stuart Maynes
 * @return array
 * @codeCoverageIgnore
*/
if(! function_exists('theme_add_image_size_to_admin')) {
	function theme_add_image_size_to_admin($sizes) {
	    return array_merge($sizes, array(
	        'your-custom-size' => __('Custom Size Name')
	    ));
	}
	# add_filter('image_size_names_choose', 'theme_add_image_size_to_admin');
}


/**
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_enqueue_scripts')) {
	function theme_enqueue_scripts() {
		global $is_IE;

		// Deregister jQuery
    	wp_deregister_script('jquery');

		// Register jQuery via a CDN and load it into the footer #perfmatters
		wp_enqueue_script('jquery', '//code.jquery.com/jquery-2.1.3.min.js', [], '2.1.3', true);

		// Load the HTML5 Shiv JavaScript file
		if ($is_IE) wp_enqueue_script('html5-script', get_template_directory_uri() . '/assets/js/html5.js', [], '1.0.0', false);

		// Load the main JavaScript file for the theme
		wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.0', true);

	}
	add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
}


/**
 * Enqueue scripts into the admin section
 * NOT READY YET
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_enqueue_admin_scripts')) {
	function theme_enqueue_admin_scripts() {
		// Load the customizer JavaScript file
		wp_enqueue_script('customizer-script', get_template_directory_uri() . '/assets/js/customiser.js', [], '1.0.0', true);
	}
	// add_action('admin_enqueue_scripts', 'theme_enqueue_admin_scripts');
}


/**
 * Enqueue styles into the admin section
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_enqueue_styles')) {
	function theme_enqueue_styles() {
		global $is_IE;

		// Load the WordPress core stylesheet
		wp_enqueue_style('wp-core', get_stylesheet_uri());

		// Load the theme main stylesheet
		wp_enqueue_style('theme-main', get_template_directory_uri() . '/assets/css/main.css');

		// Load the theme IE stylesheet
		if ($is_IE) wp_enqueue_style('theme-ie-adjustments', get_template_directory_uri() . '/assets/css/ie.css');

	    // Comment reply script for threaded comments
	    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
	add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
}


/**
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_register_sidebar')) {
	function theme_register_sidebar() {
		register_sidebar([
			'name'          => 'Sidebar',
			'id'            => 'theme-sidebar',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<li class="widget %2$s" id="%1$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		]);
	}
	# add_action('widgets_init', 'theme_register_sidebar');
}


/**
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
*/
if(! function_exists('theme_register_nav_menus')) {
	function theme_register_nav_menus() {
		register_nav_menus([
			'header-menu' => 'Header Menu',
			'footer-menu' => 'Footer Menu'
		]);
	}
	add_action('init', 'theme_register_nav_menus');
}


/**
 * ---------------------------------------
 * Admin Functions
 * ---------------------------------------
*/

/**
 * Publish scheduled posts without cron
 * Disabling cron disables the ablibilty to scheduled posts
 * to be published in the future. This function runs through all
 * future posts and sets their status to publish if the scheduled
 * time has past.
 * @author Stuart Maynes
 * @return null
 */
if (! function_exists('publish_posts_without_cron')) {
	function publish_posts_without_cron() {
		$posts = [];
		$now = new DateTime('now', new DateTimeZone('GMT'));

		$query = new WP_Query([
			'post_type' => 'any',
			'post_status' => 'future'
		]);

		foreach ($query->posts as $post) {
			$post_date = new DateTime($post->post_date_gmt, new DateTimeZone('GMT'));
			if ($post_date->getTimestamp() <= $now->getTimestamp()) {
				$posts[] = wp_update_post(['ID' => $post->ID, 'post_status' => 'publish']);
			}
		}
	}

	if (defined('DISABLE_WP_CRON') && DISABLE_WP_CRON === true) {
		add_action('wp', 'publish_posts_without_cron');
	}
}

/**
 * Remove update notifications
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_remove_core_updates')) {
	function admin_remove_core_updates() {
		global $wp_version;
		return (object) ['last_checked'=> time(), 'version_checked' => $wp_version];
	}

	if (! is_substrakt()) {
		add_filter('pre_site_transient_update_core', 'admin_remove_core_updates');
		add_filter('pre_site_transient_update_plugins', 'admin_remove_core_updates');
		add_filter('pre_site_transient_update_themes', 'admin_remove_core_updates');
	}
}


/**
 * Remove dashboard widgets
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_remove_dashboard_widgets')) {
	function admin_remove_dashboard_widgets() {
	    global $wp_meta_boxes;
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	}
	add_action('wp_dashboard_setup', 'admin_remove_dashboard_widgets');
}

/**
 * Remove menus from the aministration sidebar
 * NOTE - menus and submenus have to be removed on
 * separate action, otherwise it breaks the whole
 * abilty to add content, what a faf!
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_remove_sidebar_menus')) {
	function admin_remove_sidebar_menus() {
		if (is_substrakt()) return true;

		$removed = admin_removed_menus();

		// The removed menus are stored in an array for later filtering
		$removed[] = remove_menu_page('edit-comments.php');
		$removed[] = remove_menu_page('plugins.php');
		$removed[] = remove_menu_page('tools.php');
		// Remove ACF
		$removed[] = remove_menu_page('edit.php?post_type=acf-field-group');

		// Pass the removed array on to a function to statically store the menus
	  	admin_removed_menus($removed);
	}

	add_action('admin_menu', 'admin_remove_sidebar_menus', 999);
}


/**
 * Remove submenus from the aministration sidebar
 * NOTE - menus and submenus have to be removed on
 * separate action, otherwise it breaks the whole
 * abilty to add content, what a faf!
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_remove_sidebar_submenus')) {
	function admin_remove_sidebar_submenus() {
		if (is_substrakt()) return true;

		$removed = admin_removed_menus();

		// The removed menus are stored in an array for later filtering
		$removed[] = remove_submenu_page('themes.php', 'widgets.php');
		$removed[] = remove_submenu_page('themes.php', 'theme-editor.php');
		$removed[] = remove_submenu_page('themes.php', 'themes.php');

		$removed[] = remove_submenu_page('options-general.php', 'options-media.php');
		$removed[] = remove_submenu_page('options-general.php', 'options-permalink.php');
		$removed[] = remove_submenu_page('options-general.php', 'options-discussion.php');
		$removed[] = remove_submenu_page('index.php', 'update-core.php');

		// Pass the removed array on to a function to statically store the menus
	  	admin_removed_menus($removed);
	}
	add_action('admin_init', 'admin_remove_sidebar_submenus');
}


/**
 * Use this action callback to help debug what
 * admin menus need to be hidden from the client
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_debug_menus')) {
	function admin_debug_menus() {
	    global $submenu, $menu;
	    if (current_user_can('manage_options')) {
	        echo '<pre>'; print_r($menu); echo '</pre>';
	        echo '<pre>'; print_r($submenu); echo '</pre>';
	    }
	}
	# add_action('admin_notices', 'admin_debug_menus');
}


/**
 * Store the removed menus in a static array variable
 * @author Stuart Maynes
 * @return array
 * @codeCoverageIgnore
 */
if (! function_exists('admin_removed_menus')) {
	function admin_removed_menus($removed = null) {
		static $menus = [];

		if ($removed !== null) {
			$menus = array_merge($menus, $removed);
		}

		return $menus;
	}
}


/**
 * Removed the edit ACF field group cog
 * If a client is set as an admin the edit cog would
 * usually be displayed to them
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_remove_acf_edit_cog')) {
	function admin_remove_acf_edit_cog() {
		if (is_substrakt()) return;
		echo '<style type="text/css">h3.hndle.ui-sortable-handle a.acf-hndle-cog { display: none; visibility: hidden }</style>';
	}
	add_action('acf/input/admin_head', 'admin_remove_acf_edit_cog');
}


/**
 * Display an error page if the current user is restricted access
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_user_can_see_screen')) {
    function admin_user_can_see_screen($screen) {
        $removed = admin_removed_menus();

        if (! is_array($removed) || empty($removed)) return true;

        foreach ($removed as $key => $menu) {
            if ($screen->base . '.php?post_type=' . $screen->post_type === $menu[2] || $screen->base . '.php' === $menu[2]) {
                wp_die('You don\'t have access to this page.');
            }
        }
    }
    add_action('current_screen', 'admin_user_can_see_screen');
}


/**
 * Rename Posts menu item to Blog
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_rename_posts_to_blog')) {
	function admin_rename_posts_to_blog() {
		global $menu;
		$menu[5][0] = 'Blog';
	}
	#add_filter('admin_menu', 'admin_rename_posts_to_blog');
}


/**
 * Reorder the admin menu to suit
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if (! function_exists('admin_custom_menu_order')) {
	function admin_custom_menu_order($menu) {
	    if (! $menu) return true;

	    return [
	        'index.php', // Dashboard
	        'separator1', // First separator
	        'edit.php', // Posts
	        'edit.php?post_type=page', // Pages
	        'upload.php', // Media
	        'separator2', // Second separator
	        'edit-comments.php', // Comments
	        'themes.php', // Appearance
	        'plugins.php', // Plugins
	        'users.php', // Users
	        'tools.php', // Tools
	        'options-general.php', // Settings
	        'separator-last', // Last separator
	    ];
	}
	# add_filter('custom_menu_order', 'admin_custom_menu_order');
	# add_filter('menu_order', 'admin_custom_menu_order');
}


/**
 * Hide the WordPress menu in the top left corner
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if(! function_exists('admin_remove_wordpress_menu')) {
	function admin_remove_wordpress_menu() {
	   echo '<style type="text/css">#wp-admin-bar-wp-logo { display: none; }</style>';
	}
	add_action('admin_head', 'admin_remove_wordpress_menu');
}


/**
 * Change the WordPress logo above the login box
 * By default we use the Substrakt logo
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if(! function_exists('admin_login_logo')) {
	function admin_login_logo() {
	    echo '<style type="text/css"> .login h1 a {
	    	background-image: url('. get_bloginfo('template_directory') .'/assets/images/substrakt-logo.png);
	    	background-size: 220px;
	    	height: 45px;
	    	width: 220px;
	    } </style>';
	}
	add_action('login_head', 'admin_login_logo');
}


/**
 * Change the logo link from wordpress.org to substrakt.co.uk
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if(! function_exists('admin_login_url')) {
	function admin_login_url() {
		return '//substrakt.com';
	}
	add_filter('login_headerurl', 'admin_login_url');
}


/**
 * Change the alt text on the logo to Substrakt
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if(! function_exists('admin_login_title')) {
	function admin_login_title() {
		return 'Substrakt';
	}
	add_filter('login_headertitle', 'admin_login_title');
}


/**
 * Change the admin footer message
 * @author Stuart Maynes
 * @return null
 * @codeCoverageIgnore
 */
if(! function_exists('admin_change_footer_admin')) {
	function admin_change_footer_admin () {
	    echo 'Developed by <a href="//substrakt.com" target="_blank">Substrakt</a>';
	}
	add_filter('admin_footer_text', 'admin_change_footer_admin');
}
