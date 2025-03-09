<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !(($_SESSION['user_role'] != 'admin' || $_SESSION['user_role'] != 'seller'))) {
    header("Location: ../pages/login.php");
    exit();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC - Admin</title>
    <link rel="icon" href="../assets/img/icons/favicon.ico" type="image/png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="./style.css">
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
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a href="./properties.php">Properties</a></li>
                <li><a href="./customers.php">Customers</a></li>
                <li><a href="../functions/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>