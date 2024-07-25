<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch courses
$sql = 'SELECT * FROM course';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">LMS</a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Courses</a>
                    </li>
                    <?php if ($_SESSION['role'] === 'instructor'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="add_course.php">Add Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_student.php">Add Student</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container text-center mt-5">
        <h1>Available Courses</h1>
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
            <p>No courses available</p>
        <?php endif; ?>

        <br>
        <a href="<?php echo $_SESSION['role'] === 'instructor' ? 'instructor_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-primary">Back to Dashboard</a>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
