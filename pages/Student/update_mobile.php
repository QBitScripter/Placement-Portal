<?php
include_once("../connection.php");
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mobile'])) {
        $new_mobile_number = $_POST['mobile'];

        
        if (!preg_match('/^[0-9]{10}$/', $new_mobile_number)) {
            $_SESSION['update_error'] = "Invalid mobile number format. Please enter a 10-digit number.";
            header("Location: student_dashboard.php");
            exit();
        }

        
        $email = $_SESSION['email'];

        $update_query = "UPDATE students SET mobile = ? WHERE email = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ss", $new_mobile_number, $email);

        if ($stmt->execute()) {
            $_SESSION['mobile'] = $new_mobile_number;
            $_SESSION['update_success'] = "Mobile number updated successfully!";
            header("Location: student_dashboard.php");
            exit(); 
        } else {
            $_SESSION['update_error'] = "Error updating mobile number: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['update_error'] = "Mobile number is not set.";
        exit();
    }
}

$conn->close();
?>
