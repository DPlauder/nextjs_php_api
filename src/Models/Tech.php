<?php
namespace DP\Models;

use Ramsey\Uuid\Uuid;

class Tech{
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }

    public function fetch($uuid){
        if(isset($uuid)){
            $sql = "SELECT * FROM tech WHERE uuid = :uuid";
            $stmt = $this->db->sql_execute($sql,[
                'uuid' => $uuid,
            ]);
            return $stmt->fetch();
        } else {
            $sql = "SELECT * FROM tech";
            $stmt = $this->db->sql_execute($sql);
            return $stmt->fetchAll();
        }
    }
    
    public function push(array $data): bool{
        $uuid = Uuid::uuid4()->toString();
        $name = $data['name'];
        $url = $data['url'];
        $sql = "INSERT INTO tech(uuid, name, url) 
        VALUES (:uuid, :name, :url)";
        $this->db->sql_execute($sql, [
            'uuid'  => $uuid,
            'name'  => $name,
            'url'   => $url
        ]);
        return true;
    }
}