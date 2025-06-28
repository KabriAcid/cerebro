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
                <button class="btn primary" onclick="window.history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l5.147 5.146a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708.708L2.707 7.5H14.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </button>
                <h5 class="mb-0 fw-bold">Edit Profile</h5>
                <button class="btn primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                </button>
            </div>
        </section>

        <!-- Profile Picture Section -->
        <section class="profile-picture-section text-center mb-4">
            <div class="position-relative d-inline-block">
                <img src="../assets/img/avatar.jpg" alt="Profile Picture" class="rounded-circle shadow" width="80" height="80">
                <!-- Camera Icon for Image Upload -->
                <button class="btn primary position-absolute bottom-0 end-0 rounded-circle p-2" onclick="document.getElementById('avatarUpload').click()">
                    <!-- Svg for upload -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M10.5 2a.5.5 0 0 1 .5.5V3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1V2.5a.5.5 0 0 1 .5-.5h6zM4 3v1h8V3H4z" />
                        <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                </button>
                <!-- Hidden File Input -->
                <input type="file" id="avatarUpload" class="d-none" accept="image/*">
            </div>
        </section>

        <!-- Personal Information Section -->
        <section class="personal-info-section mb-4">
            <h6 class="text-muted mb-2 small">PERSONAL INFORMATION</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="openCustomModal('editNameModal')">
                    Name
                    <span class="text-muted"><?= htmlspecialchars($user['username']) ?? 'User' ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="openCustomModal('editEmailModal')">
                    Email
                    <span class="text-muted"><?= htmlspecialchars($user['email']) ?? 'N/A' ?></span>
                </li>
            </ul>
        </section>

        <!-- Account Section -->
        <section class="account-section">
            <h6 class="text-muted mb-2 small">ACCOUNT</h6>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="openCustomModal('editPasswordModal')">
                    Password
                    <span class="text-muted">••••••••</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="openCustomModal('editPhoneModal')">
                    Phone Number
                    <span class="text-muted">+62 872-456-7890</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center text-danger cursor-pointer" onclick="openCustomModal('closeAccountModal')">
                    Close My Account
                </li>
            </ul>
        </section>
    </main>

    <!-- Custom Modal -->
    <div id="customModal" class="custom-modal" onclick="closeCustomModal()">
        <div class="custom-modal-content rounded-top shadow" onclick="event.stopPropagation()">
            <div id="customModalBody" class="position-relative"></div>
        </div>
    </div>


    <!-- Modal Content -->
    <!-- Edit Name Modal -->
    <div id="editNameModal" class="d-none">
        <h6 class="mb-3 primary text-center">Edit Name</h6>
        <input type="text" class="input-field" name="name" value="<?= htmlspecialchars($user['username']) ?? '' ?>">
        <button class="btn primary-btn mt-3" style="min-width: 100%;" onclick="updateModalContent('editName')">Save</button>
    </div>

    <!-- Edit Email Modal -->
    <div id="editEmailModal" class="d-none">
        <h6 class="mb-3 primary text-center">Edit Email</h6>
        <input type="email" class="input-field" name="email" value="<?= htmlspecialchars($user['email']) ?? '' ?>">
        <button class="btn primary-btn mt-3" style="min-width: 100%;" onclick="updateModalContent('editEmail')">Save</button>
    </div>

    <!-- Edit Password Modal -->
    <div id="editPasswordModal" class="d-none">
        <h6 class="mb-3 primary text-center">Change Password</h6>
        <input type="password" class="input-field mb-2" name="newPassword" placeholder="New Password">
        <input type="password" class="input-field mb-2" name="confirmPassword" placeholder="Confirm Password">
        <button class="btn primary-btn mt-3" style="min-width: 100%;" onclick="updateModalContent('editPassword')">Save</button>
    </div>

    <!-- Edit Phone Modal -->
    <div id="editPhoneModal" class="d-none">
        <h6 class="mb-3 primary text-center">Edit Phone Number</h6>
        <input type="text" class="input-field" name="phone" value="+62 872-456-7890">
        <button class="btn primary-btn mt-3" style="min-width: 100%;" onclick="updateModalContent('editPhone')">Save</button>
    </div>

    <!-- Close Account Modal -->
    <div id="closeAccountModal" class="d-none">
        <h6 class="mb-3 primary text-center">Close My Account</h6>
        <p>Are you sure you want to close your account? This action cannot be undone.</p>
        <button class="btn btn-danger mt-3" onclick="updateModalContent('closeAccount')">Close Account</button>
    </div>

    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function openCustomModal(modalId) {
            const modalContent = document.getElementById(modalId).innerHTML;
            document.getElementById('customModalBody').innerHTML = modalContent;
            document.getElementById('customModal').classList.add('show');
        }

        function closeCustomModal() {
            document.getElementById('customModal').classList.remove('show');
        }

        function updateModalContent(action) {
            const modalBody = document.getElementById('customModalBody');
            const inputs = modalBody.querySelectorAll('input');
            const data = {};

            inputs.forEach(input => {
                data[input.name || input.placeholder] = input.value;
            });

            console.log('Action:', action); // Debug: Check the action
            console.log('Data:', data); // Debug: Check the data being sent

            sendAjaxRequest(
                `../api/update-profile.php?action=${action}`,
                'POST',
                data,
                function(response) {
                    console.log('Response:', response); // Debug: Check the response
                    alert(response.message || 'Update successful!');
                    window.location.reload();
                    closeCustomModal();
                },
                function(error) {
                    console.error('Error:', error); // Debug: Check the error
                    alert(error.error || 'An error occurred.');
                }
            );
        }
    </script>
</body>

</html>