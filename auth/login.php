<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';
require __DIR__ . '/../components/header.php';

$success = '';
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $success = "Registration Successful. Please log in.";
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = clean_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
    }

    if ($user && $user['password'] === md5($password)) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../public/dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>
    <main class="container-fluid py-5">
        <div class="container text-center mt-5">
            <h3 class="display-4 fw-bold gradient-text">Login to your account</h3>
        </div>
        <div class="container d-flex align-items-center justify-content-center mt-3">
            <div class="p-4" style="max-width: 600px; width: 100%;">
                <?php if ($error): ?>
                    <div class="alert alert-danger text-center fw-bold"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="text-success text-center fw-bold"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="form-row">
                        <input type="email" class="input-field" id="email" name="email" placeholder="Username or email address" required maxlength="100">
                    </div>
                    <div class="form-row">
                        <input type="password" class="input-field" id="password" name="password" placeholder="Password" required minlength="6">
                    </div>
                    <div class="form-row d-block">
                        <a href="#" class="text-secondary text-right d-block text-sm my-3">Forgot Password?</a>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn primary-btn w-100 d-block" style="max-width: 100%;">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <span class="text-secondary">Don't have an account?</span>
                    <a href="register.php" class="fw-bold">Create an account</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Loader Overlay -->
    <div id="loaderOverlay" class="loader-overlay d-none">
        <div class="loader-content">
            <img src="/cerebro/assets/img/logo.png" alt="App Logo" class="loader-logo">
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Show the loader overlay
            const loaderOverlay = document.getElementById('loaderOverlay');
            loaderOverlay.classList.remove('d-none');

            setTimeout(() => {
                this.submit();
            }, 2000);
        });
        window.addEventListener("load", () => {
            const url = new URL(window.location);
            url.searchParams.delete("success");
            window.history.replaceState(null, null, url.pathname + url.search);
        });
    </script>
</body>

</html>