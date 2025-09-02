# Student Registration System

Name: Godwin Dumbari Victor

Matric Number: 23/CSC/255  

Course Code: CSC 282

Assignment Title: Student Registration System (Contact Manager)

## Quick start
- Import `schema.sql` into your MySQL server (create database, e.g., `php_assignment`).
- Update `db.php` with your DB credentials.
- Run locally:
  ```bash
  php -S 127.0.0.1:8000 -t"
  ```
  Visit `http://127.0.0.1:8000/`.

## Files included
- PHP files (`.php`): `index.php`, `process.php`, `view.php`, `delete.php`, `db.php`
- `schema.sql`
- `styles.css`
- `README.md`

## Features
- Register students (Full Name, Email, Department, Matric Number)
- Searchable Department dropdown (UNICROSS departments)
- Prevent duplicate matric and email
- View all students with serial numbering
- Delete with matric confirmation + success alert
- Responsive, professional UI with loading state on submit
