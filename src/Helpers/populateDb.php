############################################
// KI generiert
############################################

<?php

require dirname(__DIR__) . '/Database/Database.php';
require dirname(__DIR__) . '/Config/Config.php';

use DP\Database\Database;
use DP\Config\Config;

function populateDB() {
    $db = new Database(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);

    $sqlCategories = "
        CREATE TABLE IF NOT EXISTS categories (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL UNIQUE,
            name VARCHAR(50) NOT NULL,
            url VARCHAR(255) NOT NULL UNIQUE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    $sqlProjects = "
        CREATE TABLE IF NOT EXISTS projects (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL UNIQUE DEFAULT UUID(),
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255) NOT NULL,
            github_url VARCHAR(255),
            category_uuid CHAR(36),
            FOREIGN KEY (category_uuid) REFERENCES categories(uuid) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    $sqlTech = "
        CREATE TABLE IF NOT EXISTS tech (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL UNIQUE DEFAULT UUID(),
            name VARCHAR(50) NOT NULL,
            url VARCHAR(255)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    $sqlProjectTech = "
        CREATE TABLE IF NOT EXISTS project_tech (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL,
            project_uuid CHAR(36) NOT NULL,
            tech_uuid CHAR(36) NOT NULL,
            UNIQUE KEY (project_uuid, tech_uuid),
            FOREIGN KEY (project_uuid) REFERENCES projects(uuid) ON DELETE CASCADE,
            FOREIGN KEY (tech_uuid) REFERENCES tech(uuid) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    // Execute the SQL statements
    try {
        $db->sql_execute($sqlCategories);
        $db->sql_execute($sqlProjects);
        $db->sql_execute($sqlTech);
        $db->sql_execute($sqlProjectTech);
    } catch (Exception $e) {
        echo "Error creating tables: " . $e->getMessage();
    }
}

populateDB();