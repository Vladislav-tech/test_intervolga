CREATE DATABASE comments_db;

USE comments_db;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO comments(name, comment, created_at) VALUES 
('Vladislav Tseplyaev', 'I want to be the best programmer in the world!', '2023-07-28 14:00:00');