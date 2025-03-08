<?php 

include('./templates/header.php'); 
include('../functions/fetches.php'); 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $property_id = $_GET['id'];
    
    $property = fetch_property($property_id);
    
    if (!$property) {
        echo "<p>Property not found.</p>";
        exit;
    }
}

?>

<div class="form-section">
    <div class="form-container">
        <h2><?php echo isset($property) ? 'Edit Property' : 'Add New Property'; ?></h2>

        <form action="<?php echo isset($property) ? './functions/update_property.php' : './functions/add_property.php'; ?>" method="POST" enctype="multipart/form-data">
            
            <!-- Title -->
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo isset($property) ? $property['title'] : ''; ?>" required>
            </div>

            <!-- Description -->
            <div class="input-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo isset($property) ? $property['description'] : ''; ?></textarea>
            </div>

            <!-- Price -->
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo isset($property) ? $property['price'] : ''; ?>" required>
            </div>

            <!-- Location -->
            <div class="input-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="<?php echo isset($property) ? $property['location'] : ''; ?>" required>
            </div>

            <!-- Property Type -->
            <div class="input-group">
                <label for="property_type">Property Type</label>
                <select id="property_type" name="property_type" required>
                    <option value="For Sale" <?php echo isset($property) && $property['property_type'] == 'For Sale' ? 'selected' : ''; ?>>For Sale</option>
                    <option value="For Rent" <?php echo isset($property) && $property['property_type'] == 'For Rent' ? 'selected' : ''; ?>>For Rent</option>
                </select>
            </div>

            <!-- Bedrooms -->
            <div class="input-group">
                <label for="bedrooms">Bedrooms</label>
                <input type="number" id="bedrooms" name="bedrooms" value="<?php echo isset($property) ? $property['bedrooms'] : ''; ?>" required>
            </div>

            <!-- Bathrooms -->
            <div class="input-group">
                <label for="bathrooms">Bathrooms</label>
                <input type="number" id="bathrooms" name="bathrooms" value="<?php echo isset($property) ? $property['bathrooms'] : ''; ?>" required>
            </div>

            <!-- Garage -->
            <div class="input-group">
                <label for="garage">Garage Capacity</label>
                <input type="number" id="garage" name="garage" value="<?php echo isset($property) ? $property['garage'] : ''; ?>" required>
            </div>

            <!-- Image Upload -->
            <div class="input-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" <?php echo !isset($property) ? 'required' : ''; ?>>
                <?php if (isset($property) && $property['image']): ?>
                    <p>Current image: <img src="../assets/img/uploads/<?php echo $property['image']; ?>" alt="Property Image" width="100"></p>
                <?php endif; ?>
            </div>

            <!-- Available Status -->
            <div class="input-group">
                <label for="available">Available</label>
                <select id="available" name="available" required>
                    <option value="1" <?php echo isset($property) && $property['available'] == 1 ? 'selected' : ''; ?>>Yes</option>
                    <option value="0" <?php echo isset($property) && $property['available'] == 0 ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="input-group">
                <button type="submit" class="btn-primary"><?php echo isset($property) ? 'Update Property' : 'Add Property'; ?></button>
            </div>
        </form>
    </div>
</div>



<?php include('./templates/footer.php'); ?>
