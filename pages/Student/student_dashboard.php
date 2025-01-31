<?php 
include_once('../connection.php');
session_start();


$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; 
$roll_no = isset($_SESSION['roll_no']) ? $_SESSION['roll_no'] : ''; 
$mobile = isset($_SESSION['mobile']) ? $_SESSION['mobile'] : ''; 


$update_success = isset($_SESSION['update_success']) ? $_SESSION['update_success'] : null;
unset($_SESSION['update_success']); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Dashboard</title>
   <link rel="stylesheet" href="student_dashboard.css">
</head>
<body>
   <div class="sidebar">
      <div class="logo">
         <img src="../../images/profile_logo.jpg" alt="Logo" />
      </div>
      <ul>
         <li><a href="student_dashboard.php">Dashboard</a></li>
         <li><a href="student_form.php">Contact Admin</a></li>
         <li><a href="student_jobs.php">Placement<br>Applications</a></li>
         <li><a href="view_result.php">Placement Results</a></li>
         <li><a href="student_logout.php">Logout</a></li>
      </ul>
   </div>

   <div class="main-content">
      <div class="header">
         <div class="profile">
            <img src="../../images/sample_profile_picture.jpg" alt="Profile Picture">
         </div>
      </div>
      
      <section class="welcome-section">
         <div class="welcome-text">
             <p id="current-date" class="date"></p> 
             <h1>Welcome back, <?php echo htmlspecialchars($name); ?>!</h1>
         </div>
         <div class="welcome-image">
             <img src="../../images/student_avatar.png" alt="Student Avatar">
         </div>
     </section>

     <section class="profile-details">
      <div class="header">
        <h2>Profile Details</h2>
      </div>
  
      <form action="update_mobile.php" method="POST">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
          </div>
  
          <div class="form-group">
            <label for="college-roll">College Roll No:</label>
            <input type="text" id="college-roll" value="<?php echo htmlspecialchars($roll_no); ?>" readonly>
          </div>
        </div>
  
        <div class="form-row">
          <div class="form-group">
            <label for="email">Email ID:</label>
            <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
          </div>
  
          <div class="form-group">
            <label for="mobile">Mobile No:</label>
            <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
          </div>
        </div>
  
        <button type="submit" class="submit-btn">Submit</button>
      </form>
  
    </section>

    <?php if ($update_success): ?>
        <script>
            alert("<?php echo addslashes($update_success); ?>");
        </script>
    <?php endif; ?>

    <script src="student_dashboard_welcome_section.js"></script> 
     
</body>
</html>
