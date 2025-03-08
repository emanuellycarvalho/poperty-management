<?php
    require_once('./functions/dashboard.php');
    $saved_properties = fetch_saved_properties();
    $appointments = fetch_appointments();
    $transactions = fetch_transactions();
?>

<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./style.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Welcome to Your Dashboard</h1>
    </div>

    <div class="dashboard-sections">
        <div class="dashboard-section">
            <h2>Your Appointments</h2>
            <div id="calendar"></div>
        </div>

        <div class="dashboard-section">
            <h2>Saved Properties</h2>
            <ul>
                <?php foreach ($saved_properties as $property): ?>
                    <li>
                        <a href="../pages/property.php?id=<?php echo $property['id']; ?>" class="property-name" target="_blank">
                            <img src="../assets/img/uploads/<?php echo $property['image']; ?>">
                            <span><?php echo $property['title']; ?> - $<?php echo number_format($property['price'], 2); ?></span>
                        </a>

                        <a href="../functions/save_property.php?id=<?php echo $property['id']; ?>" class="btn-error">
                            <img src="../assets/img/icons/love-white-full.png" alt="Remove from favorites" class="fav">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="dashboard-section">
            <h2>Transaction History</h2>
            <ul>
                <?php foreach ($transactions as $transaction): ?>
                    <li><?php echo $transaction['title']; ?> - $<?php echo number_format($transaction['amount'], 2); ?> on <?php echo date("d M Y", strtotime($transaction['date'])); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            <?php foreach ($appointments as $appointment): ?>
            {
                title: "Appointment",
                start: "<?php echo date('Y-m-d H:i:s', strtotime($appointment['appointment_date'])); ?>",
            },
            <?php endforeach; ?>
        ]
    });
    calendar.render();
});
</script>

<?php include('./templates/footer.php'); ?>
