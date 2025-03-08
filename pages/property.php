<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('./templates/header.php'); 
include('../functions/fetches.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $property_id = $_GET['id'];
    
    $property = fetch_property($property_id);
    
    if (!$property) {
        echo "<p>Property not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid property ID.</p>";
    exit;
}

$is_logged_in = isset($_SESSION['user_id']); 
$sellers = fetch_sellers(); 

?>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert error">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
    <div class="alert success">
        <?php echo htmlspecialchars($_GET['success']); ?>
    </div>
<?php } ?>


<section class="property-details">
    <div class="container">
        <div class="property-header">
            <h1><?php echo $property['title']; ?></h1>
            <p class="location"><?php echo $property['location']; ?></p>
            <p class="price">$<?php echo number_format($property['price'], 2); ?></p>
        </div>
        <div class="property-image">
            <img src="../assets/img/uploads/<?php echo $property['image']; ?>" alt="Image of <?php echo $property['title']; ?>">
        </div>
        <div class="property-description">
            <h2>Description</h2>
            <p><?php echo nl2br($property['description']); ?></p>
        </div>
        <div class="property-contact">
            <p>For more details, please <a href="./pages/contact.php">contact us</a>.</p>
        </div>

        <?php if ($is_logged_in): ?>
            <button id="openModalBtn" class="btn-primary">Schedule Appointment</button>
        <?php endif; ?>
    </div>
</section>

<!-- Appointment Modal -->
<div id="appointmentModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Book an Appointment</h2>

        <form id="appointmentForm" action="../functions/process_appointment.php" method="POST">
            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
            <div class="input-group">
                <label for="seller">Select Seller</label>
                <select id="seller" name="seller_id" required>
                    <?php
                        foreach ($sellers as $seller) {
                            echo "<option value='{$seller['id']}'>{$seller['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <label for="appointment_date">Select Date</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
            </div>

            <div class="input-group">
                <label for="appointment_time">Select Time</label>
                <select id="appointment_time" name="appointment_time" required>
                </select>
            </div>

            <button type="submit" class="btn-primary">Submit Appointment</button>
        </form>
    </div>
</div>

<?php include('./templates/footer.php'); ?>

<script>
    var modal = document.getElementById("appointmentModal");
    var btn = document.getElementById("openModalBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById("appointment_date").addEventListener("change", function() {
        var seller_id = document.getElementById("seller").value;
        var appointment_date = document.getElementById("appointment_date").value;
        
        if (seller_id && appointment_date) {
            fetch(`../functions/fetch_available_times.php?seller_id=${seller_id}&appointment_date=${appointment_date}`)
                .then(response => response.json())
                .then(data => {
                    var timeSelect = document.getElementById("appointment_time");
                    timeSelect.innerHTML = '';  
                    var availableTimes = data.available_times;

                    availableTimes.forEach(function(time) {
                        var option = document.createElement("option");
                        option.value = time;
                        option.innerText = time;
                        timeSelect.appendChild(option);
                    });
                });
        }
    });
</script>