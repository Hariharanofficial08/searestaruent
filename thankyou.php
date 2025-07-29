<?php
// thankyou.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Sea Tales Restaurant</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .thank-you-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        .btn {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #c0392b;
        }
    </style>
</head>   
<body>
    <div class="thank-you-container">
        <h1>Thank You for Your Booking!</h1>
        <p>We've received your reservation request for <strong><?= htmlspecialchars($_SESSION['package'] ?? ''); ?></strong>.</p>
        <p>Our team will contact you shortly at <strong><?= htmlspecialchars($_SESSION['email'] ?? ''); ?></strong> or <strong><?= htmlspecialchars($_SESSION['phone'] ?? ''); ?></strong> to confirm your booking.</p>
        <a href="pakages.php" class="btn">Back to Home</a>
    </div>
</body>
</html>
<?php
// Clear the session data after displaying it
unset($_SESSION['package'], $_SESSION['email'], $_SESSION['phone']);
?>