<?php
include_once ('../connection.php'); 
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $test_name = $_POST['test_name'];
    $company_name = $_POST['company_name'];
    $qualified = isset($_POST['qualified']) ? 1 : 0; 
    $date = $_POST['date'];

    $job_id = getJobIdByCompanyName($company_name);
    if ($job_id === null) {
        echo "<div class='alert alert-danger'>Error: Job not found for the specified company name.</div>";
        exit(); 
    }

    
    $query = "INSERT INTO job_exam_results (student_id, name, company_name, qualified, test_name, date, job_id) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("isssssi", $student_id, $student_name, $company_name, $qualified, $test_name, $date, $job_id);
        
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Results posted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }

    
    mysqli_close($conn);
}

function getJobIdByCompanyName($company_name) {
    global $conn;

    
    $stmt = $conn->prepare("SELECT job_id FROM jobs WHERE company_name = ?");
    $stmt->bind_param("s", $company_name); 

    
    $stmt->execute();
    $stmt->store_result();
    
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($job_id);
        $stmt->fetch(); 
        $stmt->close();
        return $job_id; 
    } else {
        $stmt->close();
        return null; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Post Student Results</h2>
        <form action="post_results.php" method="POST">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" class="form-control" id="student_name" name="student_name" required>
            </div>
            <div class="form-group">
                <label for="test_name">Test Name:</label>
                <input type="text" class="form-control" id="test_name" name="test_name" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="qualified">Qualified:</label>
                <input type="checkbox" id="qualified" name="qualified" value="1">
                <label for="qualified">Yes (Check if qualified)</label>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Post Results</button>
        </form>
    </div>
    <script>
        <?php if (!empty($message)): ?>
            alert("<?php echo htmlspecialchars($message); ?>");
        <?php endif; ?>
    </script>

</body>
</html>
