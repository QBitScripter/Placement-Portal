<?php
include_once ('../connection.php');  
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM admin_requests";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error fetching data: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="view_requests.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Submitted Requests</h2>

        
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Issue</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['issue']); ?></td>
                        <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            
            <p class="no-requests-message">No requests found.</p>
        <?php endif; ?>

        <?php
        
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
