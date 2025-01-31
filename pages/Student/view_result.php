<?php
include_once '../connection.php';
session_start(); 

if (!isset($_SESSION['id'])) {
    
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['id']; 


$sql = "SELECT r.test_name, r.qualified AS qualified, j.company_name, r.date 
        FROM job_exam_results r 
        JOIN jobs j ON r.job_id = j.job_id 
        WHERE r.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Results</h2>
        
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Test Name</th>
                    <th>Qualified</th>
                    <th>Company Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['test_name']); ?></td>
                        <td><?php echo $row['qualified'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
mysqli_close($conn);
?>
