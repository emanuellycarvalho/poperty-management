<?php
session_start();
if (!isset($_SESSION['user_id']) || !(($_SESSION['user_role'] != 'admin' || $_SESSION['user_role'] != 'seller'))) {
    header("Location: ../../pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../functions/db_connect.php');
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $property_type = $_POST['property_type'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garage = $_POST['garage'];
    $image = $_FILES['image']['name'];
    $available = isset($_POST['available']) ? 1 : 0;

    $query = "INSERT INTO properties (title, description, price, location, property_type, bedrooms, bathrooms, garage, image, available) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsdiiisi", $title, $description, $price, $location, $property_type, $bedrooms, $bathrooms, $garage, $image, $available);
    $stmt->execute();
    $last_inserted_id = $stmt->insert_id;  
    $stmt->close();

    $target_dir = "../assets/img/uploads/";
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $new_image_name = "property-" . $last_inserted_id . "." . $file_extension;
    $target_file = $target_dir . $new_image_name;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $update_query = "UPDATE properties SET image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_image_name, $last_inserted_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../properties.php");
    exit();
}
?>
