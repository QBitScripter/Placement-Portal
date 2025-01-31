<?php
include_once("../connection.php");
session_start();

//so that user can't get email without login
if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: admin_login.php"); 
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $_POST['email']; 
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, username, email, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $email, $db_password);
        $stmt->fetch();

    
        if ($password === $db_password) {
            session_regenerate_id(true);

            
            $_SESSION['login_user']=$email;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['admin_logged_in'] = true;

        
            header("Location: admin_dashboard.php");
            exit(); 
        } else {
            echo "Invalid login credentials";
        }
    } else {
        echo "Invalid login credentials";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTU Placements | Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../images/logo2.png.jfif" alt="FTU Placements Logo">
        </div>
    </header>

    <main>
        <section id="headings">
            <h1>Admin/Staff Login</h1>
            <p>Are you a student? <a href="../Student/student_login.php">Login here</a></p>
        </section>

        <section id="login-area">
            <form action="admin_login.php" method="post">
                <div class="input-box">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Enter your official email" required>
                </div>
                <div class="input-box">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required pattern="[a-zA-Z0-9]+" title="Alphanumeric characters only">
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </section>
    </main>
    <script>
        window.onload = function() {
            document.getElementById("email").value = "";
        };
    </script>
</body>
</html>
