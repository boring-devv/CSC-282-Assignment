<?php
require_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Student Registration</title>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<div class="container">
		<div class="nav">
			<a class="active" href="index.php">Register</a>
			<a href="view.php">View Students</a>
		</div>

		<h1>Student Registration</h1>

		<?php if (isset($_GET['success'])): ?>
			<div class="notice">Registration successful. <button class="alert-close" onclick="this.parentElement.remove()" aria-label="Close">×</button></div>
		<?php elseif (isset($_GET['error'])): ?>
			<div class="error"><?php echo htmlspecialchars($_GET['error']); ?> <button class="alert-close" onclick="this.parentElement.remove()" aria-label="Close">×</button></div>
		<?php endif; ?>

		<div class="card">
			<form id="registerForm" action="process.php" method="post" novalidate class="form-grid">
				<div class="full">
					<label for="full_name">Full Name</label>
					<input type="text" id="full_name" name="full_name" placeholder="Jane Doe" required />
				</div>
				<div>
					<label for="email">Email</label>
					<input type="email" id="email" name="email" placeholder="jane@example.com" required />
				</div>
				<div>
					<label for="department">Department</label>
					<input list="departments" id="department" name="department" placeholder="Start typing to search..." required />
				</div>
				<div class="full">
					<label for="matric_number">Matric Number</label>
					<input type="text" id="matric_number" name="matric_number" placeholder="CSC/2025/1234" required />
				</div>
				<div class="full actions">
				<button id="submitBtn" class="btn" type="submit">
					<span class="btn-text">Register</span>
					<span class="spinner" aria-hidden="true" style="display:none;margin-left:8px;vertical-align:middle;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="12" cy="12" r="9" stroke="rgba(255,255,255,.4)" stroke-width="3"/>
							<path d="M21 12a9 9 0 0 0-9-9" stroke="#fff" stroke-width="3" stroke-linecap="round">
								<animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/>
							</path>
						</svg>
					</span>
				</button>
				</div>
			</form>
			<datalist id="departments">
				<option value="Microbiology"></option>
				<option value="Animal Health and Environmental Biology"></option>
				<option value="Plant Science and Biotechnology"></option>
				<option value="Educational Management"></option>
				<option value="Vocational and Technical Education"></option>
				<option value="Human Kinetics and Health Education"></option>
				<option value="Educational Foundations and Administration"></option>
				<option value="Curriculum and Instructional Technology"></option>
				<option value="Library and Information Science"></option>
				<option value="Guidance and Counselling"></option>
				<option value="Civil Engineering"></option>
				<option value="Electrical/Electronic Engineering"></option>
				<option value="Mechanical Engineering"></option>
				<option value="Wood Product Engineering"></option>
				<option value="Mass Communication"></option>
				<option value="Journalism and Media Studies"></option>
				<option value="Broadcasting"></option>
				<option value="Urban and Regional Planning"></option>
				<option value="Estate Management"></option>
				<option value="Visual Arts and Technology"></option>
				<option value="Architecture"></option>
				<option value="Architectural Design"></option>
				<option value="Sustainable Architecture and Urban Design"></option>
				<option value="Chemistry"></option>
				<option value="Physics"></option>
				<option value="Mathematics & Statistics"></option>
				<option value="Computer Science"></option>
				<option value="Biochemistry"></option>
				<option value="Accountancy"></option>
				<option value="Marketing"></option>
				<option value="Hospitality and Tourism"></option>
				<option value="Business Administration"></option>
				<option value="Human Physiology"></option>
				<option value="Human Anatomy and Forensic Anthropology"></option>
				<option value="Medical Biochemistry"></option>
				<option value="Animal Science"></option>
				<option value="Agronomy"></option>
				<option value="Agricultural Economics and Extension"></option>
				<option value="Fishery and Aquatic Sciences"></option>
				<option value="Forestry and Wildlife Management"></option>
			</datalist>
		</div>

		<div class="footer">Use the View Students tab to see all entries.</div>
	</div>
</body>
</html>

<script>
const form = document.getElementById('registerForm');
const submitBtn = document.getElementById('submitBtn');
const btnText = submitBtn.querySelector('.btn-text');
const spinner = submitBtn.querySelector('.spinner');

form.addEventListener('submit', function() {
	btnText.textContent = 'Submitting...';
	spinner.style.display = 'inline-block';
	submitBtn.disabled = true;
});
</script>


