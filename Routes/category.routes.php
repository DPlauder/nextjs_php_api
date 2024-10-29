<?php
// category.routes.php
use DP\Models\Bibliothek;

$bibliothek = Bibliothek::getInstance();
$category_id = $_REQUEST['uuid'] ?? null;
$response = "";
$category_data = json_decode(file_get_contents('php://input'));
var_dump($category_data);
var_dump($_SERVER['REQUEST_METHOD']);

exit;
try {
    $http_response = match($_SERVER['REQUEST_METHOD']){
        'GET' => $bibliothek->getCategory()->fetchCategories(),
        'POST' => $bibliothek->getCategory()->push($category_data),
        default => throw new Exception('Method not allowed', 405)
    };
    
} catch (Exception $e) {
    echo json_encode([
        'errors' => [
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ]
    ]);
}