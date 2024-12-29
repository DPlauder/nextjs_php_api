<?php
namespace DP\Models;

use Ramsey\Uuid\Uuid;
use PDO;

class ProjectTech{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }

    public function push($project_uuid, array $tech_uuids){
        $sql = "SELECT tech_uuid FROM project_tech WHERE project_uuid = :project_uuid";
        $stmt = $this->db->sql_execute($sql,[
            'project_uuid'  => $project_uuid,
        ]);
        $existingTechs = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        $newTechUuids = array_diff($tech_uuids, $existingTechs);

        $sql = "INSERT INTO project_tech (uuid, project_uuid, tech_uuid) VALUES (:uuid, :project_uuid, :tech_uuid)";
        foreach($newTechUuids as $tech_uuid){
            var_dump($tech_uuid);
            $uuid = Uuid::uuid4()->toString();
            $this->db->sql_execute($sql, [
                'uuid'          => $uuid,
                'project_uuid'  => $project_uuid,
                'tech_uuid'     => $tech_uuid,
            ]);
        };
        return true;
    }
}