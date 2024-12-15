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
    $userDetails = $user->getUser($_GET['matric']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <?php if (isset($userDetails) && $userDetails): ?>
        <form action="update.php" method="post">
            <h1>Update User</h1>
            <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>"><br>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $userDetails['name']; ?>" required><br><br>
            <label for="role">Role:</label>
            <select name="role" required>
                <option value="Lecturer" <?php echo ($userDetails['role'] == 'Lecturer') ?
                                                'selected' : ''; ?>>Lecturer</option>
                <option value="Student" <?php echo ($userDetails['role'] == 'Student') ?
                                            'selected' : ''; ?>>Student</option>
            </select><br><br>
            <input type="submit" value="Update">
            <a href="read.php"></a><input type="submit" value="Cancel">
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

</body>

</html>