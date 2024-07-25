<?php
session_start();
include 'connect.php';

// Check if user is logged in and is an instructor
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'instructor') {
    echo 'Access denied';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        echo 'Password must be at least 6 characters long';
        exit;
    }

    if (!empty($username) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO students (stud_name, password) VALUES ('$username', '$passwordHash')";
        if ($conn->query($sql) === TRUE) {
            echo 'Student added successfully';
        } else {
            echo 'Error: ' . $conn->error;
        }
    } else {
        echo 'Please fill in all fields';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6">
        <br>
        <input type="submit" value="Add Student">
    </form>
</body>
</html>
