<?php
function register_user($first_name, $last_name, $email, $password, $confirm_password, $role, $phone, $address) {
    global $conn;

    if ($password !== $confirm_password) {
        return "Passwords do not match.";
    }

    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return "Email already registered.";
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);

    $sql = "INSERT INTO users (first_name, last_name, email, password, role, phone, address) 
            VALUES ('$first_name', '$last_name', '$email', '$password_hash', '$role', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        return false; // Registration successful
    } else {
        return "Error: " . $conn->error;
    }
}
?>
