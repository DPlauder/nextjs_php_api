<?php
namespace DP\Models;

use Ramsey\Uuid\Uuid;

class Category{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function fetchCategory($uuid){
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->sql_execute($sql, [':id' => $uuid]);
        return $stmt->fetch();
    }
    public function fetchCategories(){
        var_dump($this->db);
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->sql_execute($sql);
        return $stmt->fetchAll();
    }
    public function push(array $data): bool{
        $uuid = Uuid::uuid4();
        $name = $data['name'];
        $url = $data['url'] ? $data['url'] : null;

        var_dump('hello push');

        $sql = "INSERT INTO categories(uuid, name, url)
        VALUES (:uuid, :name, :url)";
        $this->db->sql_execute($sql,[
        'uuid' => $uuid,
        'name' => $name,
        'url' => $url
        ]);
        return true;
    }
    public function delete($id): bool{
        $sql = "DELETE FROM categories WHERE id = :id";
        $this->db->sql_execute($sql, [':id' => $id]);
        return true;
    } 
}