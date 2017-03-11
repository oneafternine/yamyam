<?php

add_action('init', function() {
    $labels = [
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'menu_name'          => 'Projects',
        'name_admin_bar'     => 'Projects',
        'all_items'          => 'All Projects',
        'add_new'            => 'Add Project',
        'add_new_item'       => 'Add New Project',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'New Project',
        'view_item'          => 'View Project',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No Projects found',
        'not_found_in_trash' => 'No Projects found in Trash',
        'parent_item_colon'  => 'Parent Project Page'
    ];

    $args = [
        'capability_type'     => 'page',
        'exclude_from_search' => false,
        'hierarchical'        => true,
        'label'               => 'Project',
        'labels'              => $labels,
        'menu_position'       => 5,
        'public'              => true,
        'rewrite'  => [
            'slug' => 'projects',
            'with_front' => false
        ],
        'supports' => ['title', 'editor', 'revisions', 'thumbnail', 'page-attributes', 'excerpt']
    ];

    #register_post_type('project', $args);
});
