<?php
// bootstrap.php
require dirname(__DIR__) . '/autoload.php';
require dirname(__DIR__) . '/src/Helpers/populateDb.php';

use DP\Config\Config;
use DP\Models\Bibliothek;


// Singleton
try {
    $bibliothek = new Bibliothek (Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);
    echo "Bibliothek erfolgreich geladen!";
} catch (Throwable $e) {
    echo "Fehler: " . $e->getMessage();
}


require dirname(__DIR__) . '/Routes/routes.php';
require dirname(__DIR__) . '/src/Helpers/headers.php';

