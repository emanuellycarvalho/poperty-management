INSERT INTO `properties` (`title`, `description`, `price`, `location`, `property_type`, `bedrooms`, `bathrooms`, `garage`, `image`, `available`) VALUES
('Modern Family Home', 'A beautiful 4-bedroom, 3-bathroom home located in a peaceful suburb. Perfect for a growing family.', 450000.00, 'Sydney, NSW', 'For Sale', 4, 3, 2, 'property-1.jpg', true),
('Luxury Apartment in the City', 'A 2-bedroom, 2-bathroom luxury apartment with stunning views of the city skyline. Ideal for urban living.', 750000.00, 'Melbourne, VIC', 'For Sale', 2, 2, 1, 'property-2.jpg', true),
('Cozy Beachside Cottage', 'A charming 3-bedroom, 1-bathroom cottage just steps away from the beach. Perfect for weekend getaways.', 300000.00, 'Gold Coast, QLD', 'For Sale', 3, 1, 1, 'property-3.jpg', true),
('Spacious Rental House', 'This 5-bedroom, 4-bathroom house is available for rent. Large backyard and great for families.', 2000.00, 'Brisbane, QLD', 'For Rent', 5, 4, 3, 'property-4.jpg', true),
('Charming Studio Apartment', 'A 1-bedroom, 1-bathroom studio apartment in a central location, perfect for young professionals.', 1500.00, 'Sydney, NSW', 'For Rent', 1, 1, 0, 'property-5.jpg', false),  -- Exemplo de propriedade não disponível
('Country Retreat', 'A peaceful 4-bedroom, 2-bathroom home on a large plot of land. Ideal for those seeking privacy and space.', 600000.00, 'Hobart, TAS', 'For Sale', 4, 2, 2, 'property-6.jpg', true);

INSERT INTO `users` (`email`, `password`, `role`, `first_name`, `last_name`, `phone`, `address`) VALUES
('admin@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'admin', 'John', 'Doe', '0412345678', '123 Admin St, Sydney, NSW'),
('seller1@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'seller', 'Carlos', 'Mendez', '0422334455', '456 Vendor Rd, Melbourne, VIC'),
('buyer1@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'buyer', 'Alice', 'Johnson', '0433445566', '789 Buyer Ln, Brisbane, QLD'),
('buyer2@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'buyer', 'David', 'Smith', '0498765432', '101 Client Ave, Hobart, TAS');
('seller2@abcproperty.com', '$2y$10$Hgt5omVzSYn1In9pZZzZY47ckF.3nqOwg3zmE/.Ubx7Yt3xfLg26S', 'buyer', 'Maria', 'Lopez', '0498765432', '101 Client Ave, Hobart, TAS');

INSERT INTO `saved_properties` (`user_id`, `property_id`) VALUES
(3, 1), 
(3, 2); 

INSERT INTO `appointments` (`buyer_id`, `seller_id`, `property_id`, `appointment_date`, `status`) VALUES
(3, 5, 1, '2025-04-01 10:00:00', 'Scheduled'),  
(3, 5, 2, '2025-04-02 14:00:00', 'Scheduled'); 

INSERT INTO `transactions` (`buyer_id`, `seller_id`, `property_id`, `transaction_type`, `transaction_date`, `amount`, `status`) VALUES
(3, 5, 1, 'Purchase', '2025-03-05 12:00:00', 450000.00, 'Completed'),  
(3, 5, 4, 'Rent', '2025-03-06 15:00:00', 2000.00, 'Completed');  