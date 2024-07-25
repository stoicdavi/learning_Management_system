<?php
session_start();
include 'connect.php';

// Check if user is logged in and is a student
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit;
}

// Fetch student ID
$student_id = $_SESSION['student_id'];

// Handle course enrollment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];

    if (!empty($course_id)) {
        // Check if student is already enrolled
        $check_sql = "SELECT * FROM enrollments WHERE stud_id = $student_id AND course_id = '$course_id'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows == 0) {
            // Enroll the student
            $sql = "INSERT INTO enrollments (stud_id, course_id) VALUES ($student_id, '$course_id')";
            if ($conn->query($sql) === TRUE) {
                echo 'Enrolled successfully!';
            } else {
                echo 'Error: ' . $conn->error;
            }
        } else {
            echo 'You are already enrolled in this course.';
        }
    } else {
        echo 'Please select a course.';
    }
}

// Fetch available courses
$sql = 'SELECT * FROM course';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">LMS</a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">back</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">View Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="enroll.php">Enroll in Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container mt-5">
        <h1>Enroll in Course</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="course_id">Select Course:</label>
                <select id="course_id" name="course_id" class="form-control" required>
                    <option value="">Select a course</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['course_id']) . '">' . htmlspecialchars($row['course_name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No courses available</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enroll</button>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
