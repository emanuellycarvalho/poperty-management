<?php 
include('./templates/header.php'); 
require_once('../functions/fetches.php');

$property_id = $_GET['property_id'];
$property = fetch_property($property_id);
$clients = fetch_clients(); 

$is_admin = $_SESSION['user_role'] == 'admin';

?>
<div class="form-section">
    <div class="form-container">
        <h2>Sell Property: <?php echo $property['title']; ?></h2>
        <form method="POST" action="./functions/sell_property.php">
            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
            <div class="input-group">
                <label for="client_id">Select Client</label>
                <select name="client_id" id="client_id" required>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['first_name'] . ' ' . $client['last_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="PayPal">PayPal</option>
                </select>
            </div>

            <div class="input-group">
                <label for="transaction_type">Transaction Type</label>
                <select name="transaction_type" id="transaction_type" required>
                    <option value="Purchase">Purchase</option>
                    <option value="Rent">Rent</option>
                </select>
            </div>

            <div class="input-group">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount" value="$<?php echo number_format($property['price'], 2); ?>" 
                    <?php echo $is_admin ? '' : 'disabled'; ?> 
                    <?php echo $is_admin ? '' : 'readonly'; ?>
                >
            </div>

            <button type="submit" class="btn-success">Complete Transaction</button>
        </form>
    </div>
</div>

<?php include('./templates/footer.php'); ?>
