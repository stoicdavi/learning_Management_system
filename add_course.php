<?php
session_start();
include 'connect.php';

// Check if user is logged in and is an instructor
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'instructor') {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO course (course_id, course_name, instructor_id, description) VALUES ('$course_id', '$course_name', {$_SESSION['instructor_id']}, '$description')";
    if ($conn->query($sql) === TRUE) {
        echo 'Course added successfully.';
    } else {
        echo 'Error: ' . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <h1>Add a New Course</h1>
    <form method="post" action="">
        <label for="course_id">Course ID:</label>
        <input type="text" id="course_id" name="course_id" required>
        <br>
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <input type="submit" value="Add Course">
    </form>
    <a href="instructor_dashboard.php">Back to Dashboard</a>
</body>
</html>
