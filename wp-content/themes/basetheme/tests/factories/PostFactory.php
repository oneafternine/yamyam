<?php

$faker = Faker\Factory::create();

return [
    'class'      => 'Substrakt\Fakes\Post',
    'attributes' => [
        'author'   => $faker->randomDigitNotNull,
        'content'  => $faker->paragraph(rand(1, 5)),
        'date'     => '0000-00-00 00:00:00',
        'date_gmt' => '0000-00-00 00:00:00',
        'excerpt'  => $faker->paragraph(rand(1, 2)),
        'parent'   => 0,
        'status'   => 'publish',
        'sticky'   => false,
        'title'    => $title = $faker->sentence($nbWords = 3, $variableNbWords = true),
        'name'     => strtolower(str_replace(' ', '-', $title)),
        'type'     => 'post'
    ]
];
