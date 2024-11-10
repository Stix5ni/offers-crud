-- Создание таблицы offers
CREATE TABLE IF NOT EXISTS `offers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `phone` VARCHAR(50) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Вставка тестовых данных
INSERT INTO `offers` (`name`, `email`, `phone`, `created_at`) VALUES
('Offer 1', 'contact1@example.com', '+1234567890', NOW()),
('Offer 2', 'contact2@example.com', '+1234567891', NOW()),
('Offer 3', 'contact3@example.com', '+1234567892', NOW()),
('Offer 4', 'contact4@example.com', '+1234567893', NOW()),
('Offer 5', 'contact5@example.com', '+1234567894', NOW()),
('Offer 6', 'contact6@example.com', '+1234567895', NOW()),
('Offer 7', 'contact7@example.com', '+1234567896', NOW()),
('Offer 8', 'contact8@example.com', '+1234567897', NOW()),
('Offer 9', 'contact9@example.com', '+1234567898', NOW()),
('Offer 10', 'contact10@example.com', '+1234567899', NOW()),
('Offer 11', 'contact11@example.com', '+1234567800', NOW()),
('Offer 12', 'contact12@example.com', '+1234567801', NOW()),
('Offer 13', 'contact13@example.com', '+1234567802', NOW()),
('Offer 14', 'contact14@example.com', '+1234567803', NOW()),
('Offer 15', 'contact15@example.com', '+1234567804', NOW());
