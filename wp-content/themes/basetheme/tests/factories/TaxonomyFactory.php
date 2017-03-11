<?php

$faker = Faker\Factory::create();

return [
    'class'      => 'Substrakt\Fakes\Taxonomy',
    'attributes' => [
        'labels'                => [],
        'description'           => $faker->paragraph(rand(1, 5)),
        'public'                => true,
        'public_queryable'      => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        'show_admin_column'     => true,
        'meta_box_cb'           => '',
        'rewrite' => [
            'with_front'   => true,
            'hierarchical' => true,
            'slug'         => ''
        ],
        'query_var'             => 'category_name',
        'update_count_callback' => '',
        '_builtin'              => false,
        'cap' => [
            'manage_terms' => 'manage_categories',
            'edit_terms'   => 'manage_categories',
            'delete_terms' => 'manage_categories',
            'assign_terms' => 'edit_posts'
        ],
        'name'                  => '',
        'object_type'           => '',
        'label'                 => '',
        'show_in_nav_menus'     => '',
    ]
];
