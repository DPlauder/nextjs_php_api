<?php
namespace DP\Models;

class Project{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function fetchProject($uuid){
        $sql = "SELECT * FROM projects WHERE uuid = :uuid";
        $stmt = $this->db->sql_execute($sql,[
            "uuid" => $uuid
        ]);
        return $stmt->fetch();
    }
    public function fetchProjects(){
        $sql = "SELECT * FORM projects";
        $stmt = $this->db->sql_execute($sql);
        return $stmt->fetchAll();
    }
    public function push(){
        
    }
}