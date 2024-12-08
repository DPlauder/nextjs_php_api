<?php

use DP\Models\Bibliothek;

$bibliothek = Bibliothek::getInstance();

$project_uuid = $_REQUEST['uuid'] ?? null;
$project_data = json_decode(file_get_contents('php://input'), true);

try {
    ob_start();
    $http_response = match ($_SERVER['REQUEST_METHOD']) {
        'GET'       => $bibliothek->getProject()->fetchProjects(),
        'POST'      => $bibliothek->getProject()->push($project_data),
        //'DELETE'    => $bibliothek->getProject()->delete($project_uuid),
        //'PUT'       => $bibliothek->getProject()->update($project_data, $project_uuid),
        default     => throw new Exception('Method not allowed', 405)
    };
    ob_clean();
    echo json_encode($http_response);

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