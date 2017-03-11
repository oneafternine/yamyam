<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'iFake.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Fake.php';


spl_autoload_register(function($className) {
    $directories = get_directories();
    $path = explode('\\', $className);
    $file = array_pop($path);
    $folders = ['tests/fakes'];
    $file_found = false;

    foreach ($directories as $directory) {
        foreach ($folders as $folder) {
          $full_path = $directory .DIRECTORY_SEPARATOR. $folder . DIRECTORY_SEPARATOR . $file . '.php';

          if (file_exists($full_path)) {
            require_once $full_path;
            $file_found = true;
          }
        }
    }

    return $file_found;
});
