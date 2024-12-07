<?php


use DP\Models\Bibliothek;


$bibliothek = Bibliothek::getInstance();

$category_uuid = $_REQUEST['uuid'] ?? null;
$response = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump("route");
    $category_data = json_decode(file_get_contents('php://input'), true);

    if ($category_data) {
        try {
            // Insert the new category into the database
            $response = $bibliothek->getCategory()->push($category_data);

            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'Category added successfully.'
            ]);
        } catch (Exception $e) {
            // Return error response
            echo json_encode([
                'errors' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode()
                ]
            ]);
        }
    } else {
        echo json_encode([
            'errors' => [
                'message' => 'Invalid category data.',
                'code' => 400
            ]
        ]);
    }
    exit;
}

try {
    $http_response = match($_SERVER['REQUEST_METHOD']){
        'GET'       => $bibliothek->getCategory()->fetchCategories(),
        'POST'      => $bibliothek->getCategory()->push($category_data),
        'DELETE'    => $bibliothek->getCategory()->delete($category_uuid),
        'PUT'       => $bibliothek->getCategory()->update($category_data, $category_uuid),
        default     => throw new Exception('Method not allowed', 405)
    };
    
} catch (Exception $e) {
    echo json_encode([
        'errors' => [
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ]
    ]);
}
