<?php

define('AUTOLOAD_INCLUDED', true);

/**
 * Require the autoloader for the basetheme
 * @codeCoverageIgnore
*/
foreach (glob(dirname(__DIR__) . '/*') as $theme) {
    if (file_exists("{$theme}/autoload.php") && $theme !== __DIR__) {
        require "{$theme}/autoload.php";
    }
}

/**
 * Return a list of directories for autoload classes
 * and helper functions. Taxonomies and post types are also
 * registered this way
 * @codeCoverageIgnore
*/
function get_directories() {
  $directories = [];
  $directories[] = __DIR__;
  $directories = apply_filters('substrakt/basetheme/autoload/directories', $directories);
  return array_unique($directories);
}

/**
 * Look for classes in all the given directories
 * @codeCoverageIgnore
*/
spl_autoload_register(function($className) {
    $directories = get_directories();
    $path = explode('\\', $className);
    $file = array_pop($path);
    $folders = ['app/classes', 'platypus'];
    $file_found = false;

    foreach ($directories as $directory) {
        foreach ($folders as $folder) {
          $full_path = $directory . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $file . '.php';

          if (file_exists($full_path)) {
            require_once $full_path;
            $file_found = true;
          }
        }
    }

    return $file_found;
});

// Feature Toggles
require_once __DIR__ . '/features/FeatureToggles.php';

// Dependencies loaded via Composer
require_once __DIR__ . '/vendor/autoload.php';


/**
 * Loop through the directories and include any PHP files
*/
foreach (get_directories() as $directory) {
    foreach (["{$directory}/post-types", "{$directory}/taxonomies", "{$directory}/app"] as $dir) {
        if (is_dir($dir) && $dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $info = pathinfo($dir . DIRECTORY_SEPARATOR . $file);
                if (isset($info['extension']) && $info['extension'] === 'php') {
                    require_once $dir . DIRECTORY_SEPARATOR . $file;
                }
            }
            closedir($dh);
        }
    }
}
