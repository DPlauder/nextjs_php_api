<?php
// bootstrap.php
require './autoload.php';
require 'src/Helpers/populateDb.php';
require './test_autoloader.php';

use DP\Config\Config;
use DP\Models\Bibliothek;

(new Config());

// Singleton
try {
    $bibliothek = new Bibliothek (Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);
    echo "Bibliothek erfolgreich geladen!";
} catch (Throwable $e) {
    echo "Fehler: " . $e->getMessage();
}


require './Routes/routes.php';
