<?php
require_once __DIR__ . '/../config/database.php';
require __DIR__ . '/../components/header.php';

// Helper function to sanitize input
function clean_input($data)
{
    return htmlspecialchars(trim($data));
}

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = clean_input($_POST['name'] ?? '');
    $email    = clean_input($_POST['email'] ?? '');
    $phone    = clean_input($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    // Basic validation
    if (!$name || !$email || !$phone || !$password) {
        $error = "All fields are required.";
    } else {
        // Check if email or phone already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
        $stmt->execute([$email, $phone]);
        if ($stmt->fetch()) {
            $error = "Email or phone already exists.";
        } else {
            // Hash password with md5 (for legacy compatibility)
            $hashed_password = md5($password);

            // Insert user into database
            $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$name, $email, $phone, $hashed_password]);

            if ($result) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
