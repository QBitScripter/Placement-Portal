<?php
/*$servername = "sql311.infinityfree.com";
$username = "if0_37581030";  
$password = "Oh504123";      
$dbname = "if0_37581030_student_portal_db";   
*/


$host='sql311.infinityfree.com';
$db_user='if0_37581030';
$db_password='Oh504123';
$db_name='if0_37581030_student_portal_db';

$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
