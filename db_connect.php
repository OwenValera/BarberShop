<?php
$host = 'localhost';
$dbname = 'barbershop';
$username = 'your_username'; // Replace with your MySQL username
$password = 'your_password'; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>