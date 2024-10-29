<?php

require dirname(__DIR__) . '/Database/Database.php';
require dirname(__DIR__) . '/Config/Config.php';

use DP\Database\Database;
use DP\Config\Config;

function populateDB(){
    //TODO ERSETZEN MIT POD
        $db = new Database(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);
        $sqlUser = 
            "CREATE TABLE IF NOT EXISTS user (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                uuid CHAR(36) NOT NULL UNIQUE DEFAULT (UUID()),
                name VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE
            )";

    // SQL for creating the `categories` table
    $sqlCategories = "
    CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        uuid CHAR(36) NOT NULL UNIQUE DEFAULT (UUID()),
        name VARCHAR(50) NOT NULL,
        url VARCHAR(255) NOT NULL UNIQUE
    )
    ";

    $sqlProjects = "
        CREATE TABLE IF NOT EXISTS projects (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL UNIQUE DEFAULT (UUID()),
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255) NOT NULL,
            github_url VARCHAR(255),
            status ENUM('active', 'inactive', 'completed') DEFAULT 'active',
            category_id INT(11), -- Foreign key column to reference categories
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
        )
    ";

    $sqlTech = "
        CREATE TABLE IF NOT EXISTS tech (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            uuid CHAR(36) NOT NULL UNIQUE DEFAULT (UUID()),
            name VARCHAR(50) NOT NULL,
            doku_url VARCHAR(255)
        )
    ";

    $sqlProjectTech = "
        CREATE TABLE IF NOT EXISTS project_tech (
            project_id INT(11) NOT NULL,
            tech_id INT(11) NOT NULL,
            PRIMARY KEY (project_id, tech_id),
            FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
            FOREIGN KEY (tech_id) REFERENCES tech(id) ON DELETE CASCADE
        )
    ";

    $stmtUser = $db->sql_execute($sqlUser);
    $stmtUser = $db->sql_execute($sqlCategories);
    $stmtUser = $db->sql_execute($sqlProjects);  
    $stmtUser = $db->sql_execute($sqlTech);  
    $stmtUser = $db->sql_execute($sqlProjectTech);  
}
//TODO ERROR HANDLE
populateDB();