<?php

// Beispielroute für GET /projekte
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Hier könnten wir Projekte aus einer Datenbank oder einer Datei abrufen.
/*     
    $projekte = [
        ['id' => 1, 'name' => 'Projekt 1', 'beschreibung' => 'Beschreibung für Projekt 1'],
        ['id' => 2, 'name' => 'Projekt 2', 'beschreibung' => 'Beschreibung für Projekt 2']
    ];
 */
    echo json_encode($projekte);
    exit;
}

// Beispielroute für POST /projekte
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Wir nehmen an, dass die POST-Daten im JSON-Format gesendet werden.
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['name']) && isset($input['beschreibung'])) {
        // Hier könnte das Projekt in einer Datenbank gespeichert werden.
        $newProject = [
            'id' => rand(3, 1000), // Zufällige ID für das Beispiel
            'name' => $input['name'],
            'beschreibung' => $input['beschreibung']
        ];

        // Wir geben das neu erstellte Projekt zurück
        echo json_encode(['message' => 'Projekt erfolgreich hinzugefügt', 'projekt' => $newProject]);
    } else {
        echo json_encode(['error' => 'Ungültige Eingabedaten']);
    }
    exit;
}

// Beispielroute für PUT /projekte/{id}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // URL-Parameter extrahieren
    $id = $_GET['id'] ?? null;
    $input = json_decode(file_get_contents('php://input'), true);

    if ($id && isset($input['name']) && isset($input['beschreibung'])) {
        // Hier könnte das Projekt in der Datenbank aktualisiert werden
        $updatedProject = [
            'id' => $id,
            'name' => $input['name'],
            'beschreibung' => $input['beschreibung']
        ];

        echo json_encode(['message' => 'Projekt erfolgreich aktualisiert', 'projekt' => $updatedProject]);
    } else {
        echo json_encode(['error' => 'Ungültige Eingabedaten oder Projekt-ID']);
    }
    exit;
}

// Beispielroute für DELETE /projekte/{id}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        // Hier könnte das Projekt aus der Datenbank gelöscht werden.
        echo json_encode(['message' => "Projekt mit ID $id erfolgreich gelöscht"]);
    } else {
        echo json_encode(['error' => 'Projekt-ID nicht angegeben']);
    }
    exit;
}

