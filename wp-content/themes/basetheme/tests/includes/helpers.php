<?php

/**
 * Drop all tables in the database the old fashioned way
 */
function drop_all_tables() {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($mysqli->connect_errno) {
        echo PHP_EOL . "ERROR: Can not connect to the database to complete table drop action" . PHP_EOL;
    }

    $query = $mysqli->query("SHOW TABLES");

    while ($table = $query->fetch_assoc()) {
        $table = array_values($table)[0];
        $mysqli->query("DROP TABLE IF EXISTS {$table}");
    }

    $mysqli->close();
}

/**
 * Set a permalink structure.
 */
function set_default_permalink_structure_for_tests() {
    update_option('permalink_structure', '/%year%/%monthnum%/%day%/%postname%/');
}

/**
 * Resets various `$_SERVER` variables that can get altered during tests.
 */
function tests_reset__SERVER() {
    $_SERVER['HTTP_HOST']       = WP_TESTS_DOMAIN;
    $_SERVER['REMOTE_ADDR']     = '127.0.0.1';
    $_SERVER['REQUEST_METHOD']  = 'GET';
    $_SERVER['REQUEST_URI']     = '';
    $_SERVER['SERVER_NAME']     = WP_TESTS_DOMAIN;
    $_SERVER['SERVER_PORT']     = '80';
    $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';

    unset($_SERVER['HTTP_REFERER']);
    unset($_SERVER['HTTPS']);
}

function extend_factory($file, $attributes) {
    $file = str_ireplace('Factory', '', $file);
    $factory = require dirname(__DIR__) . "/factories/{$file}Factory.php";
    return array_merge($factory['attributes'], $attributes);
}
