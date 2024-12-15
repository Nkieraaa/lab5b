<?php
session_start();
include 'Database.php';
include 'User.php';

if (isset($_POST['submit'])) {
    $database = new Database();
    $db = $database->getConnection();

    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        if ($userDetails && password_verify($password, $userDetails['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['matric'] = $matric;
            $_SESSION['role'] = $userDetails['role'];
            header("Location: read.php");
            exit();
        } else {
            header("Location: error_login.php");
            exit();
        }
    }
}
