<?php
session_start();


echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$login_session = $_SESSION['admin_logged_in'];
?>
