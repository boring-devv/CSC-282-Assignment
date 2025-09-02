<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: view.php');
	exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$matricInput = trim($_POST['matric_number'] ?? '');
if ($id <= 0 || $matricInput === '') {
	header('Location: view.php');
	exit;
}

$pdo = get_pdo();
// Verify matric matches before deleting
$verify = $pdo->prepare('SELECT matric_number FROM student_records WHERE id = :id');
$verify->execute([':id' => $id]);
$row = $verify->fetch();
if (!$row || trim($row['matric_number']) !== $matricInput) {
	header('Location: view.php');
	exit;
}

$stmt = $pdo->prepare('DELETE FROM student_records WHERE id = :id AND matric_number = :matric');
$stmt->execute([':id' => $id, ':matric' => $matricInput]);

header('Location: view.php?deleted=1');
exit;


