<?php
// Database connection using PDO
const DB_HOST = 'localhost';
const DB_NAME = 'php_assignment';
const DB_USER = 'appuser';
const DB_PASS = 'pass1234';

/**
 * Returns a singleton PDO connection.
 */
function get_pdo(): PDO {
	static $pdo = null;
	if ($pdo instanceof PDO) {
		return $pdo;
	}

	$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	];

	try {
		$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
		return $pdo;
	} catch (PDOException $e) {
		http_response_code(500);
		echo 'Database connection failed.';
		exit;
	}
}

?>


