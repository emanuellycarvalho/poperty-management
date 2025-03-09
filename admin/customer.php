<?php include('./templates/header.php'); ?>

<?php
if (!isset($_GET['id'])) {
    header("Location: customers.php");
    exit();
}

$customer_id = $_GET['id'];

require_once('../functions/fetches.php');
$customer = fetch_user($customer_id);
$transactions = fetch_transactions($customer_id);
$appointments = fetch_customers_appointments($customer_id);
$saved_properties = fetch_saved_properties($customer_id);
?>


<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Customer Details</h1>
        <p><?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?></p>
        <p><b>Email:</b> <?php echo $customer['email']; ?></p>
        <p><b>Phone:</b> <?php echo $customer['phone']; ?></p>
        <p><b>Address:</b> <?php echo $customer['address']; ?></p>
    </div>

    <div class="dashboard-flex">
        <div class="dashboard-table">
            <h2>Transaction History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['title']; ?></td>
                        <td>$<?php echo number_format($transaction['amount'], 2); ?></td>
                        <td><?php echo $transaction['transaction_type']; ?></td>
                        <td><?php echo date("d M Y", strtotime($transaction['transaction_date'])); ?></td>
                        <td><?php echo $transaction['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="dashboard-table">
            <h2>Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Seller</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td>Property <a href="../pages/property.php?id=<?php echo $appointment['property_id']; ?>"><?php echo $appointment['property_title']; ?></a></td>
                        <td>Property <a href="../pages/property.php?id=<?php echo $appointment['property_id']; ?>"><?php echo $appointment['property_location']; ?></a></td>
                        <td><?php echo date("d M Y", strtotime($appointment['appointment_date'])); ?></td>
                        <td><?php echo $appointment['seller_first_name'] . ' ' . $appointment['seller_last_name']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="dashboard-card">
        <h2>Saved Properties</h2>
        <div class="properties-grid">
            <?php foreach ($saved_properties as $property): ?>
            <div class="property-card">
                <a href="../pages/property.php?id=<?php echo $property['id']; ?>" target="_blank">
                    <img src="../assets/img/uploads/<?php echo $property['image']; ?>">
                    <div class="property-info">
                        <span><?php echo $property['title']; ?></span>
                        <span>$<?php echo number_format($property['price'], 2); ?></span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include('./templates/footer.php'); ?>
