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
        <!-- Header Section -->
        <section class="header-section mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-light shadow-sm" onclick="window.history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l5.147 5.146a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708.708L2.707 7.5H14.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </button>
                <h5 class="mb-0 fw-bold">Edit Profile</h5>
                <button class="btn btn-light shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                </button>
            </div>
        </section>

        <!-- Profile Picture Section -->
        <section class="profile-picture-section text-center mb-4">
            <div class="position-relative d-inline-block">
                <img src="../assets/img/avatar.jpg" alt="Profile Picture" class="rounded-circle shadow" width="120" height="120">
                <!-- Camera Icon for Image Upload -->
                <button class="btn btn-pink position-absolute bottom-0 end-0 rounded-circle p-2" onclick="document.getElementById('avatarUpload').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M10.5 2a.5.5 0 0 1 .5.5V3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1V2.5a.5.5 0 0 1 .5-.5h6zM4 3v1h8V3H4z" />
                        <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                    </svg>
                </button>
                <!-- Hidden File Input -->
                <input type="file" id="avatarUpload" class="d-none" accept="image/*">
            </div>
        </section>

        <!-- Personal Information Section -->
        <section class="personal-info-section mb-4">
            <h6 class="text-muted mb-3">PERSONAL INFORMATION</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#editNameModal">
                    Name
                    <span class="text-muted"><?= htmlspecialchars($user['username']) ?? 'User' ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                    Email
                    <span class="text-muted"><?= htmlspecialchars($user['email']) ?? 'N/A' ?></span>
                </li>
            </ul>
        </section>

        <!-- Account Section -->
        <section class="account-section">
            <h6 class="text-muted mb-3">ACCOUNT</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                    Password
                    <span class="text-muted">••••••••</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#editPhoneModal">
                    Phone Number
                    <span class="text-muted">+62 872-456-7890</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center text-danger" data-bs-toggle="modal" data-bs-target="#closeAccountModal">
                    Close My Account
                </li>
            </ul>
        </section>
    </main>

    <!-- Modals -->
    <!-- Edit Name Modal -->
    <div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Enter your name" value="<?= htmlspecialchars($user['username']) ?? '' ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Email Modal -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="email" class="form-control" placeholder="Enter your email" value="<?= htmlspecialchars($user['email']) ?? '' ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Password Modal -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="password" class="form-control mb-3" placeholder="Enter new password">
                    <input type="password" class="form-control mb-3" placeholder="Confirm new password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Phone Modal -->
    <div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhoneModalLabel">Edit Phone Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Enter your phone number" value="+62 872-456-7890">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Close Account Modal -->
    <div class="modal fade" id="closeAccountModal" tabindex="-1" aria-labelledby="closeAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closeAccountModalLabel">Close My Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to close your account? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Close Account</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>