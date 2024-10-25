<?php
namespace Dp\Api;
use Dp\Config\Config;
use Dp\Api\Database;
use Dp\Api\Product;
require_once 'Database.php';
require_once 'Product.php';
require_once '../config/Config.php';


$db = new Database(Config::getDsn(), Config::DB_USER, Config::DB_PASSWORD);
$product = new Product($db);

$method = $_SERVER['REQUEST_METHOD'];
var_dump($db);
exit;


switch ($method) {
    case 'GET':
        // Get products
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id){
            $response = $product->getProduct($id);
        }
        else{
            $response = $product->getProducts();
        }
        echo json_encode($response);
        var_dump($response);
        break;
/*
    case 'POST':
        // Create a new product
        $data = json_decode(file_get_contents("php://input"), true);
        $response = $product->createProduct($data);
        echo json_encode($response);
        break;

    case 'PUT':
        // Update an existing product
        $data = json_decode(file_get_contents("php://input"), true);
        $response = $product->updateProduct($data);
        echo json_encode($response);
        break;

    case 'DELETE':
        // Delete a product
        $id = $_GET['id'] ?? null;
        if ($id) {
            $response = $product->deleteProduct($id);
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Product ID is required']);
        }
        break;
*/
    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        break;
}
?>
