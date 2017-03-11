<?php

define('WP_INSTALLING', true);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
$PHP_SELF = $GLOBALS['PHP_SELF'] = $_SERVER['PHP_SELF'] = '/index.php';

echo 'Installing WordPress...' . PHP_EOL;

$config_file = $argv[1];

require_once $config_file;
require_once dirname( __FILE__ ) . '/helpers.php';

drop_all_tables();
tests_reset__SERVER();

require_once ABSPATH . '/wp-settings.php';
require_once ABSPATH . '/wp-admin/includes/upgrade.php';
require_once ABSPATH . '/wp-includes/wp-db.php';


$wpdb->select(DB_NAME, $wpdb->dbh);


add_action('populate_options', 'set_default_permalink_structure_for_tests');

global $phpmailer;
require_once dirname(__DIR__) . '/includes/MockMailer.php';
$phpmailer = new MockMailer();

wp_install(WP_TESTS_TITLE, 'admin', WP_TESTS_EMAIL, true, null, 'password');

echo 'Activating Plugins...' . PHP_EOL;
foreach (['advanced-custom-fields-pro/acf.php'] as $plugin) {
    activate_plugin($plugin, '', false);
}

remove_action('populate_options', 'set_default_permalink_structure_for_tests');
