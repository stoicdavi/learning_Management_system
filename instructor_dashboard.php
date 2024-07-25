<?php
session_start();
include 'connect.php';

// Check if user is logged in and is an instructor
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'instructor') {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch instructor details
$instructor_id = $_SESSION['instructor_id'];
$sql = "SELECT * FROM staff WHERE instructor_id = $instructor_id";
$result = $conn->query($sql);
$instructor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">LMS</a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="instructor_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">View Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_course.php">Add Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_student.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container text-center mt-5">
        <h1>Welcome, <?php echo htmlspecialchars($instructor['instructor_name']); ?>!</h1>
        <p>Your instructor dashboard is ready. Use the links above to manage courses and students.</p>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
