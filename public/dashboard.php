<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';

$user = get_user_info($pdo, $user_id);
?>
<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main>
        <?php if ($user['registration_status'] != 'complete'): ?>
            <!-- Modal -->
            <div class="modal" id="roleModal" tabindex="-1" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: var(--round-3);">
                        <div class="modal-header" style="border-bottom: none;">
                            <h5 class="modal-title text-center w-100">Select Your Career</h5>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-secondary">Please select the career that best describes you:</p>
                            <div class="row">
                                <!-- Career Cards -->
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectRole('Software Engineer')">
                                        <h6 class="fw-bold">Software Engineer</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectRole('Data Scientist')">
                                        <h6 class="fw-bold">Data Scientist</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectRole('Product Manager')">
                                        <h6 class="fw-bold">Product Manager</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectRole('UI/UX Designer')">
                                        <h6 class="fw-bold">UI/UX Designer</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: none;">
                            <button class="btn mini-btn w-100" onclick="submitRole()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <section class="my-5">
            <h1 class="text-center fw-bold mt-5">How may I assist you today?</h1>
        </section>
        <section class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="position-relative d-flex align-items-center">
                    <!-- Upload Media Button -->
                    <button type="button" class="upload-media-btn" title="Upload Media">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 16V8M8 12H16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#e500ac" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Input Field -->
                    <input type="text" class="input-field" placeholder="Type message here" name="message">

                    <!-- Upload Button Inside Input -->
                    <button type="submit" class="submit-btn">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>
    </main>
    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>