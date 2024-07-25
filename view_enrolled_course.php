<?php
session_start();
include 'connect.php';

// Check if user is logged in and is a student
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student' || !isset($_SESSION['student_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch enrolled courses
$student_id = $_SESSION['student_id'];
$sql = "SELECT c.course_name, c.description 
        FROM course c
        JOIN enrollments e ON c.course_id = e.course_id
        WHERE e.stud_id = $student_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">LMS</a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">View Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="enroll.php">Enroll in Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Enrolled Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container text-center mt-5">
        <h1>My Enrolled Courses</h1>
        <?php if ($result->num_rows > 0): ?>
            <ul class="list-group">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <strong><?php echo htmlspecialchars($row['course_name']); ?></strong>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>You are not enrolled in any courses.</p>
        <?php endif; ?>
        <br>
        <a href="student_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
