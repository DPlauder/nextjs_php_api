<?php
//TODO HEADER SETZEN
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
var_dump($_SERVER['REQUEST_METHOD']);
require  './src/bootstrap.php';