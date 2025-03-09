<?php include('./templates/header.php'); ?>

<?php
require_once('../functions/fetches.php');

$user_id = $_SESSION['user_id'];
$role = $_SESSION['user_role'];

// Seller Dashboard
if ($role == 'seller') {
    $appointments = fetch_upcoming_appointments($user_id);
    $monthly_sales = fetch_monthly_sales($user_id);
    $saved_properties = fetch_saved_properties($user_id);
    $pending_transactions = fetch_pending_transactions($user_id);
}

// Admin Dashboard
if ($role == 'admin') {
    $total_sales = fetch_total_sales(); 
    $total_appointments = fetch_total_appointments(); 
    $all_sellers_performance = fetch_all_sellers_performance(); 
    $all_transactions = fetch_all_transactions(); 
    $all_appointments = fetch_all_appointments(); 
}

?>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-container">
    <h1><?php echo $role == 'admin' ? 'Admin Dashboard' : 'Seller Dashboard'; ?></h1>

    <?php if ($role == 'seller'): ?>
        <!-- Seller Specific Dashboard Section -->
        <div class="dashboard-section">
            <h2>Upcoming Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Appointment Date</th>
                        <th>Property</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><a href="../pages/client.php?id=<?php echo $appointment['client_id']; ?>"><?php echo $appointment['client_first_name'] . ' ' . $appointment['client_last_name']; ?></a></td>
                        <td><?php echo date("d M Y, H:i", strtotime($appointment['appointment_date'])); ?></td>
                        <td><a href="../pages/property.php?id=<?php echo $appointment['property_id']; ?>"><?php echo $appointment['property_title']; ?></a></td>
                        <td><?php echo $appointment['location']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Monthly Sales -->
        <div class="dashboard-section">
            <h2>Monthly Sales</h2>
            <canvas id="monthlySalesChart"></canvas>
            <script>
                const ctx = document.getElementById('monthlySalesChart').getContext('2d');
                const monthlySalesData = <?php echo json_encode($monthly_sales); ?>;

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthlySalesData.labels,
                        datasets: [{
                            label: 'Sales ($)',
                            data: monthlySalesData.data,
                            borderColor: 'rgb(75, 192, 192)',
                            fill: false,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

        <!-- Saved Properties -->
        <div class="dashboard-section">
            <h2>Saved Properties</h2>
            <div class="properties-grid">
                <?php foreach ($saved_properties as $property): ?>
                <div class="property-card">
                    <a href="../pages/property.php?id=<?php echo $property['property_id']; ?>" target="_blank">
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

        <!-- Pending Transactions -->
        <div class="dashboard-section">
            <h2>Pending Transactions</h2>
            <?php if (empty($pending_transactions)): ?>
                <p>No pending transactions. Everything is up to date!</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Property</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_transactions as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction['id']; ?></td>
                            <td><?php echo $transaction['property_title']; ?></td>
                            <td>$<?php echo number_format($transaction['amount'], 2); ?></td>
                            <td><?php echo date("d M Y", strtotime($transaction['transaction_date'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


    <?php elseif ($role == 'admin'): ?>
        <!-- Admin Dashboard Section -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Sales</h3>
                <p>$<?php echo number_format($total_sales, 2); ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Appointments</h3>
                <p><?php echo $total_appointments; ?></p>
            </div>
        </div>

        <div class="dashboard-section">
            <h2>Sellers Performance</h2>
            <table>
                <thead>
                    <tr>
                        <th>Seller</th>
                        <th>Properties Sold</th>
                        <th>Total Sales ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_sellers_performance as $seller): ?>
                    <tr>
                        <td><?php echo $seller['first_name'] . ' ' . $seller['last_name']; ?></td>
                        <td><?php echo $seller['total_sold']; ?></td>
                        <td>$<?php echo number_format($seller['total_sales'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="dashboard-section">
            <h2>All Transactions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Seller</th>
                        <th>Buyer</th>
                        <th>Property</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['seller_first_name'] . ' ' . $transaction['seller_last_name']; ?></td>
                        <td><?php echo $transaction['buyer_first_name'] . ' ' . $transaction['buyer_last_name']; ?></td>
                        <td><?php echo $transaction['property_title']; ?></td>
                        <td>$<?php echo number_format($transaction['amount'], 2); ?></td>
                        <td><?php echo $transaction['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="dashboard-section">
            <h2>All Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Seller</th>
                        <th>Buyer</th>
                        <th>Property</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment['id']; ?></td>
                        <td><?php echo $appointment['seller_first_name'] . ' ' . $appointment['seller_last_name']; ?></td>
                        <td><?php echo $appointment['buyer_first_name'] . ' ' . $appointment['buyer_last_name']; ?></td>
                        <td><?php echo $appointment['property_title']; ?></td>
                        <td><?php echo date("d M Y, H:i", strtotime($appointment['appointment_date'])); ?></td>
                        <td><?php echo $appointment['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include('./templates/footer.php'); ?>
