<?php include('./templates/header.php'); 
require_once('../functions/fetches.php');
$properties = fetch_all_properties();
?>

<div class="property-container">
    <div class="title">
        <h1>Manage Properties</h1> 
        <a href="./add_property.php" class="btn-primary">+</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
                <th>Type</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
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
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('./templates/footer.php'); ?>
