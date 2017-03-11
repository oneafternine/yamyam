<?php

$faker = Faker\Factory::create();

return [
    'class'      => 'Substrakt\Fakes\User',
    'attributes' => [
        'description'  => $faker->paragraph(rand(1, 5)),
        'display_name' => $faker->name,
        'email'        => $faker->safeEmail,
        'first_name'   => $faker->firstName,
        'last_name'    => $faker->lastName,
        'username'     => $faker->userName,
        'nicename'     => $faker->name,
        'nickname'     => $faker->name,
        'password'     => $faker->password,
        'registered'   => '0000-00-00 00:00:00',
        'rich_editing' => true,
        'role'         => $faker->randomElement(['subcriber', 'contributor', 'author', 'editor', 'administrator']),
        'url'          => $faker->url,
    ]
];
