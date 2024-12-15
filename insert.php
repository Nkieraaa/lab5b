<?php
include 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$matric = $_POST['matric'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $matric, $name, $password, $role);

if ($stmt->execute()) {
  header("Location: login.php");
  exit();
}

$stmt->close();
$conn->close();
