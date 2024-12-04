<?php
// autoload.php
spl_autoload_register(function ($class) {
    // Define an array mapping namespaces to base directories
    $namespaces = [
        'DP' => __DIR__ . '/src',
        'Models' => __DIR__ . '/src/Models',
        'Config' => __DIR__ . '/src/Config',
        'Database' => __DIR__ . '/src/Database',
    ];

    // Iterate through the namespaces to find the right base directory
    foreach ($namespaces as $namespace => $baseDir) {
        // Check if the class uses the namespace prefix
        if (strpos($class, $namespace . '\\') === 0) {
            // Replace the namespace prefix with the base directory
            $relativeClass = substr($class, strlen($namespace . '\\'));
            $file = $baseDir . '/' . str_replace('\\', '/', $relativeClass) . '.php';

            // Debug output to check if the file is found
            echo "Autoloader: Trying to load class {$class} from file {$file}\n";

            // Require the file if it exists
            if (file_exists($file)) {
                require $file;
                echo "Autoloader: Successfully loaded class {$class} from file {$file}\n";
                return;
            } else {
                echo "Autoloader: File {$file} not found for class {$class}\n";
            }
        }
    }
});

