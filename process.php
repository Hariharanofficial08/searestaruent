<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

$old_input = [];
$errors = [];
$fields = ['name', 'email', 'phone', 'date', 'time', 'guests', 'message', 'package'];

foreach ($fields as $field) {
    $old_input[$field] = sanitize($_POST[$field] ?? '');
}

// Validation
if (empty($old_input['name'])) $errors['name'] = 'Name is required.';
if (empty($old_input['email']) || !filter_var($old_input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Valid email is required.';
}
if (empty($old_input['phone'])) $errors['phone'] = 'Phone number is required.';
if (empty($old_input['date'])) $errors['date'] = 'Date is required.';
if (empty($old_input['time'])) $errors['time'] = 'Time is required.';
if (empty($old_input['guests']) || !filter_var($old_input['guests'], FILTER_VALIDATE_INT, ["options" => ["min_range"=>1, "max_range"=>20]])) {
    $errors['guests'] = 'Please enter a guest number between 1 and 20.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_input'] = $old_input;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Store booking data in session for thank you page
$_SESSION['booking_data'] = $old_input;

// Email content
$admin_subject = 'New Booking Request: ' . $old_input['name'];
$customer_subject = 'Booking Confirmation';

$admin_body = "New Booking Details:\n\n"
    . "Full Name: {$old_input['name']}\n"
    . "Email: {$old_input['email']}\n"
    . "Phone: {$old_input['phone']}\n"
    . "Date: {$old_input['date']}\n"
    . "Time: {$old_input['time']}\n"
    . "Number of Guests: {$old_input['guests']}\n"
    . "Package: {$old_input['package']}\n"
    . "Special Requests: " . ($old_input['message'] ? $old_input['message'] : 'None') . "\n\n"
    . "Received: " . date('Y-m-d H:i:s');

$customer_body = "Dear {$old_input['name']},\n\n"
    . "Thank you for your booking with us! Here are your reservation details:\n\n"
    . "Booking Reference: #" . uniqid() . "\n"
    . "Date: {$old_input['date']}\n"
    . "Time: {$old_input['time']}\n"
    . "Number of Guests: {$old_input['guests']}\n"
    . "Package: {$old_input['package']}\n"
    . "Special Requests: " . ($old_input['message'] ? $old_input['message'] : 'None') . "\n\n"
    . "We'll contact you shortly to confirm your reservation.\n\n"
    . "Best regards,\n"
    . "Your Restaurant Team";

// Send emails via PHPMailer
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'larunprasathp11054@gmail.com'; // Your Gmail address
    $mail->Password   = 'ynnuvuxifepczepr'; // Use App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // 1. Send to admin
    $mail->setFrom($old_input['email'], $old_input['name']);
    $mail->addAddress('larunprasathp11054@gmail.com', 'Booking Admin');
    $mail->addReplyTo($old_input['email'], $old_input['name']);
    $mail->Subject = $admin_subject;
    $mail->Body = $admin_body;
    $mail->send();

    // 2. Send to customer
    $mail->clearAddresses(); // Clear previous recipients
    $mail->setFrom('larunprasathp11054@gmail.com', 'Your Restaurant');
    $mail->addAddress($old_input['email'], $old_input['name']);
    $mail->Subject = $customer_subject;
    $mail->Body = $customer_body;
    $mail->send();

    // Redirect to thank you page
    header('Location: thankyou.php');
    exit;
    
} catch (Exception $e) {
    $_SESSION['email_error'] = 'Error sending confirmation email. Please contact us directly.';
    error_log('Mailer Error: ' . $mail->ErrorInfo);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}