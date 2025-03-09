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
    <link rel="icon" href="../assets/img/icons/favicon.ico" type="image/png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="../assets/img/icons/logo.png" alt="ABC Property Management Logo">
            </div>
            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="./properties.php">Properties</a></li>
                <li><a href="./about.php">About Us</a></li>
                <li><a href="./contact.php">Contact</a></li>

                <?php if ($isLoggedIn): ?>
                    <?php if ($userRole === 'seller' || $userRole === 'admin'): ?>
                        <li><a href="../admin/dashboard.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="../functions/logout.php">Logout</a></li>
                    <li><a href="../user_section/dashboard.php">Dashboard</a></li>
                <?php else: ?>
                    <li><a href="./login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>