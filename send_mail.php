<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';
// Sanitize input
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$phone = sanitize($_POST['phone'] ?? '');
$subject = sanitize($_POST['subject'] ?? '');
$message = sanitize($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address.'); window.history.back();</script>";
    exit;
}

// Send email via PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'larunprasathp11054@gmail.com'; // Your SMTP username
    $mail->Password   = 'ynnuvuxifepczepr'; // Your SMTP/app password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('larunprasathp11054@example.com', 'Site Admin'); // Your destination email

    // Email content
    $mail->isHTML(false);
    $mail->Subject = "Contact Form: $subject";
    $mail->Body    = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>";
   echo $mail->Body;
    $mail->send();
    echo "<script>
    alert('Thank you! Your booking has been submitted.');
    window.location.href = 'contact.php';
    </script>";
    exit;
} catch (Exception $e) {
    echo "<script>
    alert('Error sending email: {$mail->ErrorInfo}');
    window.history.back();
     </script>";  
}
?>
