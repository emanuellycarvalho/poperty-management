<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

if($_SESSION['role'] !== 'buyer'){
    header("Location: ../index.php");
    exit();
}

require_once('../functions/db_connect.php');
$user_id = $_SESSION['user_id'];

function fetch_saved_properties(){
    global $conn, $user_id; 
    $query_saved = "SELECT p.id, p.title, p.location, p.price, p.image 
                FROM saved_properties sp
                JOIN properties p ON sp.property_id = p.id
                WHERE sp.user_id = ?";
    $stmt = $conn->prepare($query_saved);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $saved_properties = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $saved_properties;
}

function fetch_appointments(){
    global $conn, $user_id;
    $query_appointments = "SELECT appointment_date, property_id 
                       FROM appointments WHERE buyer_id = ?";
    $stmt = $conn->prepare($query_appointments);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $appointments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $appointments;
}

function fetch_transactions(){
    global $conn, $user_id;
    $query_transactions = "SELECT t.amount, t.transaction_date, p.title 
                       FROM transactions t 
                       JOIN properties p ON t.property_id = p.id 
                       WHERE t.user_id = ?";
    $stmt = $conn->prepare($query_transactions);

    if ($stmt === false) {
        die("Error preparing query: " . $conn->error); // Verifique se há erro na consulta SQL
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $transactions;
}
?>
