<?php
include_once '../connection.php';  
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: student_login.php");
    exit();
}


// Get the logged-in student's email 
$student_email = $_SESSION['email'];

// Fetch student's CGPA from the database
$query = "SELECT overall_sgpa FROM students WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$student_sgpa = $row['overall_sgpa'];

// Fetch jobs where the required CGPA is less than or equal to the student's CGPA
$jobs_query = "SELECT * FROM jobs WHERE min_cgpa <= ?";
$stmt_jobs = $conn->prepare($jobs_query);
$stmt_jobs->bind_param("d", $student_sgpa);
$stmt_jobs->execute();
$jobs_result = $stmt_jobs->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligible Jobs</title>
    <link rel="stylesheet" href="student_jobs.css">
    <style>
        /* Include the modified CSS here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Eligible Jobs Based on Your CGPA</h1>
        <div class="cgpa">Your CGPA: <?php echo $student_sgpa; ?></div>

        <?php if ($jobs_result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Application Deadline</th>
                </tr>
                <?php while ($job = $jobs_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $job['job_title']; ?></td>
                    <td><?php echo $job['company_name']; ?></td>
                    <td><?php echo $job['description']; ?></td>
                    <td><?php echo $job['location']; ?></td>
                    <td><?php echo $job['application_deadline']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <div class="no-jobs-message">
                <p>No jobs available for your CGPA at the moment.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php
    // Close the database connection
    $stmt->close();
    $stmt_jobs->close();
    $conn->close();
    ?>
</body>
</html>
