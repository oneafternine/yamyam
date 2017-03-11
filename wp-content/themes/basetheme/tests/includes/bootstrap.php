<?php

global $wpdb, $current_site, $current_blog, $wp_rewrite, $shortcode_tags, $wp, $phpmailer;

define('ROOT_PATH', dirname(dirname(dirname(dirname(dirname(__DIR__))))));
define('THEMES_PATH', dirname(dirname(dirname(__DIR__))));
define('BASETHEME_PATH', dirname(dirname(__DIR__)));

// Check for test database configuration
if (! is_readable(ROOT_PATH . '/wp-tests-config.php')) {
    echo "ERROR: wp-tests-config.php is missing.\n";
    exit;
}

// Load test database configuration
require_once ROOT_PATH . '/wp-tests-config.php';

// Load test helper functions
require_once __DIR__ . '/helpers.php';

// Reset $_SERVER variable
tests_reset__SERVER();
drop_all_tables();

global $phpmailer;
require_once dirname(__DIR__) . '/includes/MockMailer.php';
$phpmailer = new MockMailer();

// Load the install script
system(WP_PHP_BINARY . ' ' . escapeshellarg(dirname( __FILE__ ) . '/install.php') . ' ' . escapeshellarg(ROOT_PATH . '/wp-tests-config.php'));

// Load WordPress
require_once ROOT_PATH . '/wp-settings.php';

// Set the theme to this theme
require_once ROOT_PATH . '/wp-includes/theme.php';
switch_theme(dirname(dirname(__DIR__)) . '/style.css');

require_once dirname(dirname(__DIR__)) . '/autoload.php';

// Check for FactoryGirl
if (!class_exists('FactoryGirl\Factory')) {
    echo "ERROR: You need to use Composer to install FactoryGirl.\n";
    exit;
}

// Require the autoloader for the fakes
require_once dirname(__DIR__) . '/fakes/autoload.php';


// Set the location of our test factories
$factories = apply_filters('substrakt/basetheme/tests/factories/directories', [
    THEMES_PATH . '/basetheme/tests/factories',
]);
FactoryGirl\Factory::setup($factories);

// Set the path to load the ACF json files from
add_filter('acf/settings/load_json', function($paths) {
    $paths = [
        THEMES_PATH . '/basetheme/acf-json',
        THEMES_PATH . '/basetheme/tests/includes/acf-json'
    ];
    return apply_filters('substrakt/basetheme/tests/acf_json/directories', $paths);
});

// Create a database connection to all the tables to be truncated after each tests
Substrakt\Fakes\Fake::$mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Close database connection - Good Housekeeping
register_shutdown_function(function() {
    Substrakt\Fakes\Fake::$mysqli->close();
});
