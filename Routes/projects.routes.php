<?php

use DP\Models\Bibliothek;

$bibliothek = Bibliothek::getInstance();

$project_uuid = $_REQUEST['uuid'] ?? null;
$project_data = json_decode(file_get_contents('php://input'), true);

try {
    $http_response = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $bibliothek->getProject()->fetchProject($project_uuid),
        'POST' => $bibliothek->getProject()->push($project_data),
        // 'DELETE' => $bibliothek->getProject()->delete($project_uuid),
        // 'PUT' => $bibliothek->getProject()->update($project_data, $project_uuid),
        default => throw new Exception('Method not allowed', 405)
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