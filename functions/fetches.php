<?php

require_once('db_connect.php');

function fetch_properties() {
    global $conn; 

    $sql = "SELECT * FROM properties WHERE available = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $properties = [];
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
        return $properties;
    } else {
        return false;
    }
}

function fetch_all_properties() {
    global $conn; 

    
    $sql = "SELECT * FROM properties";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $properties = [];
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
        return $properties;
    } else {
        return false;
    }
}

function fetch_property($property_id) {
    global $conn; 

    $sql = "SELECT * FROM properties WHERE id = $property_id AND available = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function fetch_sellers() {
    global $conn; 

    $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE role = 'seller'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sellers = [];
        while ($row = $result->fetch_assoc()) {
            $sellers[] = $row;
        }
        return $sellers;
    } else {
        return false;
    }
}

function fetch_users(){
    global $conn; 
    
    $query = "SELECT id, first_name, last_name, email, phone FROM users WHERE role = 'buyer'";
    $result = $conn->query($query);
    $customers = $result->fetch_all(MYSQLI_ASSOC);

    return $customers;
}

function fetch_user($user_id){
    global $conn; 
    
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    return $user;
}

function fetch_saved_properties($customer_id){
    global $conn; 
    $query_saved = "SELECT p.*, sp.created_at 
                    FROM saved_properties sp
                    JOIN properties p ON sp.property_id = p.id
                    WHERE sp.user_id = ?";
    $stmt = $conn->prepare($query_saved);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $saved_properties = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $saved_properties;
}

function fetch_customers_appointments($customer_id){
    global $conn;
    $query_appointments = "SELECT a.*, 
                                  u.first_name AS seller_first_name, 
                                  u.last_name AS seller_last_name, 
                                  u.email AS seller_email,
                                  p.id AS property_id, 
                                  p.title AS property_title, 
                                  p.price AS property_price, 
                                  p.location AS property_location, 
                                  p.image AS property_image
                           FROM appointments a
                           JOIN users u ON a.seller_id = u.id
                           JOIN properties p ON a.property_id = p.id
                           WHERE a.buyer_id = ?";
    $stmt = $conn->prepare($query_appointments);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $appointments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $appointments;
}

function fetch_transactions($customer_id){
    global $conn;
    $query_transactions = "SELECT * FROM transactions t 
                           JOIN properties p ON t.property_id = p.id 
                           WHERE t.user_id = ?";
    $stmt = $conn->prepare($query_transactions);

    if ($stmt === false) {
        die("Error preparing query: " . $conn->error); 
    }

    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $transactions;
}


?>
