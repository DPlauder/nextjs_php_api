<?php
// bootstrap.php
require 'autoload.php';
require 'src/Helpers/populateDb.php';

use DP\Config\Config;
use DP\Models\Bibliothek;

// Singleton
Bibliothek::getInstance(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);

require './Routes/routes.php';

