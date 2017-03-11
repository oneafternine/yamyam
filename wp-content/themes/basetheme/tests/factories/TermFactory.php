<?php

$faker = Faker\Factory::create();

return [
    'class'      => 'Substrakt\Fakes\Term',
    'attributes' => [
        'count'       => 0,
        'description' => '',
        'group'       => 0,
        'name'        => $title = $faker->sentence($nbWords = 3, $variableNbWords = true),
        'parent'      => 0,
        'slug'        => strtolower(str_replace(' ', '-', $title)),
        'taxonomy'    => 'category',
        'taxonomy_id' => 1
    ]
];
