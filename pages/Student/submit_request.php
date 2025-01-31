<?php
include_once '../connection.php'; 
session_start(); 

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $job_title = mysqli_real_escape_string($conn, $_POST['title']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $min_cgpa = mysqli_real_escape_string($conn, $_POST['required_cgpa']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

    $query = "INSERT INTO jobs (job_title, company_name, description, min_cgpa, application_deadline) 
              VALUES ('$job_title', '$company', '$description', '$min_cgpa', '$deadline')";

    if (mysqli_query($conn, $query)) {
        $message = "Job added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="add_jobs.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add a New Job</h2>
        <form action="add_job.php" method="POST">
            <div class="form-group">
                <label for="title">Job Title:<span class="required">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="company">Company Name:<span class="required">*</span></label>
                <input type="text" class="form-control" id="company" name="company" required>
            </div>

            <div class="form-group">
                <label for="description">Job Description:<span class="required">*</span></label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="required_cgpa">Required CGPA:<span class="required">*</span></label>
                <input type="number" step="0.01" class="form-control" id="required_cgpa" name="required_cgpa" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>

            <div class="form-group">
                <label for="deadline">Application Deadline:<span class="required">*</span></label>
                <input type="date" class="form-control" id="deadline" name="deadline" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add Job</button>
        </form>
        
        <p class="mandatory-message">Fields marked with <span class="required">*</span> are mandatory.</p>
        
        <div class="text-center mt-4">
            <a href="admin_dashboard.php" class="btn btn-success">Home</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (!empty($message)): ?>
                alert("<?php echo htmlspecialchars($message); ?>");
            <?php endif; ?>
        });
    </script>
</body>
</html>
