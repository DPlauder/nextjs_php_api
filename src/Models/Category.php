<?php
namespace DP\Models;


class Category{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function fetchCategory($uuid){
        $sql = "SELECT * FROM categories WHERE uuid = :uuid";
        $stmt = $this->db->sql_execute($sql, [':uuid' => $uuid]);
        return $stmt->fetch();
    }
    public function fetchCategories(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->sql_execute($sql);
        return $stmt->fetchAll();
    }
    public function push(array $data): bool{
        $name = $data['name'];
        $url = $data['url'] ? $data['url'] : null;

        $sql = "INSERT INTO categories( name, url)
        VALUES (:name, :url)";
        $this->db->sql_execute($sql,[
        //'uuid' => $uuid,
        'name' => $name,
        'url' => $url
        ]);
        return true;
    }
    public function update(array $data, string $uuid): bool{
        $currentData = $this->fetchCategory($uuid);
        if(!$currentData){
            return false;
        }        
        $name = $data['name'] ?? $currentData['name'];
        $url = $data['url'] ?? $currentData['url'];

        $sql = "UPDATE categories SET name = :name, url = :url WHERE uuid = :uuid";
        $this->db->sql_execute($sql,[
            'name' => $name,
            'url' => $url,
            'uuid' => $uuid,
        ]);
        return true;
    }
    public function delete($uuid): bool{
        $sql = "DELETE FROM categories WHERE uuid = :uuid";
        $this->db->sql_execute($sql, [':uuid' => $uuid]);
        return true;
    }
    
}