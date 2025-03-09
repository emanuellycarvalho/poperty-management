<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../../functions/db_connect.php');

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $payment_method = $_POST['payment_method'];
    $property_id = $_POST['property_id'];
    $transaction_type = $_POST['transaction_type'];
    $amount = $_POST['amount'];
    
    create_transaction($client_id, $property_id, $amount, $transaction_type);
}

function create_transaction($client_id, $property_id, $amount, $transaction_type) {
    global $conn;
    $seller_id = $_SESSION['user_id'];

    $amount = str_replace(['$', ','], '', $amount);  
    $amount = floatval($amount);
    $client_id = intval($client_id);
    $seller_id = intval($seller_id);
    $property_id = intval($property_id);

    
    $conn->begin_transaction();

    try {
        
        $query = "INSERT INTO transactions (buyer_id, seller_id, property_id, transaction_type, transaction_date, amount, status)
                  VALUES (?, ?, ?, ?, NOW(), ?, 'Completed')";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            die('Query preparation failed: ' . $conn->error);
        }

        $stmt->bind_param("iiisd", $client_id, $seller_id, $property_id, $transaction_type, $amount);

        $stmt->execute();
        $stmt->close();

        $update_query = "UPDATE properties SET available = 0 WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        
        if (!$update_stmt) {
            die('Query preparation failed for update: ' . $conn->error);
        }

        $update_stmt->bind_param("i", $property_id);
        $update_stmt->execute();
        $update_stmt->close();

        $conn->commit();
        
        $_SESSION['success'] = "Transaction completed successfully!";
        header('Location: ../properties.php?status=success');
        exit; 
    } catch (Exception $e) {
        
        $conn->rollback();
        $_SESSION['error'] = "There was an error processing the transaction. Please try again.";
        header('Location: ../properties.php?status=error');
        exit; 
    }
}



?>
