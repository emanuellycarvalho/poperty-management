<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Property Management</title>
    <link rel="icon" href="./assets/img/icons/favicon.ico" type="image/png">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Contact Information Section -->
    <section class="contact-info">
        <div class="container">
            <div class="header-contact-details">
                <span class="contact-email"><img class="icon" src="./assets/img/icons/email.png" alt="Mail icon">Email: info@abcproperty.com</span>
                <span class="contact-phone"><img class="icon" src="./assets/img/icons/phone.png" alt="Phone icon">Phone: +61 123 456 789</span>
            </div>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><img class="icon" src="./assets/img/icons/facebook.png" alt="Facebook icon"></a>
                <a href="#" aria-label="Tiktok"><img class="icon" src="./assets/img/icons/tiktok.png" alt="Tiktok icon"></a>
                <a href="#" aria-label="Instagram"><img class="icon" src="./assets/img/icons/instagram.png" alt="Instagram icon"></a>
            </div>
        </div>
    </section>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="./assets/img/icons/logo.png" alt="ABC Property Management Logo">
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="./pages/properties.php">Properties</a></li>
                <li><a href="./pages/about.php">About Us</a></li>
                <li><a href="./pages/contact.php">Contact</a></li>

                <?php if ($isLoggedIn): ?>
                    <?php if ($userRole === 'seller' || $userRole === 'admin'): ?>
                        <li><a href="./admin/dashboard.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="./functions/logout.php">Logout</a></li>
                    <li><a href="./user_section/dashboard.php">Dashboard</a></li>
                <?php else: ?>
                    <li><a href="./pages/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Find Your Dream Property</h1>
            <p>Explore the best properties for sale and rent</p>
            <a href="./pages/properties.php" class="btn-primary">Browse Properties</a>
        </div>
    </section>

    <!-- Three Section Highlights -->
    <section class="three-sections">
        <div class="section">
            <img src="./assets/img/icons/home.png" alt="Icon representing property listings">
            <h2>For Sale</h2>
            <p>Browse the best properties available for sale.</p>
            <a href="./pages/properties.php" class="btn-secondary">Explore Now</a>
        </div>
        <div class="section">
            <img src="./assets/img/icons/rental-home.png" alt="Icon representing property rentals">
            <h2>For Rent</h2>
            <p>Find the perfect rental property for you.</p>
            <a href="./pages/properties.php" class="btn-secondary">Explore Rentals</a>
        </div>
        <div class="section">
            <img src="./assets/img/icons/chat.png" alt="Icon representing customer support">
            <h2>Contact Us</h2>
            <p>Need help? Get in touch with us today.</p>
            <a href="./pages/contact.php" class="btn-secondary">Contact Now</a>
        </div>
    </section>

    <?php include('./pages/templates/footer.php'); ?>
