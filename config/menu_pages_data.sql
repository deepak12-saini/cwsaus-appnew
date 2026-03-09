-- menu_pages: Add/update data
-- Usage: Run in MySQL/phpMyAdmin or: mysql -u user -p database < menu_pages_data.sql

-- Basic schema (title, content, status, created, modified):
INSERT INTO menu_pages (id, title, content, status, created, modified) VALUES
(1, 'Home', 'CWS Australia provides professional construction chemical solutions, waterproofing, and building products across Australia. With over 100 years of combined experience, we are a preferred choice for both Domestic and National Builders and Constructors.', 1, NOW(), NOW()),
(2, 'Solar for Homes', 'Explore our solar solutions for residential properties.', 1, NOW(), NOW()),
(3, 'Solar for Business', 'Commercial solar solutions for your business.', 1, NOW(), NOW()),
(4, 'Types of Solar', 'Learn about different types of solar systems.', 1, NOW(), NOW()),
(5, 'Consulting / Policies', 'Our consulting services and state policy information. We provide professional guidance on construction chemicals, waterproofing, and building products.', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  title = VALUES(title),
  content = VALUES(content),
  status = VALUES(status),
  modified = NOW();
