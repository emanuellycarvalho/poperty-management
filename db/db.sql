CREATE DATABASE `property_management`;

USE `property_management`;

CREATE TABLE `properties` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `property_type` ENUM('For Sale', 'For Rent') NOT NULL,
    `bedrooms` INT NOT NULL,
    `bathrooms` INT NOT NULL,
    `garage` INT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `properties` (`title`, `description`, `price`, `location`, `property_type`, `bedrooms`, `bathrooms`, `garage`, `image`) VALUES
('Modern Family Home', 'A beautiful 4-bedroom, 3-bathroom home located in a peaceful suburb. Perfect for a growing family.', 450000.00, 'Sydney, NSW', 'For Sale', 4, 3, 2, 'property-1.jpg'),
('Luxury Apartment in the City', 'A 2-bedroom, 2-bathroom luxury apartment with stunning views of the city skyline. Ideal for urban living.', 750000.00, 'Melbourne, VIC', 'For Sale', 2, 2, 1, 'property-2.jpg'),
('Cozy Beachside Cottage', 'A charming 3-bedroom, 1-bathroom cottage just steps away from the beach. Perfect for weekend getaways.', 300000.00, 'Gold Coast, QLD', 'For Sale', 3, 1, 1, 'property-3.jpg'),
('Spacious Rental House', 'This 5-bedroom, 4-bathroom house is available for rent. Large backyard and great for families.', 2000.00, 'Brisbane, QLD', 'For Rent', 5, 4, 3, 'property-4.jpg'),
('Charming Studio Apartment', 'A 1-bedroom, 1-bathroom studio apartment in a central location, perfect for young professionals.', 1500.00, 'Sydney, NSW', 'For Rent', 1, 1, 0, 'property-5.jpg'),
('Country Retreat', 'A peaceful 4-bedroom, 2-bathroom home on a large plot of land. Ideal for those seeking privacy and space.', 600000.00, 'Hobart, TAS', 'For Sale', 4, 2, 2, 'property-6.jpg');
