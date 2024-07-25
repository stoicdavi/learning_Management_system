<?php
session_start();
include 'connect.php';

// Check if user is logged in and handle redirection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Check if user is an instructor
        $sql = "SELECT * FROM staff WHERE instructor_name = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password if needed
            // if (password_verify($password, $row['password_hash'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['instructor_id'] = $row['instructor_id'];
            $_SESSION['role'] = 'instructor';
            header('Location: instructor_dashboard.php');
            exit;
            // }
        } else {
            // Check if user is a student
            $sql = "SELECT * FROM students WHERE stud_name = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Verify password if needed
                // if (password_verify($password, $row['password_hash'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['student_id'] = $row['stud_id'];
                $_SESSION['role'] = 'student';
                header('Location: student_dashboard.php');
                exit;
                // }
            } else {
                echo 'Invalid credentials';
            }
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
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
</body>
</html>
