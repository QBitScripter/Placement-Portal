<?php

session_start();
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: student_login.php"); 
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request Form</title>
  <link rel="stylesheet" href="student_form.css"> 
</head>
<body>

  <div class="form-container">
    <h2>Request Form</h2>
    <form action="submit_request.php" method="POST">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="email">College E-mail ID:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="issue">Issue In Description:</label>
        <textarea id="issue" name="issue" rows="4" required></textarea>
      </div>

      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>

</body>
</html>
