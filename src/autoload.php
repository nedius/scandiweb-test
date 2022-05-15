<?php
include_once "config.php";

spl_autoload_register(function ($class) {

    $prefix = 'Nedius\\';
    
    $base_dir = __DIR__ . "/";
    // $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    $file = str_replace('\\', '/', $file);

    if (file_exists($file)) {
        require $file;
    }
});