<?php
namespace DP\Models;

use Dp\Database\Database;

class Bibliothek {
    private static ?Bibliothek $instance = null;
    private $pdo;
    protected Database $db;
    protected Category $category;

    // Private constructor to prevent direct instantiation
    /** 
     * @param mixed $dsn
     * @param mixed $username
     * @param mixed $password
     */
    private function __construct($dsn, $username, $password) {
        $this->db = new Database($dsn, $username,$password);
        //$this->pdo = new \PDO($dsn, $username, $password);
    }

    // Static method to get the Singleton instance
    public static function getInstance($dsn = null, $username = null, $password = null): Bibliothek {
        if (!isset(self::$instance)) {
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

}