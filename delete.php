<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'Database.php';
include 'User.php';


if (isset($_GET['matric'])) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->deleteUser($_GET['matric']);

    header("Location: read.php");
    exit();
}
