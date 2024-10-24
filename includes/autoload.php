<?php
spl_autoload_register(function($className) {
    // Define the base directory for your classes
    $base_dir = __DIR__ . '/../classes/';  // Adjust path to go up one level and into classes folder

    // Replace the namespace separator with the directory separator (if using namespaces)
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // Create the full path to the class file
    $file = $base_dir . $className . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("The class file $file could not be found.");
    }
});
