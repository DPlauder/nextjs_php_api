<?php

require dirname(__DIR__) . '/src/Helpers/functions.php';

$ressource = $_REQUEST['ressource'] ?? null;
try{
    return match($ressource){
		'project'	=> require 'projects.routes.php',
        'category' 	=> require 'category.routes.php',
		'tech'		=> require 'tech.routes.php',
    };
}
catch(Error $e){
    echo json_encode([
		'errors' => [
			'message' => $e->getMessage(),
			'code' => $e->getCode()
		]
	]);
}