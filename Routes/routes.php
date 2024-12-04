<?php

//use Error;
//require dirname(__DIR__) . '/src/Helpers/functions.php';

$ressource = $_REQUEST['ressource'] ?? null;
var_dump("hellor res" . $ressource);

try{
    return match($ressource){
        'category'  => require 'category.routes.php',
        'projects'   => require 'projects.routes.php',
        default => ''
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