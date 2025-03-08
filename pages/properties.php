<?php include('./templates/header.php'); ?>

<section class="properties-listing">
    <div class="container">
        <h1>Our Properties</h1>
        <div class="properties">
            <?php
                include('../functions/fetch_properties.php');
                $properties = fetch_properties();

                if ($properties) {
                    foreach ($properties as $property) {
                        echo '<div class="property-card">';
                        echo '<img src="../assets/img/uploads/' . $property['image'] . '" alt="Image of ' . $property['title'] . '">';
                        echo '<div class="property-info">';
                        echo '<h2>' . $property['title'] . '</h2>';
                        echo '<p class="location">' . $property['location'] . '</p>';
                        echo '<p class="price">$' . number_format($property['price'], 2) . '</p>';
                        echo '<p class="description">' . substr($property['description'], 0, 150) . '...</p>';
                        echo '<a href="property.php?id=' . $property['id'] . '" class="btn-primary">View Details</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No properties available at the moment.</p>";
                }
            ?>
        </div>
    </div>
</section>

<?php include('./templates/footer.php'); ?>
