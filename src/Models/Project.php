<?php
namespace DP\Models;

use DP\Models\ProjectTech;

use Ramsey\Uuid\Uuid;

class Project{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function fetchProject($uuid){
        if(isset($uuid)){
            $sql = "SELECT * FROM projects WHERE uuid = :uuid";
            $stmt = $this->db->sql_execute($sql,[
                "uuid" => $uuid
            ]);
            return $stmt->fetch();
        } else{
            $sql = "SELECT * FORM projects";
        $stmt = $this->db->sql_execute($sql);
        return $stmt->fetchAll();
        }
        
    }
    public function push(array $project_data){
        $uuid = Uuid::uuid4()->toString();
        $name = $project_data['name'];
        $description = $project_data['description'];
        $github_url = $project_data['github_url'];
        $category_uuid = $project_data['category_uuid'];
        $tech_uuids = $project_data['tech_uuids'] ?? [];

        $sql = "INSERT INTO projects (uuid, name, description, github_url, category_uuid) 
                VALUES (:uuid, :name, :description, :github_url, :category_uuid)";
        $this->db->sql_execute($sql,[
            'uuid'          => $uuid,
            'name'          => $name,
            'description'   => $description,
            'github_url'    => $github_url,
            'category_uuid' => $category_uuid,
        ]);

        // HIER FEHLER
        if(!empty($tech_uuids)){
            $project_id = intval($this->db->lastInsertId());
            $sql = "SELECT uuid FROM projects WHERE id = :id";
            $stmt = $this->db->sql_execute($sql,[
                'id' => $project_id,
            ]);
            $project_uuid = $stmt->fetchColumn();
            $projectTech = new ProjectTech($this->db);
            $projectTech->push($project_uuid, $tech_uuids);
        }

        return true;
    }
}