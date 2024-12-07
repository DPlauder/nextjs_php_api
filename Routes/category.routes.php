<?php


use DP\Models\Bibliothek;

$bibliothek = Bibliothek::getInstance();

$category_uuid = $_REQUEST['uuid'] ?? null;
$response = "";

try {
    $http_response = match($_SERVER['REQUEST_METHOD']){
        'GET'       => $bibliothek->getCategory()->fetchCategories(),
        'POST'      => $bibliothek->getCategory()->push($category_data),
        'DELETE'    => $bibliothek->getCategory()->delete($category_uuid),
        'PUT'       => $bibliothek->getCategory()->update($category_data, $category_uuid),
        default     => throw new Exception('Method not allowed', 405)
    };
    echo json_encode($http_response);
    
} catch (Exception $e) {
    echo json_encode([
        'errors' => [
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ]
    ]);
}
