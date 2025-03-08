<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buyer_id = $_SESSION['user_id'];
    $seller_id = $_POST['seller_id'];
    $property_id = $_POST['property_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $datetime = $appointment_date . ' ' . $appointment_time . ':00';

    $query = "SELECT COUNT(*) FROM appointments WHERE seller_id = ? AND appointment_date = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        header("Location: ../pages/property.php?id=$property_id&error=Database error.");
        exit;
    } else {
        $stmt->bind_param("is", $seller_id, $datetime);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            header("Location: ../pages/property.php?id=$property_id&error=This time slot is already booked.");
            exit;
        } else {
            $query = "INSERT INTO appointments (buyer_id, seller_id, property_id, appointment_date, status) VALUES (?, ?, ?, ?, 'Scheduled')";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                header("Location: ../pages/property.php?id=$property_id&error=Database error.");
                exit;
            } else {
                $stmt->bind_param("iiis", $buyer_id, $seller_id, $property_id, $datetime);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../pages/property.php?id=$property_id&success=Appointment booked successfully.");
                    exit;
                } else {
                    header("Location: ../pages/property.php?id=$property_id&error=Failed to book the appointment.");
                    exit;
                }
                $stmt->close();
            }
        }
    }
}
?>
