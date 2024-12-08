<?php

use DP\Models\Bibliothek;

use function DP\Helpers\response;

$bibliothek = Bibliothek::getInstance();

$category_uuid = $_REQUEST['uuid'] ?? null;
$category_data = json_decode(file_get_contents('php://input'), true);


try {
    ob_start();
    $http_response = match ($_SERVER['REQUEST_METHOD']) {
        'GET'       => $bibliothek->getCategory()->fetchCategories(),
        'POST'      => $bibliothek->getCategory()->push($category_data),
        'DELETE'    => $bibliothek->getCategory()->delete($category_uuid),
        'PUT'       => $bibliothek->getCategory()->update($category_data, $category_uuid),
        default     => throw new Exception('Method not allowed', 405)
    };
    ob_clean();
    response($http_response);

} catch (Exception $e) {
    if (ob_get_level()) {
        ob_clean();
    }

    echo json_encode([
        'errors' => [
            'message' => $e->getMessage(),
            'code'    => $e->getCode()
        ]
    ]);
} finally {
    if (ob_get_level()) {
        ob_end_flush();
    }
}
