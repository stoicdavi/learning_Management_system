<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // 'instructor' or 'student'

    // Server-side validation for password length
    if (strlen($password) < 6) {
        echo 'Password must be at least 6 characters long';
        exit;
    }

    if (!empty($username) && !empty($password) && !empty($role)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($role == 'instructor') {
            $sql = "INSERT INTO staff (instructor_name, password) VALUES ('$username', '$passwordHash')";
        } elseif ($role == 'student') {
            $sql = "INSERT INTO students (stud_name, password) VALUES ('$username', '$passwordHash')";
        } else {
            echo 'Invalid role selected';
            exit;
        }

        if ($conn->query($sql) === TRUE) {
            echo 'Signup successful';
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
    <title>Signup</title>
</head>
<body>
    <h1>Signup</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6">
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="instructor">Instructor</option>
            <option value="student">Student</option>
        </select>
        <br>
        <input type="submit" value="Signup">
    </form>
    <a href="login.php">Already have an account? Login here</a>
</body>
</html>
