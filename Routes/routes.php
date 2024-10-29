<?php

use Error;
require dirname(__DIR__) . '/src/Helpers/functions.php';

$ressource = $_REQUEST['ressource'] ?? null;
var_dump($_SERVER['REQUEST_METHOD']);

try{
    return match($ressource){
        'category' => require 'category.routes.php',
        default => require '404.routes.php'
    };
}
catch(Error $e){
    var_dump("routes error");
    echo json_encode([
		'errors' => [
			'message' => $e->getMessage(),
			'code' => $e->getCode()
		]
	]);
}