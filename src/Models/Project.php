<?php 
namespace Src\Models;

class Project{
    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function push(array $data): bool{
        //$uuid = new Uuid();
        $name = $data['name'];
        $description = $data['description'];
        $githubUrl = $data['githubUrl'];
        $status = $data['status'];
        $category = $data['category'];

        $sql = "INSERT INTO projects (uuid, name, description, github_url, status, category) 
                VALUES (:name, :description, :githubUrl, :status, :category)";
        $this->db->sql_execute($sql, [
            ':name' => $name,
            ':description' => $description,
            ':githubUrl' => $githubUrl,
            ':status' => $status,
            ':category' => $category
        ]);
        return true;
    }
    public function fetchAll()
    {
        $sql = "SELECT * FROM projects";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    public function fetch($uuid){
        $sql = "SELECT * FROM projects WHERE uuid = :uuid";
        $stmt = $this->db->sql_execute($sql, ['uuid' => $uuid]);
        return $stmt->fetch();
    }
}