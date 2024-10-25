<?php
namespace Dp\Api;
header("Access-Control-Allow-Origin: *");


class Product{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getProduct($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->sql_execute($sql, [':id' => $id]);
        return $stmt->fetch();           

    }
    public function getProducts(){
        $sql = "SELECT * FROM products";
        $stmt = $this->db->sql_execute($sql);
        return $stmt->fetchAll();
    }
    public function push(array $data){
        $title          = $data['title'];
        $description    = $data['description'];
        $price          = $data['price'];
        $image = $data['image'] ? $data['image'] : null;

        $sql = "INSERT INTO products(title, description, price, image)
        VALUES (:title, :description, :price, :image)";
        $this->db->sql_execute($sql, [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ]);
        return true;
    }
}
?>