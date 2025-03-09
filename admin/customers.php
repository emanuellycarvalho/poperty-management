<?php
require_once('../functions/fetches.php');
$customers = fetch_users();

?>

<?php include('./templates/header.php'); ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Customer Records</h1>
        <input type="text" id="searchInput" class="search-bar" placeholder="Search...">
    </div>

    <div class="dashboard-sections">
        <div class="dashboard-section">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="customerTable">
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['phone']; ?></td>
                        <td>
                            <a href="customer.php?id=<?php echo $customer['id']; ?>" class="btn-view">View</a>
                            <a href="edit_customer.php?id=<?php echo $customer['id']; ?>" class="btn-edit">Edit</a>
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
        let rows = document.querySelectorAll('#customerTable tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

<?php include('./templates/footer.php'); ?>
