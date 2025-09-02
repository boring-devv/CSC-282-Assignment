<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . '/db.php';

function redirect_with_error(string $message): void {
	header('Location: index.php?error=' . urlencode($message));
	exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect_with_error('Invalid request.');
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$department = trim($_POST['department'] ?? '');
$matric = trim($_POST['matric_number'] ?? '');

if ($fullName === '' || $email === '' || $department === '' || $matric === '') {
	redirect_with_error('All fields are required.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	redirect_with_error('Please provide a valid email address.');
}

try {
	$pdo = get_pdo();

	// Custom duplicate checks for clearer error messages
	$existsMatric = $pdo->prepare('SELECT 1 FROM student_records WHERE matric_number = :matric LIMIT 1');
	$existsMatric->execute([':matric' => $matric]);
	if ($existsMatric->fetchColumn()) {
		redirect_with_error('A student with this matric number has already registered.');
	}

	$existsEmail = $pdo->prepare('SELECT 1 FROM student_records WHERE email = :email LIMIT 1');
	$existsEmail->execute([':email' => $email]);
	if ($existsEmail->fetchColumn()) {
		redirect_with_error('This email has already been used to register.');
	}
	$pdo->exec('CREATE TABLE IF NOT EXISTS student_records (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		full_name VARCHAR(100) NOT NULL,
		email VARCHAR(120) NOT NULL,
		department VARCHAR(100) NOT NULL,
		matric_number VARCHAR(60) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		UNIQUE KEY unique_matric (matric_number),
		UNIQUE KEY unique_email (email)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

	$sql = 'INSERT INTO student_records (full_name, email, department, matric_number)
			VALUES (:full_name, :email, :department, :matric_number)';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		':full_name' => $fullName,
		':email' => $email,
		':department' => $department,
		':matric_number' => $matric,
	]);
} catch (PDOException $e) {
	$message = $e->getCode() === '23000' ? 'A student with this matric number has already registered.' : 'Database error.';
	redirect_with_error($message);
}

header('Location: index.php?success=1');
exit;


