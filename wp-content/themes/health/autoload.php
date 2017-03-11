<?php

add_filter('substrakt/basetheme/autoload/directories', function($directories) {
    $directories[] = __DIR__;
    return $directories;
});

add_filter('substrakt/basetheme/autoload/folders', function($directories) {
    return $directories;
});

add_filter('substrakt/basetheme/auto_include/folders', function($directories) {
    return $directories;
});

add_filter('substrakt/basetheme/tests/factories/directories', function($directories) {
    $directories[] = __DIR__ . '/tests/factories';
    return $directories;
});

add_filter('substrakt/basetheme/tests/acf_json/directories', function($directories) {
    $directories[] = __DIR__ . '/acf-json';
    return $directories;
});
