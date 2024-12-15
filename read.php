<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'Database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>

<body>
    <h1>User List</h1>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row["matric"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><a href="update_form.php?matric=<?php echo $row["matric"]; ?>">Update</a></td>
                    <td><a href="delete.php?matric=<?php echo $row["matric"]; ?>"
                            onclick="return confirm('Are you sure?')">Delete</a></td>
                </tr>
        <?php
            }
        }
        $db->close();
        ?>
    </table>
    <br><a href="logout.php">Logout</a>
</body>

</html>