<?php
// Include connection
include ('../connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $query = "SELECT id, name, roll_no, mobile, password FROM students WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $roll_no, $mobile, $db_password);
        $stmt->fetch();

        
        if ($password === $db_password) {
            
            session_regenerate_id(true);

            $_SESSION['student_logged_in'] = true; 
            $_SESSION['login_user'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['roll_no'] = $roll_no; 
            $_SESSION['mobile'] = $mobile; 
            $_SESSION['id']=$id;

            
            header("Location: student_dashboard.php");
            exit(); 
        } else {
            
            echo "Invalid login credentials";
        }
    } else {
        // User not found
        echo "User Not Found";
    }

    
    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTU | Student Login</title>
    <link rel="stylesheet" href="student_login.css">
</head>
<body>
    <section id="login-area">
        <div class="login-container">
            <img src="../../images/logo2.png.jfif" alt="logo" width="120px">
            <h2>Login</h2>
            <form action="student_login.php" method="POST">
                <div class="input-box">
                    <label for="email">College Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your college email" required>
                </div>
                <div class="input-box">
                    <label for="Password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required pattern="[a-zA-Z0-9]+" title="alphanumeric characters only" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

    </section>
</body>
</html>