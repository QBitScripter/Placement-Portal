<?php
   include('../connection.php');
   session_start();

   // Check if the user is logged in
   if (!isset($_SESSION['login_user'])) {
      header("location: student_login.php");
      exit(); // Use exit() to stop further script execution
   }
   
   // Retrieve the logged-in user's email
   $user_check = $_SESSION['login_user'];
   
   // Prepare the SQL statement to fetch user details
   $ses_sql = $conn->prepare("SELECT name FROM students WHERE email = ?");
   $ses_sql->bind_param("s", $user_check);
   $ses_sql->execute();
   $ses_sql->bind_result($login_session);
   $ses_sql->fetch();
   
   // Check if the user session is valid
   if (!isset($login_session)) {
      header("location: student_login.php");
      exit(); // Use exit() to stop further script execution
   }
?>
