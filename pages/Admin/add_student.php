<?php
include_once('../connection.php'); 
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $dept = $_POST['dept'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roll_no = $_POST['roll_no'];
    $mobile = $_POST['mobile'];
    $overall_sgpa = $_POST['overall_sgpa'];
    $password = $_POST['password'];

    $query = "INSERT INTO students (id, dept, name, email, roll_no, mobile, overall_sgpa, password) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssss", $id, $dept, $name, $email, $roll_no, $mobile, $overall_sgpa, $password);
        
        if ($stmt->execute()) {
            echo "<script>displayPopup('Student added successfully!');</script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="add_student.css">
</head>
<body>
    <div class="container mt-5 student-form">
        <h2 class="text-center mb-4">Add New Student</h2>
        <form action="add_student.php" method="POST">
            <div class="form-group">
                <label for="id">Student ID <span class="required">*</span></label>
                <input type="text" class="form-control" id="id" name="id" required placeholder="Ex: MCA2382001">
            </div>
            <div class="form-group">
                <label for="dept">Department <span class="required">*</span></label>
                <input type="text" class="form-control" id="dept" name="dept" required placeholder="Ex: MCA">
            </div>
            <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Ex: Arjun Kumar">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Ex: arjun.kumar.mca25@futuretech.edu.in">
            </div>
            <div class="form-group">
                <label for="roll_no">Roll Number <span class="required">*</span></label>
                <input type="text" class="form-control" id="roll_no" name="roll_no" required placeholder="Ex: 2382001">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile <span class="required">*</span></label>
                <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="Ex: 9876543210">
            </div>
            <div class="form-group">
                <label for="overall_sgpa">Overall SGPA <span class="required">*</span></label>
                <input type="number"  class="form-control" id="overall_sgpa" name="overall_sgpa" required placeholder="Ex: 7.5">
            </div>
            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Ex: pass01">
            </div>
            <button type="submit" class="btn btn-primary btn-block submit-btn">Add Student</button>
        </form>
        
        <a href="admin_dashboard.php" class="btn btn-secondary btn-home">Home</a>
    </div>
   
   
    <script>
        // Check if there's a message to display
        <?php if (!empty($message)): ?>
            alert("<?php echo htmlspecialchars($message); ?>");
        <?php endif; ?>
    </script>



</body>
</html>
