<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['old_input'], $_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - Sea Tales Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Sea Tales Restaurant in Chennai for reservations, events, or inquiries. We're here to serve you!">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="images/logo.png">
    <style>
        :root {
            --primary-color: #57c5b6;
            --secondary-color: #159895;
            --accent-color: #1a73e8;
            --dark-color: #0a192f;
            --light-color: #f8f9fa;
            --text-color: #333;
            --text-light: #6c757d;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .header3 {
            background-color: var(--dark-color);
            color: white;
            padding: 1rem 0;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-links {
            display: flex;
        }

        .nav-links ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            font-size: 1rem;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .hambar, .closebar {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: white;
        }

        .contact-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            animation: fadeIn 0.6s ease-out;
        }

        .contact-info,
        .contact-form-section {
            flex: 1;
            min-width: 0;
            padding: 1.5rem;
        }

        .contact-header,
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .contact-hero-image,
        .form-hero-image {
            width: 100%;
            height: auto;
            max-height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.5s ease;
        }

        .contact-hero-image:hover,
        .form-hero-image:hover {
            transform: scale(1.02);
        }

        h2 {
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .contact-item {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid #e9ecef;
        }

        .contact-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .location-card {
            position: relative;
        }

        .map-container {
            position: relative;
            margin: 1rem 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .map-image {
            width: 100%;
            height: auto;
            min-height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .map-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .map-overlay:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .transport-options {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .transport-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.9rem;
            color: var(--text-light);
            min-width: 80px;
        }

        .transport-icon i {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .contact-methods {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .contact-method {
            flex: 1;
            min-width: 0;
        }

        .method-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .method-header i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .call-button,
        .whatsapp-button,
        .email-button,
        .copy-button,
        .submit-button {
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .call-button {
            background: #4CAF50;
            color: white;
        }

        .call-button:hover {
            background: #3d8b40;
            transform: translateY(-2px);
        }

        .whatsapp-button {
            background: #25D366;
            color: white;
        }

        .whatsapp-button:hover {
            background: #1da851;
            transform: translateY(-2px);
        }

        .email-button {
            background: #1a73e8;
            color: white;
        }

        .email-button:hover {
            background: #1557b0;
            transform: translateY(-2px);
        }

        .copy-button {
            background: #f1f1f1;
            color: #333;
        }

        .copy-button:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .staff-image,
        .email-image {
            margin-top: 1rem;
            overflow: hidden;
            border-radius: 8px;
        }

        .staff-image img,
        .email-image img {
            width: 100%;
            height: auto;
            min-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.5s ease;
        }

        .staff-image:hover img,
        .email-image:hover img {
            transform: scale(1.05);
        }

        .image-caption {
            font-size: 0.8rem;
            text-align: center;
            margin-top: 0.5rem;
            color: var(--text-light);
        }

        .social-section {
            margin-top: 2rem;
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 150px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .social-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .social-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .social-card:hover img {
            transform: scale(1.1);
        }

        .social-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .social-card:hover .social-info {
            background: rgba(0, 0, 0, 0.9);
        }

        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            color: var(--text-color);
            transition: var(--transition);
            font-family: inherit;
            font-size: 0.95rem;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(87, 197, 182, 0.2);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-button {
            background: var(--primary-color);
            color: white;
            margin: 1rem auto 0;
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
        }

        .submit-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .response-time {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: var(--text-light);
        }

        .response-time i {
            color: var(--primary-color);
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
            font-weight: 500;
            text-align: center;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 100;
        }

        .fab:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px);
            transition: var(--transition);
            max-height: 90vh;
            overflow-y: auto;
        }

        .popup-overlay.active .popup-form {
            transform: translateY(0);
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
        }

        .close-btn:hover {
            color: var(--text-color);
        }

        .foot {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
            width: 100%;
        }

        .foot p {
            margin: 0.5rem 0;
            color: var(--light-color);
        }

        .ABOUT {
            padding: 3rem 1rem;
            text-align: center;
            background-color: white;
            margin-top: 2rem;
        }

        .ABOUT h1 {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .ABOUT p {
            max-width: 800px;
            margin: 0 auto 2rem;
            color: var(--text-color);
            font-size: 1rem;
            line-height: 1.6;
            padding: 0 1rem;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .icon-container a {
            color: var(--primary-color);
            font-size: 1.8rem;
            transition: var(--transition);
        }

        .icon-container a:hover {
            color: var(--secondary-color);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 70%;
                height: 100vh;
                background-color: var(--dark-color);
                flex-direction: column;
                transition: var(--transition);
                z-index: 1001;
                padding-top: 4rem;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links ul {
                flex-direction: column;
                padding: 1rem;
                width: 100%;
            }

            .nav-links li {
                margin: 1rem 0;
                width: 100%;
            }

            .nav-links a {
                display: block;
                padding: 0.5rem 1rem;
                font-size: 1.1rem;
            }

            .hambar, .closebar {
                display: block;
                z-index: 1002;
            }

            .closebar {
                position: fixed;
                top: 1.5rem;
                right: 1.5rem;
            }

            .contact-container {
                flex-direction: column;
                margin: 1rem;
                padding: 0.5rem;
                gap: 1rem;
            }

            .contact-info,
            .contact-form-section {
                padding: 1rem;
            }

            .contact-methods {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: row;
            }

            .social-grid {
                grid-template-columns: 1fr;
            }

            .contact-hero-image,
            .form-hero-image {
                height: auto;
                max-height: 200px;
            }

            .fab {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                bottom: 1rem;
                right: 1rem;
            }

            .contact-form {
                padding: 1rem;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 0.7rem;
            }

            .submit-button {
                padding: 0.7rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .ABOUT h1 {
                font-size: 1.8rem;
            }

            .ABOUT p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .transport-options {
                flex-direction: column;
                align-items: center;
            }

            .transport-icon {
                min-width: 100%;
                padding: 0.5rem 0;
            }

            .action-buttons {
                flex-direction: column;
            }

            .call-button,
            .whatsapp-button,
            .email-button,
            .copy-button {
                width: 100%;
                justify-content: center;
            }

            .popup-form {
                padding: 1.5rem;
            }

            .nav-links {
                width: 80%;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <section class="header3">
        <nav>
            <a href="index.html"><img src="images/logo.png" alt="Sea Tales Logo" style="height: 50px;"></a>
                 
            <div class="nav-links" id="navLinks">
                <div class="closebar" onclick="hideMenu()">
                    <i class="bi bi-x close"></i>
                </div>
                <ul class="sidebar">
                    <li><a href="./index.html">HOME</a></li>
                    <li><a href="./pakages.php">BOOK A TABLE</a></li>
                    <li><a href="./restuarant.html">MENU</a></li>
                    
                    <li><a href="./about.html">ABOUT</a></li>
                </ul>
            </div>
            <div class="hambar" onclick="showMenu()">
                <i class="bi bi-list ham"></i>
            </div>
        </nav>
    </section>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="contact-container">
        <div class="contact-info">
            <div class="contact-header">
                <img src="./images/DKP00033.JPG" alt="Sea Tales Restaurant" class="contact-hero-image">
                <h2>Visit Us Today</h2>
                <p class="contact-intro">Experience the perfect blend of coastal flavors and warm hospitality at our Chennai location. Our team is ready to welcome you!</p>
            </div>

            <div class="contact-item location-card">
                <div class="contact-icon-text">
                    <i class="bi bi-geo-alt-fill"></i>
                    <h3>Our Location</h3>
                </div>
                <p>Sea Tales Restaurant, 5/107, Jagajeevanram Ave, Injambakkam, Chennai, Tamil Nadu, 600115</p>

                <div class="map-container">
                    <img src="./images/maps1.jpg" alt="Restaurant location map" class="map-image">
                    <div class="map-overlay" onclick="openGoogleMaps()">
                        <i class="bi bi-arrow-up-right-square"></i>
                        <span>Open in Maps</span>
                    </div>
                </div>

                <div class="transport-options">
                    <div class="transport-icon">
                        <i class="bi bi-car-front-fill"></i>
                        <span>Parking available</span>
                    </div>
                    <div class="transport-icon">
                        <i class="bi bi-bus-front"></i>
                        <span>Bus stop 200m away</span>
                    </div>
                    <div class="transport-icon">
                        <i class="bi bi-taxi-front"></i>
                        <span>Taxi drop-off</span>
                    </div>
                </div>
            </div>

            <div class="contact-item contact-methods">
                <div class="contact-method">
                    <div class="method-header">
                        <i class="bi bi-telephone"></i>
                        <h3>Call Us</h3>
                    </div>
                    <p class="phone-number">+91 90434 2424</p>
                    <p class="hours">Monday to Saturday, 10am to 6pm</p>

                    <div class="action-buttons">
                        <button class="call-button" onclick="callRestaurant()">
                            <i class="bi bi-telephone-outbound"></i> Call Now
                        </button>
                        <button class="whatsapp-button" onclick="openWhatsApp()">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </button>
                    </div>

                    <div class="staff-image">
                        <img src="./images/friendlystaff.jpeg" alt="Our friendly staff">
                        <p class="image-caption">Our team is ready to assist you</p>
                    </div>
                </div>

                <div class="contact-method">
                    <div class="method-header">
                        <i class="bi bi-envelope"></i>
                        <h3>Email Us</h3>
                    </div>
                    <p class="email-address">seatalesrestaurant@gmail.com</p>
                    <p class="email-prompt">For reservations, events, or special requests</p>

                    <div class="action-buttons">
                        <button class="email-button" onclick="openEmailClient()">
                            <i class="bi bi-envelope-open"></i> Send Email
                        </button>
                        <button class="copy-button" onclick="copyEmail()">
                            <i class="bi bi-clipboard"></i> Copy Email
                        </button>
                    </div>

                    <div class="email-image">
                        <img src="./images/serviceteam.jpeg" alt="Customer service team">
                        <p class="image-caption">We respond within 24 hours</p>
                    </div>
                </div>
            </div>

            <div class="social-section">
                <h3>Connect With Us Online</h3>
                <p>Follow us for daily specials, events, and behind-the-scenes</p>

                <div class="social-grid">
                    <a href="https://www.instagram.com/sea_tales_restaurant" class="social-card" target="_blank">
                        <img src="./images/feed1.jpg" alt="Instagram feed">
                        <div class="social-info">
                            <i class="bi bi-instagram"></i>
                            <span>@sea_tales_restaurant</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/SeaTalesRestaurant" class="social-card" target="_blank">
                        <img src="./images/facebookpage.jpg" alt="Facebook page">
                        <div class="social-info">
                            <i class="bi bi-facebook"></i>
                            <span>SeaTalesRestaurant</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="contact-form-section">
            <div class="form-header">
                <img src="./images/ourteam.jpeg" alt="Our contact team" class="form-hero-image">
                <h2>Send Us a Message</h2>
                <p>Have a special request? Planning an event? We'd love to hear from you!</p>
            </div>
            
            <form class="contact-form" id="contactForm" action="send_mail.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name*</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name" value="<?php echo htmlspecialchars($old_input['name'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address*</label>
                    <input type="email" id="email" name="email" required placeholder="your@email.com" value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="+91 ________" value="<?php echo htmlspecialchars($old_input['phone'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject*</label>
                    <select id="subject" name="subject" required>
                        <option value="" disabled selected>Select a subject</option>
                        <option value="Table Reservation" <?php echo (isset($old_input['subject']) && $old_input['subject'] === 'Table Reservation') ? 'selected' : ''; ?>>Table Reservation</option>
                        <option value="Private Event" <?php echo (isset($old_input['subject']) && $old_input['subject'] === 'Private Event') ? 'selected' : ''; ?>>Private Event</option>
                        <option value="Feedback/Suggestion" <?php echo (isset($old_input['subject']) && $old_input['subject'] === 'Feedback/Suggestion') ? 'selected' : ''; ?>>Feedback/Suggestion</option>
                        <option value="Other Inquiry" <?php echo (isset($old_input['subject']) && $old_input['subject'] === 'Other Inquiry') ? 'selected' : ''; ?>>Other Inquiry</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message*</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Type your message here..."><?php echo htmlspecialchars($old_input['message'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="submit-button">
                        <i class="bi bi-send-fill"></i> Send Message
                    </button>
                    <p class="response-time">
                        <i class="bi bi-clock"></i> We typically respond within 24 hours
                    </p>
                </div>
            </form>
        </div>
    </div>

    <section class="ABOUT">
        <center>
            <h1> Follow Us </h1>
            <p>
                Nestled in the heart of Chennai, Sea Tales Restaurant offers a multi-cuisine dining experience that blends exceptional flavors, elegant ambiance, and unforgettable moments. Whether you're planning a romantic dinner, a family gathering, a birthday celebration, or a corporate event, we provide the perfect setting for every occasion.
            </p>
            <div class="bootstrap-icons">
                <div class="icon-container">
                    <a href="https://wa.me/9043424243" target="_blank" aria-label="WhatsApp"> <i class="bi bi-whatsapp"></i></a>
                    <a href="https://www.facebook.com/people/Sea-Tales-Restaurant/100089425352549/" target="_blank" aria-label="Facebook"> <i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/sea_tales_restaurant?igsh=NTc4MTIwNjQ2YQ==" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="mailto:seatalesrestaurant@gmail.com" target="_blank" aria-label="Email"> <i class="bi bi-envelope"></i></a>
                    <a href="https://www.youtube.com/channel/UCD4HE02WWjtUpHycunIROyw" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </center>
    </section>

    <button class="fab" id="fabBtn" aria-label="Quick Contact">
        <i class="fas fa-phone-alt"></i>
    </button>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-form">
            <span class="close-btn" id="closePopup">&times;</span>
            <h2>Quick Contact</h2>
            <form id="quickContactForm">
                <div class="form-group">
                    <label for="quickName">Name:</label>
                    <input type="text" id="quickName" required>
                </div>
                <div class="form-group">
                    <label for="quickPhone">Phone:</label>
                    <input type="tel" id="quickPhone" required>
                </div>
                <div class="form-group">
                    <label for="quickMessage">Message:</label>
                    <textarea id="quickMessage" rows="3" required></textarea>
                </div>
                <button type="submit" class="submit-button">
                    <i class="bi bi-send-fill"></i> Send
                </button>
            </form>
        </div>
    </div>

    <div class="foot">
        <footer>
            <p>Thanks and regards</p>
            <p>Sea Tales Restaurant</p>
            <p>&copy; <?php echo date('Y'); ?> All Rights Reserved</p>
        </footer>
    </div>

    <script>
        // Menu toggle functions
        function showMenu() {
            document.getElementById('navLinks').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideMenu() {
            document.getElementById('navLinks').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', hideMenu);
        });

        // Form submission with AJAX
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = this.querySelector('.submit-button');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass"></i> Sending...';
            submitBtn.disabled = true;

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success';
                        alertDiv.textContent = data.success;
                        document.body.insertBefore(alertDiv, document.querySelector('.contact-container'));
                        alertDiv.scrollIntoView({ behavior: 'smooth' });
                        this.reset();
                    } else if (data.errors) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'alert alert-error';
                        data.errors.forEach(error => {
                            const p = document.createElement('p');
                            p.textContent = error;
                            errorDiv.appendChild(p);
                        });
                        document.body.insertBefore(errorDiv, document.querySelector('.contact-container'));
                        errorDiv.scrollIntoView({ behavior: 'smooth' });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });

        // Quick contact popup
        const fabBtn = document.getElementById('fabBtn');
        const popupOverlay = document.getElementById('popupOverlay');
        const closePopup = document.getElementById('closePopup');

        fabBtn.addEventListener('click', () => {
            popupOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closePopup.addEventListener('click', () => {
            popupOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        popupOverlay.addEventListener('click', (e) => {
            if (e.target === popupOverlay) {
                popupOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        document.getElementById('quickContactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We will contact you shortly.');
            this.reset();
            popupOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Contact methods functions
        function callRestaurant() {
            window.location.href = 'tel:+91904342424';
        }

        function openWhatsApp() {
            window.open('https://wa.me/91904342424', '_blank');
        }

        function openEmailClient() {
            window.location.href = 'mailto:seatalesrestaurant@gmail.com';
        }

        function copyEmail() {
            navigator.clipboard.writeText('seatalesrestaurant@gmail.com')
                .then(() => alert('Email copied to clipboard!'))
                .catch(err => console.error('Could not copy text: ', err));
        }

        function openGoogleMaps() {
            const address = encodeURIComponent('Sea Tales Restaurant, 5/107, Jagajeevanram Ave, Injambakkam, Chennai, Tamil Nadu, 600115');
            window.open(`https://www.google.com/maps/search/?api=1&query=${address}`, '_blank');
        }

        // Close popup when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                popupOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html>