<?php include('./templates/header.php'); 
require_once('../functions/fetches.php');
$properties = fetch_all_properties();

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    if (isset($_SESSION['success'])) {
        echo "<div class='alert success'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']); 
    }
} elseif (isset($_GET['status']) && $_GET['status'] == 'error') {
    if (isset($_SESSION['error'])) {
        echo "<div class='alert error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']); 
    }
}
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Properties</h1>
        <input type="text" id="searchInput" class="search-bar" placeholder="Search...">
    </div>

    <div class="dashboard-sections">
        <div class="dashboard-section">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="propertiesTable">
                    <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property['title']; ?></td>
                        <td><?php echo substr($property['description'], 0, 50) . '...'; ?></td>
                        <td>$<?php echo number_format($property['price'], 2); ?></td>
                        <td><?php echo $property['location']; ?></td>
                        <td><?php echo $property['property_type']; ?></td>
                        <td>
                            <a href="./add_property.php?id=<?php echo $property['id']; ?>" class="btn-edit">Edit</a>
                            <form action="./functions/toggle_property_status.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $property['id']; ?>">
                                <input type="hidden" name="status" value="<?php echo $property['available'] ? '0' : '1'; ?>">
                                <button type="submit" class="<?php echo $property['available'] ? 'btn-error' : 'btn-success'; ?>">
                                    <?php echo $property['available'] ? 'Disable' : 'Enable'; ?>
                                </button>
                            </form>
                            <a href="./sell_property.php?property_id=<?php echo $property['id']; ?>" class="btn-sell">Sell</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#propertiesTable tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

<?php include('./templates/footer.php'); ?>
