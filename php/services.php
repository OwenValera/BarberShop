<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "user"; // replace with your MySQL username
$password = "1234"; // replace with your MySQL password
$dbname = "barbershop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Read services
        $result = $conn->query("SELECT * FROM services");
        $services = array();
        
        while($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
        
        echo json_encode($services);
        break;
        
    case 'POST':
        // Add new service
        $data = json_decode(file_get_contents("php://input"), true);
        
        $name = $data['name'];
        $price = $data['price'];
        
        $stmt = $conn->prepare("INSERT INTO services (name, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $name, $price);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Service added successfully"]);
        } else {
            echo json_encode(["error" => "Error adding service"]);
        }
        break;
        
    case 'PUT':
        // Update service
        $data = json_decode(file_get_contents("php://input"), true);
        
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        
        $stmt = $conn->prepare("UPDATE services SET name=?, price=? WHERE id=?");
        $stmt->bind_param("sdi", $name, $price, $id);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Service updated successfully"]);
        } else {
            echo json_encode(["error" => "Error updating service"]);
        }
        break;
        
    case 'DELETE':
        // Delete service
        $id = $_GET['id'];
        
        $stmt = $conn->prepare("DELETE FROM services WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Service deleted successfully"]);
        } else {
            echo json_encode(["error" => "Error deleting service"]);
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

$conn->close();
?>