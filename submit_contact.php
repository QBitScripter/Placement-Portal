<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        echo "<div class='error-message'>All fields are required!</div>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='submit_contact.css'>
            <title>Submission Successful</title>
        </head>
        <body>
            <div class='submission-container'>
                <h1>Submission Successful!</h1>
                <p>Thank you for contacting us, <strong>" . $name . "</strong>!<br>We will get back to you at <strong>" . $email . "</strong> soon.</p>
                <a href='index.html' class='back-link'>Back to Homepage</a>
            </div>
        </body>
        </html>
        ";
    }
} else {
    header("Location: contact_us.html");
    exit();
}
?>
