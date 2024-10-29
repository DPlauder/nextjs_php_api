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

            // Require the file if it exists
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});
