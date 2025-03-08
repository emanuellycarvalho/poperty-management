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
    `available` BOOLEAN DEFAULT TRUE,  -- Adicionando o atributo 'available'
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `properties` (`title`, `description`, `price`, `location`, `property_type`, `bedrooms`, `bathrooms`, `garage`, `image`, `available`) VALUES
('Modern Family Home', 'A beautiful 4-bedroom, 3-bathroom home located in a peaceful suburb. Perfect for a growing family.', 450000.00, 'Sydney, NSW', 'For Sale', 4, 3, 2, 'property-1.jpg', true),
('Luxury Apartment in the City', 'A 2-bedroom, 2-bathroom luxury apartment with stunning views of the city skyline. Ideal for urban living.', 750000.00, 'Melbourne, VIC', 'For Sale', 2, 2, 1, 'property-2.jpg', true),
('Cozy Beachside Cottage', 'A charming 3-bedroom, 1-bathroom cottage just steps away from the beach. Perfect for weekend getaways.', 300000.00, 'Gold Coast, QLD', 'For Sale', 3, 1, 1, 'property-3.jpg', true),
('Spacious Rental House', 'This 5-bedroom, 4-bathroom house is available for rent. Large backyard and great for families.', 2000.00, 'Brisbane, QLD', 'For Rent', 5, 4, 3, 'property-4.jpg', true),
('Charming Studio Apartment', 'A 1-bedroom, 1-bathroom studio apartment in a central location, perfect for young professionals.', 1500.00, 'Sydney, NSW', 'For Rent', 1, 1, 0, 'property-5.jpg', false),  -- Exemplo de propriedade não disponível
('Country Retreat', 'A peaceful 4-bedroom, 2-bathroom home on a large plot of land. Ideal for those seeking privacy and space.', 600000.00, 'Hobart, TAS', 'For Sale', 4, 2, 2, 'property-6.jpg', true);

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'seller', 'buyer') NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(15),
    `address` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `users` (`email`, `password`, `role`, `first_name`, `last_name`, `phone`, `address`) VALUES
('admin@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'admin', 'John', 'Doe', '0412345678', '123 Admin St, Sydney, NSW'),
('seller1@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'seller', 'Carlos', 'Mendez', '0422334455', '456 Vendor Rd, Melbourne, VIC'),
('buyer1@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'buyer', 'Alice', 'Johnson', '0433445566', '789 Buyer Ln, Brisbane, QLD'),
('buyer2@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'buyer', 'David', 'Smith', '0498765432', '101 Client Ave, Hobart, TAS');