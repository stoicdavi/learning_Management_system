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
        $error = 'Password must be at least 6 characters long';
    } elseif (!empty($username) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO students (stud_name, password) VALUES ('$username', '$passwordHash')";
        if ($conn->query($sql) === TRUE) {
            $success = 'Student added successfully';
        } else {
            $error = 'Error: ' . $conn->error;
        }
    } else {
        $error = 'Please fill in all fields';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 100px;
        }
        .form-container h1 {
            margin-bottom: 20px;
        }
        .form-container .form-group {
            margin-bottom: 15px;
        }
        .form-container .form-control {
            border-radius: 4px;
        }
        .form-container .btn {
            border-radius: 4px;
        }
        .form-container .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Add Student</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Student</button>
        </form>
        
        <a href="instructor_dashboard.php" class="btn btn-secondary btn-block mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
