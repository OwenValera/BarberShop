<?php
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli('localost','root','','test');
if(@conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into login(username, password)
        values(?, ?,)");
    $stmt->bind_peram("ssssi",$username, $password);
    $stmt->execute();
    echo "registration successfully...";
    $stmt->close();
    $conn->close();
}
?>