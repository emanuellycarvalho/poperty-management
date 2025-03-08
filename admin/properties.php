<?php include('./templates/header.php'); 
require_once('../functions/fetches.php');
$properties = fetch_properties();
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
                <td><?php echo $property['available'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="./add_property.php?id=<?php echo $property['id']; ?>" class="btn-edit">Edit</a>
                    <a href="./functions/delete_property.php?id=<?php echo $property['id']; ?>" class="btn-error">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('./templates/footer.php'); ?>
