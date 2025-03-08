<?php 

include('./templates/header.php'); 
include('../functions/fetch_properties.php');

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
?>

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
    </div>
</section>

<?php include('./templates/footer.php'); ?>
