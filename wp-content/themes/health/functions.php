<?php
require_once get_template_directory() . '/autoload.php';

/**
 * Enqueue page CSS and JS.
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('enqueue_scripts')) {
    function enqueue_scripts() {
        global $is_IE;

        // CSS
        wp_enqueue_style('main-css', CHILD_THEME_URL . '/assets/css/main.css', [], uniqid(), 'all');
        //wp_enqueue_style('owl-carousel-css', CHILD_THEME_URL . '/assets/css/owl.carousel.css', [], uniqid(), 'all');

        // JS
        // wp_enqueue_script('owl-carousel-js', CHILD_THEME_URL . '/assets/js/owl.carousel.min.js', ['jquery'], '1.3.3', true);
        wp_enqueue_script('main-js', CHILD_THEME_URL . '/assets/js/main.js', ['jquery'], '1.0,0', true);
        wp_enqueue_script('respond', CHILD_THEME_URL . '/assets/bower_components/respondJs/src/respond.js', [], '1.4.0', true);
        wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/810080efec.js', [], '', true);
        wp_enqueue_script('fonts', 'https://fast.fonts.net/jsapi/7908de59-bc35-4f9f-9acd-a619cb483e7e.js', [], '', true);
    }

    add_action('wp_enqueue_scripts', 'enqueue_scripts');
}

/**
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('image_setup')) {
    function image_setup() {
        add_theme_support('post-thumbnails');
        add_image_size('800x480', 800, 480, array('center', 'center', 'true')); // News index page thumbnails - cropped
        add_image_size('1800x900', 1800, 900, false); // Single page hero images - max sizes rather than cropped
        add_image_size('1000x1000', 1000, 1000, false); // Images within a single page - max sizes rather than cropped

    }

    add_action('after_setup_theme', 'image_setup');
}

/**
 * Add image size to the media insert popup
 * @author Stuart Maynes
 * @return array
 * @codeCoverageIgnore
*/
if (! function_exists('theme_add_image_size_to_admin')) {
	function theme_add_image_size_to_admin($sizes) {
	    return array_merge($sizes, [
	        '800x480' => __('News Post')
	    ]);
	}
	add_filter('image_size_names_choose', 'theme_add_image_size_to_admin');
}

/**
 * Load our custom formats select box.
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('custom_formats_select')) {
    function custom_formats_select($buttons) {
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }

    add_filter('mce_buttons_2', 'custom_formats_select');
}

/**
 * Add our custom formats to our previously initialised select box.
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('custom_mce_formats')) {
    function custom_mce_formats($init) {
        $formats = [
            [
                // Intro text for paragraphs. Currently only used on the home page.
                'title' => 'Intro Paragraph',
                'block' => 'p',
                'classes' => 'intro',
                'wrapper' => false,
            ]
        ];

        $init['style_formats'] = json_encode($formats);
        return $init;
    }

    add_filter('tiny_mce_before_init', 'custom_mce_formats');
}

/**
 * Rename the post label to news.
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('change_post_label')) {
    function change_post_label() {
        global $menu, $submenu;

        $menu[5][0] = 'News';
        $submenu['edit.php'][5][0]  = 'News';
        $submenu['edit.php'][10][0] = 'Add News';
        $submenu['edit.php'][16][0] = 'News Tags';
    }

    add_action( 'admin_menu', 'change_post_label' );
}


/**
 * Rename the post object to news.
 * @return null
 * @author Tom Cash <tom@substrakt.com>
 */
if (! function_exists('change_post_object')) {
    function change_post_object() {
        global $wp_post_types;

        $labels = $wp_post_types['post']->labels;

        $labels->name           = 'News';
        $labels->singular_name  = 'News';
        $labels->add_new        = 'Add News';
        $labels->add_new_item   = 'Add News';
        $labels->edit_item      = 'Edit News';
        $labels->new_item       = 'News';
        $labels->view_item      = 'View News';
        $labels->search_items   = 'Search News';
        $labels->not_found      = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
        $labels->all_items      = 'All News';
        $labels->menu_name      = 'News';
        $labels->name_admin_bar = 'News';
    }

    add_action( 'init', 'change_post_object' );
}

/**
 * Add tags into the head of the site.
*/
if(! function_exists('theme_add_head_data')) {
    function theme_add_head_data() {
    	include THEMES_PATH . '/health/includes/favicon.php';
    }
    add_action('wp_head', 'theme_add_head_data');
}
