<?php 
include_once('../connection.php');  
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
$name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../../images/logo2.png.jfif" alt="Logo" />
        </div>
        <ul>
            <li><a href="view_requests.php">View Requests</a></li>
            <li><a href="add_job.php">Job Posting</a></li>
            <li><a href="add_student.php">Add Student</a></li>
            <li><a href="view_student.php">View Student Data</a></li>
            <li><a href="post_results.php">Result Update</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <section class="welcome-section">
        <p id="current-date" class="date"></p> 
        <h1>Welcome back <?php echo htmlspecialchars($name); ?>!</h1>
        <p>You can manage student requests, job postings, and updates.</p>
        </section>

    </div>
    <script src="../Student/student_dashboard_welcome_section.js"></script> 
</body>
</html>
