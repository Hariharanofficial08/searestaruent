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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Tales Restaurant - Premium Packages</title>
    <link rel="icon" href="images/logo.png">

    <link rel="stylesheet" href="./style.css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        }

        /* Header Styles */
        .header {
            background: linear-gradient(rgba(44, 33, 33, 0.351), rgba(72, 62, 62, 0.395)),
                url('./images/DKP00049.JPG');
            min-height: 50vh;
            width: 100%;
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 87px 20px;
            position: relative;
        }

        .rate p {
            color: #fff;
            font-weight: 400;
        }

        .restaurant-name {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: normal;
        }

        .tagline {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            position: relative;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav img {
            height: 50px;
        }

        .nav-links {
            display: flex;
            justify-content: flex-end;
        }

        .sidebar {
            list-style: none;
            display: flex;
        }

        .sidebar li {
            margin: 0 15px;
        }

        .hambar,
        .closebar {
            display: none;
            cursor: pointer;
            color: white;
            font-size: 1.5rem;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Section Titles */
        .section-title {
            text-align: center;
            margin: 40px 0 30px;
            color: #2c3e50;
            position: relative;
            font-size: 2rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #e74c3c;
        }

        /* Packages Grid */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        /* Package Cards */
        .package-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .package-card:hover {
            transform: translateY(-5px);
        }

        .package-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 4px solid #e74c3c;
        }

        .package-header {
            padding: 20px;
            background: #2c3e50;
            color: white;
        }

        .package-name {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .package-price {
            font-size: 1.8rem;
            font-weight: bold;
            color: #f1c40f;
        }

        .package-price::before {
            content: '₹';
        }

        .package-price span {
            font-size: 1rem;
            color: white;
            font-weight: normal;
        }

        .package-content {
            padding: 20px;
        }

        .inclusions {
            margin: 20px 0;
        }

        .inclusion-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .inclusion-icon {
            margin-right: 10px;
            font-size: 1.2rem;
            min-width: 25px;
        }

        .food-list {
            margin: 15px 0;
            padding-left: 20px;
        }

        .food-list li {
            margin-bottom: 8px;
        }

        /* Booking Form */
        .bookingform {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
            width: 90%;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            height: 150px;
        }

        .submit-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            background: #c0392b;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .btn:hover {
            background: #c0392b;
        }

        /* Contact Section */
        .contact-section {
            text-align: center;
            margin-top: 50px;
            padding: 30px;
            background: #2c3e50;
            color: white;
            border-radius: 10px;
        }
        .contact-section p{
            color: white;
        }
        .contact-item a {
            color: #f1c40f;
            text-decoration: none;
            font-size: 1.2rem;
            display: inline-block;
            margin: 10px 0;
        }

        .contact-item i {
            margin-right: 10px;
        }

        .hours {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background: #2c3e50;
            color: white;
            margin-top: 50px;
        }
        .foot p{
            color: white;
        }

        /* Success/Error Messages */
        .success-message {
            color: #27ae60;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            padding: 15px;
            background: rgba(39, 174, 96, 0.1);
            border-radius: 5px;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            padding: 15px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 5px;
        }

        .error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header {
                padding: 40px 20px;
            }

            .restaurant-name {
                font-size: 2rem;
            }

            .package-image {
                height: 180px;
            }

            /* Navigation changes for mobile */
            nav {
                flex-direction: row-reverse; /* This moves hamburger to right */
                padding: 15px 5%;
            }

            .hambar {
                display: block;
                margin-left: auto; /* Pushes it to the right */
                z-index: 1002;
            }

            .nav-links {
                position: fixed;
                left: -200px;
                top: 0;
                height: 100vh;
                width: 200px;
                background: #2c3e50;
                flex-direction: column;
                transition: left 0.3s;
                z-index: 1001;
                padding-top: 60px;
            }

            .nav-links.active {
                left: 0;
            }

            .sidebar {
                flex-direction: column;
                padding: 20px;
            }

            .sidebar li {
                margin: 15px 0;
            }

            .closebar {
                display: block;
                position: absolute;
                right: 20px;
                top: 20px;
                color: white;
                font-size: 1.5rem;
            }

            /* Mobile form adjustments */
            .bookingform {
                padding: 25px;
                max-width: 100%;
            }

            .form-group label {
                font-size: 1rem;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .restaurant-name {
                font-size: 1.8rem;
            }

            .tagline {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <section class="header">
        <nav>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x closebar" onclick="hideMenu()"></i>
                <ul class="sidebar">
                    <li><a href="./index.html">HOME</a></li>
                    <li><a href="./restuarant.html">MENU</a></li>
                    <li><a href="./contact.php">CONTACT</a></li>
                    <li><a href="./about.html">ABOUT</a></li>
                </ul>
            </div>
            <i class="bi bi-list hambar" onclick="showMenu()"></i>
        </nav>
        <div class="rate">
            <h1 class="restaurant-name">Sea Tales Restaurant</h1>
            <p class="tagline">Create unforgettable moments with our premium dining experiences</p>
        </div>
    </section>

    <div class="container">
        <?php if ($success): ?>
            <div class="success-message"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                Please correct the following errors:
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <h2 class="section-title">Couple Premium Packages</h2>

        <div class="packages-grid">
            <!-- Package 1 -->
            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5" alt="Glass Cabin Premium"
                    class="package-image">
                <div class="package-header">
                    <h3 class="package-name">Cabin - Premium</h3>
                    <div class="package-price">5999 <span>per couple</span></div>
                </div>
                <div class="package-content">
                    <div class="inclusions">
                        <h4>Inclusions:</h4>
                        <div class="inclusion-item"><span class="inclusion-icon">📽</span> Surprise video in projector
                            room</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎶</span> Live Music</div>
                        <div class="inclusion-item"><span class="inclusion-icon">📸</span> DSLR photography</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎂</span> Half kg cake</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🍘</span> Electric cracker shot</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🕯</span> Candle light dinner in
                            decorated cabin</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🖼</span> Photo hanging decoration
                        </div>
                    </div>

                    <h4>Food Menu:</h4>
                    <ul class="food-list">
                        <li>2 soups</li>
                        <li>2 starters</li>
                        <li>2 main course</li>
                        <li>2 dessert</li>
                        <li>2 mocktails/juices</li>
                    </ul>

                    <button class="btn book-now-btn" data-package="Glass Cabin - Premium">Book Now</button>
                </div>
            </div>

            <!-- Package 2 -->
            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b" alt="Glass Cabin Standard"
                    class="package-image">
                <div class="package-header">
                    <h3 class="package-name"> Cabin - Standard</h3>
                    <div class="package-price">3500 <span>per couple</span></div>
                </div>
                <div class="package-content">
                    <div class="inclusions">
                        <h4>Inclusions:</h4>
                        <div class="inclusion-item"><span class="inclusion-icon">🎶</span> Live Music</div>
                        <div class="inclusion-item"><span class="inclusion-icon">📸</span> DSLR photography</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎂</span> Half kg cake</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🍘</span> Electric cracker shot</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🕯</span> Candle light dinner in
                            decorated cabin</div>
                    </div>

                    <h4>Food:</h4>
                    <p>Food cost applicable for items you choose from our menu</p>

                    <button class="btn book-now-btn" data-package="Glass Cabin - Standard">Book Now</button>
                </div>
            </div>

            <!-- Package 3 -->
            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0" alt="Natural Cabin"
                    class="package-image">
                <div class="package-header">
                    <h3 class="package-name">Natural Cabin</h3>
                    <div class="package-price">1999</div>
                </div>
                <div class="package-content">
                    <div class="inclusions">
                        <h4>Inclusions:</h4>
                        <div class="inclusion-item"><span class="inclusion-icon">🕯</span> Separate cabin with candles
                        </div>
                        <div class="inclusion-item"><span class="inclusion-icon">🌺</span> Flower petals decoration
                        </div>
                        <div class="inclusion-item"><span class="inclusion-icon">📸</span> DSLR photography</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎶</span> Live music (subject to
                            availability)</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎂</span> Cake (extra ₹500)</div>
                    </div>

                    <h4>Food:</h4>
                    <p>Food cost applicable for items you choose from our menu</p>

                    <button class="btn book-now-btn" data-package="Natural Cabin">Book Now</button>
                </div>
            </div>
        </div>

        <h2 class="section-title">Special Occasion Packages</h2>

        <div class="packages-grid">
            <!-- Birthday Package -->
            <div class="package-card">
                <img src="./images/DKP00052.JPG" alt="Birthday Package" class="package-image">
                <div class="package-header">
                    <h3 class="package-name">Birthday Package</h3>
                    <div class="package-price">3499</div>
                </div>
                <div class="package-content">
                    <div class="inclusions">
                        <h4>Inclusions:</h4>
                        <div class="inclusion-item"><span class="inclusion-icon">🎈</span> Balloon arch with photo
                            hanging</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎂</span> Half kg cake</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🪄</span> Electric cracker during cake
                            cutting</div>
                        <div class="inclusion-item"><span class="inclusion-icon">📸</span> DSLR photography with soft
                            copies</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎶</span> Live musician</div>
                    </div>

                    <button class="btn book-now-btn" data-package="Birthday Package">Book Now</button>
                </div>
            </div>

            <!-- Nature Cabin Arch -->
            <div class="package-card">
                <img src="./images/cabin2.jpg" alt="Nature Cabin Arch" class="package-image">
                <div class="package-header">
                    <h3 class="package-name">Nature Cabin Arch</h3>
                    <div class="package-price">4500</div>
                </div>
                <div class="package-content">
                    <div class="inclusions">
                        <h4>Inclusions:</h4>
                        <div class="inclusion-item"><span class="inclusion-icon">🎈</span> Balloon arch with photo
                            hanging</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎂</span> Half kg cake</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🪄</span> Electric cracker during cake
                            cutting</div>
                        <div class="inclusion-item"><span class="inclusion-icon">📸</span> DSLR photography with soft
                            copies</div>
                        <div class="inclusion-item"><span class="inclusion-icon">🎶</span> Live musician</div>
                    </div>

                    <button class="btn book-now-btn" data-package="Nature Cabin Arch">Book Now</button>
                </div>
            </div>
        </div>

        <!-- Booking Form (hidden by default) -->
        <div id="bookingFormContainer" style="display: none;">
            <div class="bookingform">
                <h2>Book Your Package</h2>
                <form action="process.php" method="POST" id="bookingForm">
                    <input type="hidden" id="selectedPackage" name="package">

                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" id="name" name="name" required
                            value="<?= htmlspecialchars($old_input['name'] ?? '') ?>">
                        <?php if (isset($errors['name'])): ?>
                        <span class="error">
                            <?= htmlspecialchars($errors['name']) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" required
                            value="<?= htmlspecialchars($old_input['email'] ?? '') ?>">
                        <?php if (isset($errors['email'])): ?>
                        <span class="error">
                            <?= htmlspecialchars($errors['email']) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number*</label>
                        <input type="tel" id="phone" name="phone" required
                            value="<?= htmlspecialchars($old_input['phone'] ?? '') ?>">
                        <?php if (isset($errors['phone'])): ?>
                        <span class="error">
                            <?= htmlspecialchars($errors['phone']) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="date">Date*</label>
                        <input type="date" id="date" name="date" required
                            value="<?= htmlspecialchars($old_input['date'] ?? '') ?>">
                        <?php if (isset($errors['date'])): ?>
                        <span class="error">
                            <?= htmlspecialchars($errors['date']) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="time">Time*</label>
                        <input type="time" id="time" name="time" required
                               value="<?= htmlspecialchars($old_input['time'] ?? '') ?>">
                        <?php if (isset($errors['time'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['time']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="guests">Number of Guests (1-20)*</label>
                        <input type="number" id="guests" name="guests" min="1" max="20" required
                               value="<?= htmlspecialchars($old_input['guests'] ?? '') ?>">
                        <?php if (isset($errors['guests'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['guests']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="message">Special Requests</label>
                        <textarea id="message" name="message"><?= htmlspecialchars($old_input['message'] ?? '') ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['message']) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="submit" class="submit-btn">Submit Booking</button>
                </form>
            </div>
        </div>

        <div class="contact-section">
            <h3>Ready to create unforgettable memories?</h3>
            <div class="contact-item">
                <a href="tel:+919043424243">
                    <i class="bi bi-telephone"></i>
                    <span>+91 90434 24243</span>
                </a>
                <p class="hours">Monday to Saturday, 10am to 6pm</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Mobile menu toggle
        function showMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.add('active');
        }

        function hideMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.remove('active');
        }

        // Package booking form
        document.addEventListener('DOMContentLoaded', function() {
            const bookButtons = document.querySelectorAll('.book-now-btn');
            const bookingFormContainer = document.getElementById('bookingFormContainer');
            const selectedPackageInput = document.getElementById('selectedPackage');

            bookButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const packageName = this.getAttribute('data-package');
                    selectedPackageInput.value = packageName;
                    bookingFormContainer.style.display = 'block';
                    
                    // Scroll to the form
                    bookingFormContainer.scrollIntoView({ behavior: 'smooth' });
                });
            });

            // Close form when clicking outside
            document.addEventListener('click', function(event) {
                if (!bookingFormContainer.contains(event.target)) {
                    const isButton = Array.from(bookButtons).some(button => button.contains(event.target));
                    if (!isButton && bookingFormContainer.style.display === 'block') {
                        bookingFormContainer.style.display = 'none';
                    }
                }
            });
            
            // Prevent form from closing when clicking inside it
            bookingFormContainer.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>

    <section class="ABOUT">
        <center>
            <h1> Follow Us </h1>
            <p>
                Nestled in the heart of Chennai, Sea Tales Restaurant offers a multi-cuisine dining experience that
                blends exceptional flavors, elegant ambiance, and unforgettable moments. Whether you're planning a
                romantic dinner, a family gathering, a birthday celebration, or a corporate event, we provide the
                perfect setting for every occasion.
            </p>
        </center>
        <div class=" bootstrap-icons">
            <div class="icon-container">
                <a href="https://wa.me/9043424243" target="_blank"> <i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/people/Sea-Tales-Restaurant/100089425352549/ " target="_blank"> <i
                        class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/sea_tales_restaurant?igsh=NTc4MTIwNjQ2YQ==" target="_blank"><i
                        class="bi bi-instagram"></i></a>
                <a href="seatalesrestaurant@gmail.com" target="_blank"> <i class="bi bi-envelope"></i></a>
                <a href="https://www.youtube.com/channel/UCD4HE02WWjtUpHycunIROyw" target="_blank"><i
                        class="bi bi-youtube"></i></a>
            </div>
        </div>
    </section>
    
    <div class="foot">
        <footer>
            <p>Thanks and regards</p>
            <p>Sea Tales Restaurant</p>
            <p>© 2023 All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>