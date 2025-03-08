<?php
session_start(); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';


$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars(trim($_POST['message']));


if (empty($name) || empty($email) || empty($message)) {
    $_SESSION['error'] = "All fields are required.";
    header('Location: ../pages/contact.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email address.";
    header('Location: ../pages/contact.php');
    exit;
}

$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; 
    $mail->Password = 'your-email-password'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    
    $mail->setFrom($email, $name);
    $mail->addAddress('info@abcproperty.com', 'ABC Property Management');

    
    $mail->isHTML(true);
    $mail->Subject = "New Contact Us Message from $name";
    $mail->Body    = "
    <html>
    <body>
        <h2>New Contact Us Message</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong><br/>$message</p>
    </body>
    </html>
    ";

    
    $mail->send();
    $_SESSION['success'] = "Thank you for contacting us. We will get back to you soon.";
    header('Location: ../pages/contact.php?status=success');
} catch (Exception $e) {
    $_SESSION['error'] = "Oops! Something went wrong. Please try again later. Error: {$mail->ErrorInfo}";
    header('Location: ../pages/contact.php?status=error');
}
?>
