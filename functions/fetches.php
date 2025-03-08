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

?>
