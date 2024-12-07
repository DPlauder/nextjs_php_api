<?php
// test_autoloader.php

require_once './src/bootstrap.php';

use DP\Models\Bibliothek;

header('Content-Type: application/json');

try {
    // Versuche, die Bibliothek-Klasse zu laden
    $bibliothek = Bibliothek::getInstance();
    var_dump($bibliothek);
    echo json_encode([
        "status" => "success",
        "message" => "Autoloader funktioniert. Bibliothek wurde geladen."
    ]);
} catch (Throwable $e) {
    // Fehler beim Laden der Klasse
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Autoloader Fehler: " . $e->getMessage()
    ]);
}
