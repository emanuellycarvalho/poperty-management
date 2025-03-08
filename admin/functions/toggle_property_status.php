<?php
session_start();
if (!isset($_SESSION['user_id']) || !($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'seller')) {
    header("Location: ../../pages/login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    require_once('../../functions/db_connect.php');
    
    $property_id = $_GET['id'];
    $new_status = $_GET['status'] == '1' ? 1 : 0; 
    
    $query = "UPDATE properties SET available = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }
    
    $stmt->bind_param("ii", $new_status, $property_id);

    if ($stmt->execute()) {
        
        header("Location: ../properties.php");
        exit();
    } else {
        die("Error executing the query: " . $stmt->error);
    }

    
    $stmt->close();
}
?>
