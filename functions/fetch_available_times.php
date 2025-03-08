<?php

require_once('db_connect.php');

if (isset($_GET['seller_id']) && isset($_GET['appointment_date'])) {
    $seller_id = $_GET['seller_id'];
    $appointment_date = $_GET['appointment_date'];

    $date = date('Y-m-d', strtotime($appointment_date));
    $query = "SELECT appointment_date FROM appointments WHERE seller_id = ? AND DATE(appointment_date) = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error preparing the query: ' . $conn->error);
    }

    $stmt->bind_param("is", $seller_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointments = $result->fetch_all(MYSQLI_ASSOC);

    $taken_times = [];
    foreach ($appointments as $appointment) {
        $taken_times[] = date('H:i', strtotime($appointment['appointment_date']));
    }

    $available_times = [];
    for ($i = 6; $i <= 18; $i += 2) {
        $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
        if (!in_array($time, $taken_times)) {
            $available_times[] = $time;
        }
    }

    echo json_encode(['available_times' => $available_times]);
}
?>
