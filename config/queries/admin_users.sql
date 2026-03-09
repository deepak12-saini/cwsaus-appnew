-- List all admin users (user_type = 2, status = 1)
SELECT id, username, password, name, email, role, user_type, status, created, modified
FROM users
WHERE user_type = 2 AND status = 1;

-- Add admin user if none exists (run manually if needed):
-- INSERT INTO users (username, password, name, email, role, user_type, status, created, modified)
-- VALUES ('admin@admin.com', 'admin', 'Admin', 'admin@admin.com', 'A', 2, 1, NOW(), NOW());
