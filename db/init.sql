CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  password VARCHAR(255)
);

# Generated using PHP with password_hash('admin', PASSWORD_BCRYPT);
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$hLd0jow8QF/n7hcJkdVXa.puNMylT809Y1DEpLHJ.szuagr.TNU6W');
INSERT INTO users (username, password) VALUES ('user', 'password');
