<?php include('./templates/header.php'); ?>

<section class="properties-listing">
    <div class="container">
        <h1>Our Properties</h1>
        <div class="properties">
            <?php
                include('../functions/fetches.php');
                $properties = fetch_properties();
                $user_id = $_SESSION['user_id'] ?? null;

                if ($properties) {
                    foreach ($properties as $property) {
                        $fav_icon = "love-white.png";

                        if ($user_id) {
                            $query = "SELECT id FROM saved_properties WHERE user_id = ? AND property_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("ii", $user_id, $property['id']);
                            $stmt->execute();
                            $stmt->store_result();

                            if ($stmt->num_rows > 0) {
                                $fav_icon = "love-white-full.png";
                            }
                        }

                        echo '<div class="property-card">';
                        echo '<img src="../assets/img/uploads/' . $property['image'] . '" alt="Image of ' . $property['title'] . '">';
                        echo '<div class="property-info">';
                        echo '<h2>' . $property['title'] . '</h2>';
                        echo '<p class="location">' . $property['location'] . '</p>';
                        echo '<p class="price">$' . number_format($property['price'], 2) . '</p>';
                        echo '<p class="description">' . substr($property['description'], 0, 150) . '...</p>';
                        echo '<div class="property-buttons">';
                        echo '<a href="property.php?id=' . $property['id'] . '" class="btn-primary">View Details</a>';
                        echo '<a href="../functions/save_property.php?id=' . $property['id'] . '" class="btn-error">
                                <img src="../assets/img/icons/' . $fav_icon . '" alt="Favourite" class="fav">
                            </a>';
                        echo '</div>';
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
