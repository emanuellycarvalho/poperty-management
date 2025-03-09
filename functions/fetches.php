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

function fetch_clients() {
    global $conn;
    $query = "SELECT id, first_name, last_name FROM users WHERE role = 'buyer'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $clients = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $clients;
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


function fetch_monthly_sales($seller_id) {
    global $conn;

    $query = "SELECT MONTH(transaction_date) AS month, SUM(amount) AS sales
              FROM transactions
              WHERE seller_id = ?
              GROUP BY MONTH(transaction_date)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $sales = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $monthly_sales = ['labels' => [], 'data' => []];
    foreach ($sales as $sale) {
        $monthly_sales['labels'][] = date('M', mktime(0, 0, 0, $sale['month'], 10)); 
        $monthly_sales['data'][] = $sale['sales'];
    }

    return $monthly_sales;
}

function fetch_upcoming_appointments($seller_id) {
    global $conn;

    $query = "SELECT a.id AS appointment_id, a.appointment_date, u.first_name AS client_first_name, u.last_name AS client_last_name, 
              p.title AS property_title, p.location, p.id AS property_id, u.id AS client_id
              FROM appointments a
              JOIN users u ON a.buyer_id = u.id
              JOIN properties p ON a.property_id = p.id
              WHERE a.seller_id = ? AND a.appointment_date > NOW() AND a.status = 'Scheduled'
              ORDER BY a.appointment_date ASC";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $appointments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $appointments;
}

function fetch_pending_transactions($seller_id) {
    global $conn;

    $query = "SELECT t.id, t.transaction_date, p.title AS property_title, t.amount
              FROM transactions t
              JOIN properties p ON t.property_id = p.id
              WHERE t.seller_id = ? AND t.status = 'Pending'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $pending_transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $pending_transactions;
}

function fetch_total_sales($user_id = null) {
    global $conn;
    if ($user_id) {
        $query = "SELECT SUM(amount) as total_sales FROM transactions WHERE seller_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
    } else {
        $query = "SELECT SUM(amount) as total_sales FROM transactions";
        $stmt = $conn->prepare($query);
    }
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['total_sales'] ?? 0;
}

function fetch_total_appointments($user_id = null) {
    global $conn;
    if ($user_id) {
        $query = "SELECT COUNT(*) as total_appointments FROM appointments WHERE seller_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
    } else {
        $query = "SELECT COUNT(*) as total_appointments FROM appointments";
        $stmt = $conn->prepare($query);
    }
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result['total_appointments'] ?? 0;
}

function fetch_all_sellers_performance() {
    global $conn;
    $query = "SELECT u.first_name, u.last_name, COUNT(t.id) as total_sold, SUM(t.amount) as total_sales
              FROM users u
              JOIN transactions t ON u.id = t.seller_id
              WHERE u.role = 'seller'
              GROUP BY u.id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $sellers_performance = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $sellers_performance;
}

function fetch_all_transactions() {
    global $conn;
    $query = "SELECT t.id, t.transaction_date, t.amount, t.status,
                     u.first_name as buyer_first_name, u.last_name as buyer_last_name,
                     s.first_name as seller_first_name, s.last_name as seller_last_name,
                     p.title as property_title
              FROM transactions t
              JOIN properties p ON t.property_id = p.id
              JOIN users u ON t.buyer_id = u.id
              JOIN users s ON t.seller_id = s.id";  // JOIN adicional para pegar os dados do vendedor
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $transactions;
}

function fetch_all_appointments() {
    global $conn;
    $query = "SELECT a.*, p.title as property_title, 
                     u.first_name as buyer_first_name, u.last_name as buyer_last_name,
                     s.first_name as seller_first_name, s.last_name as seller_last_name
              FROM appointments a
              JOIN properties p ON a.property_id = p.id
              JOIN users u ON a.buyer_id = u.id
              JOIN users s ON a.seller_id = s.id";  
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $appointments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $appointments;
}

?>
