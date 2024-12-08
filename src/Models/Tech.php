<?php
namespace DP\Models;

class Tech{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function push(array $data): bool{
        $name = $data['name'];
        $doku_url = $data['doku_url'];
        $sql = "INSERT INTO tech(name, doku_url) 
        VALUES (:name, :doku_url)";
        $this->db->sql_excecute($sql, [
            'name'      => $name,
            'doku_url'  => $doku_url
        ]);
        return true;
    }
}