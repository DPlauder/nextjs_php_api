<?php
// bootstrap.php
require dirname(__DIR__) . '/autoload.php';
require dirname(__DIR__) . '/src/Helpers/populateDb.php';

use DP\Config\Config;
use DP\Models\Bibliothek;

// Singleton
Bibliothek::getInstance(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);

require dirname(__DIR__) . '/Routes/routes.php';
require dirname(__DIR__) . '/src/Helpers/headers.php';

