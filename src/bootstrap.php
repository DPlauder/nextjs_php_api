<?php
// bootstrap.php
require dirname(__DIR__) . '/autoload.php';
require dirname(__DIR__) . '/src/Helpers/populateDb.php';

use DP\Config\Config;
use DP\Models\Bibliothek;


// Singleton
try {
    Bibliothek::getInstance(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);
} catch (Throwable $e) {
    echo "Fehler: " . $e->getMessage();
}

require './Routes/routes.php';

