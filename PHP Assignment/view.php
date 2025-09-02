<?php
require_once __DIR__ . '/db.php';

$pdo = get_pdo();

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

$students = $pdo->query('SELECT * FROM student_records ORDER BY created_at ASC')->fetchAll();
$serial = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Student Registration System</title>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<div class="container">
		<div class="nav">
			<a href="index.php">Register</a>
			<a class="active" href="view.php">View Students</a>
		</div>
		<h1>Student Registration System</h1>
		<p><a href="index.php" class="btn btn-add">+ Add</a></p>
		<?php if (isset($_GET['deleted'])): ?>
			<div class="notice">Record deleted successfully. <button class="alert-close" onclick="this.parentElement.remove()" aria-label="Close">×</button></div>
		<?php endif; ?>
		<div class="table-wrap">
		<table>
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Matric Number</th>
					<th>Department</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($students)): ?>
					<tr><td colspan="7">No students registered yet.</td></tr>
				<?php else: ?>
					<?php foreach ($students as $row): ?>
						<tr>
							<td><?php echo $serial++; ?></td>
							<td><?php echo htmlspecialchars($row['full_name']); ?></td>
							<td><?php echo htmlspecialchars($row['email']); ?></td>
							<td><?php echo htmlspecialchars($row['matric_number']); ?></td>
							<td><?php echo htmlspecialchars($row['department']); ?></td>
							<td>
								<form class="table-actions" action="delete.php" method="post" onsubmit="return confirmMatric(<?php echo (int)$row['id']; ?>, '<?php echo htmlspecialchars($row['matric_number']); ?>', this);">
									<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>" />
									<input type="hidden" name="matric_number" value="" />
									<button class="btn btn-danger" type="submit">Delete</button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		</div>
	</div>
</body>
</html>

<script>
function confirmMatric(id, matric, formEl) {
	const input = prompt('Type the matric number to confirm deletion for ID ' + id + ':');
	if (input === null) return false;
	if (input.trim() !== matric.trim()) {
		alert('Matric number does not match. Deletion cancelled.');
		return false;
	}
	formEl.querySelector('input[name="matric_number"]').value = input.trim();
	return true;
}
</script>


