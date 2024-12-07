<?php

require dirname(__DIR__) . '/src/Helpers/functions.php';

$ressource = $_REQUEST['ressource'] ?? null;
try{
    return match($ressource){
        'category' => require 'category.routes.php',
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