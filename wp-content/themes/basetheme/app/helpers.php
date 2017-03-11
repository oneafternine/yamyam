<?php
/**
 * ---------------------------------------
 * Helper Functions
 * ---------------------------------------
*/

/**
 * Is the current signed in user a Substrakt member
 * @return boolean
 * @author Stuart Maynes <stu@substrakt.com>
*/
if(! function_exists('is_substrakt')) {
    function is_substrakt($email = null) {
        $user = ($email !== null) ? $email : wp_get_current_user();

        if ($user) {
            $allowed = ['substrakt.co.uk', 'substrakt.com'];

            if(isset($user->user_email)) {
                $email = $user->user_email;
            }

            $domain = explode('@', $email);

            if (isset($domain[1]) && in_array($domain[1], $allowed)) {
                return true;
            }
        }

        return false;
    }
}

/**
 * Find the ID
 * Either return the ID parameter for the ID of the global post
 * @param int $ID the ID of the post to get the classes for
 * @return number
 * @author Stuart Maynes <stu@substrakt.com>
*/
if (! function_exists('ID')) {
    function ID($ID = null) {
        global $post;
        return isset($ID) ? $ID : (isset($post->ID) ? $post->ID : 0);
    }
}

/**
 * Alternative function to post_class
 * Returns a string of just the classes and not a full
 * html attribute.
 * Can be used inside or outside the loop.
 * @param array $extra optional classes to include
 * @param int $ID the ID of the post to get the classes for
 * @return string
 * @author Stuart Maynes <stu@substrakt.com>
*/
if(! function_exists('the_class')) {
    function the_class($extra = [], $ID = null) {
        $classes = get_post_class($extra, ID($ID));
        echo implode(' ', $classes);
    }
}

/**
 * Alternative function to body_class
 * Returns a string of just the classes and not a full
 * html attribute.
 * @param array $extra optional classes to include
 * @author Stuart Maynes <stu@substrakt.com>
 * @return string
*/
if(! function_exists('the_body_class')) {
    function the_body_class($extra = []) {
        global $is_IE, $post;
        $classes = get_body_class($extra);
        if (isset($post->post_name)) {
            $classes[] = $post->post_name;
        }
        if ($is_IE) $classes[] = 'IE';
        echo implode(' ', $classes);
    }
}

/**
 * Return the name of template being used
 * @param null
 * @author Stuart Maynes <stu@substrakt.com>
 * @return string
*/
if(! function_exists('what_template')) {
    function what_template() {
        global $template;
        return basename($template);
    }
}

/**
 * Display an warning to users of unsupported IE browsers
 * Pass false to remove the conditional block for testing
 * Pass an integer to set the version and below of IE not supported
 * @param integer | boolean
 * @author Stuart Maynes <stu@substrakt.com>
 * @return null
*/
if(! function_exists('the_ie_warning')) {
    function the_ie_warning($version = 8) {
        echo $version === false ? '' : "<!--[if lte IE {$version}]>\n";
            get_template_part('includes/no-support');
        echo $version === false ? '' : "<![endif]-->";
    }
}

/**
 * Output the website by Substrakt link
 * @return string
 * @author Stuart Maynes <stu@substrakt.com>
*/
if (! function_exists('by_substrakt')) {
    function by_substrakt($target = '_blank') {
        echo '<a href="//substrakt.com" target="'. $target .'">Website by Substrakt</a>';
    }
}

/**
 * Output the cookies notice
 * @return string
 * @author Stuart Maynes <stu@substrakt.com>
*/
if (! function_exists('cookies_policy')) {
    function cookies_policy() {
        echo '';
    }
}

/**
 * @param $params Array to pass to the instatiated class
 * @param $class Name of a class to create objects of
 * @return Array Of objects
 * @author Stuart Maynes <stu@substrakt.com>
*/
if (! function_exists('to_object')) {
    function to_object($params, $class) {
        if (!is_array($params)) return [];
        return array_map(function($args) use ($class) {
            return new $class($args);
        }, $params);
    }
}

/**
 * @param $property String property to access for the current term query
 * @return mixed
 * @author Stuart Maynes <stu@substrakt.com>
*/
if (! function_exists('get_query_term')) {
    function get_query_term($property = null) {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        echo isset($term->$property) ? $term->$property : $term;
    }
}

/**
 * @param $template String the name of the template to query by
 * @param $single Boolean to determine if to return one result or an array
 * @return mixed
 * @author Stuart Maynes <stu@substrakt.com>
*/
if(!function_exists('get_page_by_template')){
    function get_page_by_template($template, $single = true) {
        $query = new WP_Query(array(
            'post_type'  => 'page',
            'meta_key'   => '_wp_page_template',
            'meta_value' => "{$template}.php"
        ));

        if ($single && isset($query->posts[0])) {
            return $query->posts[0];
        }

        return $query->posts;
    }
}
