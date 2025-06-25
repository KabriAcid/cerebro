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
    $username     = clean_input($_POST['username'] ?? '');
    $email    = clean_input($_POST['email'] ?? '');
    $phone    = clean_input($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password != $confirm_password) {
        $error .= 'Passwords do not match';
        exit;
    }

    if (strlen($phone) <= 10) {
        $error .= 'Phone Number is too short';
        exit;
    }

    // Basic validation
    if (!$username || !$email || !$phone || !$password) {
        $error = "All fields are required.";
        exit;
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
            $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$username, $email, $phone, $hashed_password]);

            if (!$result) {
                $error = "Registration failed. Please try again.";
            } else {
                header("Location: login.php?success=true");
            }
        }
    }
}
?>

<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>
    <main class="container-fluid py-5">
        <div class="container text-center mt-5">
            <h3 class="display-4 fw-bold">Create new account</h3>
        </div>
        <div class="container d-flex align-items-center justify-content-center mt-3">
            <div class="p-4" style="max-width: 600px; width: 100%;">
                <?php if ($error): ?>
                    <div class="alert-danger text-center fw-bold"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="form-row">
                        <input type="text" class="input-field" id="name" name="username" placeholder="Username" required maxlength="100">
                    </div>
                    <div class="form-row">
                        <input type="email" class="input-field" id="email" name="email" placeholder="Email address" required maxlength="100">
                    </div>
                    <div class="form-row">
                        <input type="tel" class="input-field" id="phone" name="phone" placeholder="Phone Number" required maxlength="15">
                    </div>

                    <div class="form-row">
                        <input type="password" class="input-field" id="password" name="password" placeholder="Password" required minlength="6">
                    </div>
                    <div class="form-row">
                        <input type="password" class="input-field" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required minlength="6">
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn primary-btn w-100 d-block" style="max-width: 100%;">Register</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <span class="text-secondary">Already have an account?</span>
                    <a href="login.php" class="text-primary fw-bold">Login</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>