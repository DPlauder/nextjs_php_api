<?php

use DP\Models\Bibliothek;

use function DP\Helpers\response;

$bibliothek = Bibliothek::getInstance();

$tech_uuid = $_REQUEST['uuid'] ?? null;
$tech_data = json_decode(file_get_contents('php://input'), true);

try{
    ob_start();
    $http_response = match($_SERVER['REQUEST_METHOD']){
        'GET'       => $bibliothek->getTech()->fetch($tech_uuid),
        'POST'      => $bibliothek->getTech()->push($tech_data)
    };
    ob_clean();
    response($http_response);
} catch (Exception $e){
    if(ob_get_level()){
        ob_clean();
    }
    echo json_encode([
        'errors' => [
            'message'   => $e->getMessage(),
            'code'      => $e->getCode()
        ]
        ]);
} finally{
    if(ob_get_level()){
        ob_end_flush();
    }
}