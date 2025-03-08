<?php
session_start();
require_once('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$property_id = $_GET['id'] ?? null;

if (!$property_id) {
    $_SESSION['error'] = "Invalid property.";
    header("Location: ../pages/properties.php");
    exit;
}

$query = "SELECT id FROM saved_properties WHERE user_id = ? AND property_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $property_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $query = "DELETE FROM saved_properties WHERE user_id = ? AND property_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
    $_SESSION['success'] = "Property removed from favourites.";
} else {
    $query = "INSERT INTO saved_properties (user_id, property_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $property_id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Property added to favourites.";
    } else {
        $_SESSION['error'] = "Failed to save property.";
    }
}

    header("Location: ../pages/properties.php");
exit;
?>
