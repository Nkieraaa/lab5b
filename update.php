<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'Database.php';
include 'User.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute()) {
        header("Location: read.php");
        exit();
    }

    $stmt->close();
    $db->close();
}
