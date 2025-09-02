-- MySQL schema for the PHP Assignment
CREATE DATABASE IF NOT EXISTS php_assignment CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE php_assignment;

CREATE TABLE IF NOT EXISTS student_records (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	full_name VARCHAR(100) NOT NULL,
	email VARCHAR(120) NOT NULL,
	department VARCHAR(100) NOT NULL,
	matric_number VARCHAR(60) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	UNIQUE KEY unique_matric (matric_number),
	UNIQUE KEY unique_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


