<!-- filepath: c:\xampp\htdocs\cerebro\public\profile.php -->
<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';

$user = get_user_info($pdo, $_SESSION['user_id'] ?? null);
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <main class="container py-4">
        <!-- Profile Section -->
        <section class="profile-section mb-4 bg-white shadow p-3 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <img src="../assets/img/avatar.jpg" alt="Profile Picture" class="rounded-circle me-3" width="60" height="60">
                <div class="text-center">
                    <h5 class="mb-0 fw-bold"><?= htmlspecialchars($user['username']) ?? 'User' ?></h5>
                    <p class="mb-0 text-muted"><?= htmlspecialchars($user['email']) ?? 'N/A' ?></p>
                </div>
                <button class="btn primary shadow ms-auto" onclick="window.location.href='profile.php'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-4 1a.5.5 0 0 1-.63-.63l1-4a.5.5 0 0 1 .11-.168l10-10zM11.207 2L13 3.793 12.207 4.5 10.5 2.793 11.207 2zM10.5 3.5L2.5 11.5 2 13l1.5-.5 8-8L10.5 3.5z" />
                    </svg>
                </button>
            </div>
        </section>

        <!-- Application Section -->
        <section class="application-section mb-4">
            <h6 class="text-muted mb-3">APPLICATION</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Theme
                    <span class="text-muted">Light mode</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Subscription
                    <span class="text-muted">Free Plan</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Notification
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="notificationSwitch" checked>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Data Controls
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    App Language
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
            </ul>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <h6 class="text-muted mb-3">ABOUT</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Help Center
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Terms of Use
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Privacy Policy
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    License
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.646 4.646a.5.5 0 0 1 .708 0L10 7.293l-2.646 2.647a.5.5 0 0 1-.708-.708L8.793 7.5 6.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </li>
            </ul>
        </section>
    </main>
</body>

</html>