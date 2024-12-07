<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
//TODO HEADER SETZEN
require  './src/bootstrap.php';

use DP\Config\AllowCors;

$cors = new AllowCors();
$cors->init();