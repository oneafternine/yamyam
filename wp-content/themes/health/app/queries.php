<?php
$queries = [];

/**
 * @author Tom Cash <tom@substrakt.com
 */
function get_query($key) {
   global $queries;

   if (isset($queries[$key])) {
       $queries[$key]->current = max(1, get_query_var('paged'));
       return $queries[$key];
   }

   return [];
}

/**
 * @param array WP_Query arguments (Not currently utilized)
 * @return array News items fitting the criteria
 * @author Tom Cash <tom@substrakt.com
 */
function get_news($params = []) {
    global $queries, $wp_query;

    $query = new WP_Query(array_merge($params, [
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'paged'          => get_query_var('page')
    ]));

    // Store this query in our queries global array.
    $queries['news'] = $query;

    return to_object($query->posts, '\Substrakt\Health\Post');
}

/**
 * @param array $params An array of arguments that can be used to configure the custom pagination.
 * @return string $html Build and return custom next and previous links.
 * @author Stu Maynes <stu@substrakt.com>
 * @author Tom Cash <tom@substrakt.com>
 */
function pagination($params = []) {
    $query        = isset($params['query']) ? $params['query'] : 'news';
    $slug         = isset($params['slug']) ? $params['slug'] : 'slug';
    $next_label   = isset($params['next_label']) ? $params['next_label'] : 'Next';
    $next_classes = isset($params['next_classes']) ? $params['next_classes'] : '';
    $prev_label   = isset($params['prev_label']) ? $params['prev_label'] : 'Previous';
    $prev_classes = isset($params['prev_classes']) ? $params['prev_classes'] : '';

    $query = get_query($query);

    $total_posts    = $query->found_posts;
    $posts_per_page = $query->query['posts_per_page'];
    $current        = max(1, $query->query['paged']);

    if ($current == 1 && $total_posts <= $posts_per_page) {
        $html = '';
    } elseif ($current == 1 && $total_posts > $posts_per_page) {
        $html = pagination_link([
            'slug'    => $slug,
            'page'    => 2,
            'label'   => $next_label,
            'classes' => $next_classes
        ]);
    } else {
        $html = pagination_link([
            'slug'    => $slug,
            'page'    => $current - 1,
            'label'   => $prev_label,
            'classes' => $prev_classes
        ]);

        if (($current * $posts_per_page) < $total_posts) {
            $html .= pagination_link([
                'slug'    => $slug,
                'page'    => $current + 1,
                'label'   => $next_label,
                'classes' => $next_classes
            ]);
        }
    }

   return $html;
}

/**
 * @param array $params An array of arguments that can be used to configure the A tag.
 * @return string A single custom A tag for pagination links.
 * @author Stu Maynes <stu@substrakt.com>
 * @author Tom Cash <tom@substrakt.com>
 */
function pagination_link($params) {
    $slug    = isset($params['slug']) ? $params['slug'] : 'slug';
    $page    = isset($params['page']) ? $params['page'] : 1;
    $label   = isset($params['label']) ? $params['label'] : 'Label';
    $classes = isset($params['classes']) ? ' class="' . $params['classes'] . '"' : '';

    return '<a href="/' . $slug . '/'. $page .'/"' . $classes . '>'. $label .'</a>';
}
