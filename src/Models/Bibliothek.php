<?php
namespace DP\Models;

use DP\Database\Database;
use Src\Models\Project;

class Bibliothek {
    private static Bibliothek $instance;
    private $pdo;
    protected Database $db;
    protected Category $category;
    protected Project $project;

    // Private constructor to prevent direct instantiation
    /** 
     * @param mixed $dsn
     * @param mixed $username
     * @param mixed $password
     */
    public function __construct($dsn, $username, $password) {
        $this->db = new Database($dsn, $username,$password);
    }

    // Static method to get the Singleton instance
    public static function getInstance($dsn = null, $username = null, $password = null): Bibliothek {
        if (!isset(self::$instance)) {
            if ($dsn === null || $username === null || $password === null) {
                throw new \Exception("Die Singleton-Instanz wurde noch nicht initialisiert und es fehlen Parameter.");
            }
            self::$instance = new Bibliothek($dsn, $username, $password);
        }
        return self::$instance;
    }
    public function getDatabase(): \PDO{
        return $this->pdo;
    }

    // Sample method to access database
    public function getCategory(): Category {
        if(!isset( $this->category)){
            $this->category = new Category($this->db);
        }
        return $this->category;
    }
    public function getProject(): Project{
        if(!isset($this->project)){
            $this->project = new Project($this->db);
        }
        return $this->project;
    }
}