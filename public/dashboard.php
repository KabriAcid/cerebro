<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';
$user = get_user_info($pdo, $_SESSION['user_id'] ?? null);
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main class="container-fluid">
        <!-- Rest of the content -->
        <?php if ($user['registration_status'] != 'complete'): ?>
            <!-- Modal -->
            <div class="modal" id="careerModal" tabindex="-1" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: var(--round-1);border: none;">
                        <div class="modal-header" style="border-bottom: none;">
                            <h5 class="modal-title text-center w-100 mb-0 primary">Select Your Career</h5>
                        </div>
                        <div class="modal-body py-0 my-0">
                            <p class="text-center text-secondary">Please select the career that best describes you:</p>
                            <div class="row my-4">
                                <!-- Career Cards -->
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectCareer('Software Engineer')">
                                        <h6 class="fw-bold">Software Engineer</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectCareer('Data Scientist')">
                                        <h6 class="fw-bold">Data Scientist</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectCareer('Product Manager')">
                                        <h6 class="fw-bold">Product Manager</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="info-card text-center p-3" onclick="selectCareer('UI/UX Designer')">
                                        <h6 class="fw-bold">UI/UX Designer</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: none;">
                            <button class="btn mini-btn w-100" onclick="submitCareer()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <section class="intro-section" id="introText">
            <h1 class="text-center fw-bold">How may I assist you today?</h1>
        </section>

        <!-- Chat Container -->
        <section class="chat-container container my-4" id="chatContainer">
            <!-- Messages will be dynamically appended here -->
        </section>

        <!-- Form Container -->
        <section class="form-container container pb-4">
            <div class="d-flex align-items-center position-relative">
                <!-- Input Field -->
                <textarea id="userPrompt"
                    class="form-control input-field me-2"
                    rows="1"
                    placeholder="Type your message here..."
                    oninput="autoResize(this)"></textarea>

                <!-- Submit Button -->
                <button class="submit-btn d-flex align-items-center justify-content-center"
                    onclick="submitPrompt()" id="submitBtn">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437"
                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <p id="info-text">This AI assistant is not a licensed mental health professional.</p>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.0.5/dist/purify.min.js"></script>
    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>