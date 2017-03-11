<?php

# Register the a Type taxonomy for the specified post types
# http://codex.wordpress.org/Function_Reference/register_taxonomy
add_action('init', function() {
    $labels = [
        'name'                       => 'Writers', 'taxonomy general name',
        'singular_name'              => 'Writer', 'taxonomy singular name',
        'search_items'               => 'Search Writers',
        'popular_items'              => 'Popular Writers',
        'all_items'                  => 'All Writers',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Writer',
        'update_item'                => 'Update Writer',
        'add_new_item'               => 'Add New Writer',
        'new_item_name'              => 'New Writer Name',
        'separate_items_with_commas' => 'Separate writers with commas',
        'add_or_remove_items'        => 'Add or remove writers',
        'choose_from_most_used'      => 'Choose from the most used writers',
        'not_found'                  => 'No writers found.',
        'menu_name'                  => 'Writers'
    ];

    $args = [
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => ['slug' => 'writer'],
    ];

# register_taxonomy('writer', ['book'], $args );
});
