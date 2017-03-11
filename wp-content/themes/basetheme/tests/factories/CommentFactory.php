<?php

$faker = Faker\Factory::create();

return [
    'class'      => 'Substrakt\Fakes\Comment',
    'attributes' => [
        'agent'        => $faker->userAgent,
        'approved'     => true,
        'author'       => $faker->name,
        'author_IP'    => $faker->ipv4,
        'author_email' => $faker->safeEmail,
        'author_url'   => $faker->url,
        'date'         => '',
        'date_gmt'     => '',
        'content'      => $faker->paragraph(rand(1, 5)),
        'karma'        => $faker->randomDigitNotNull,
        'parent'       => 0, // Top level comment
        'post'         => $faker->randomDigitNotNull,
        'type'         => '', // Empty to mean standard comment
        'user'         => 0, // Comment as guest
    ]
];
