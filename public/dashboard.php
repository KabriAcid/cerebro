<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main>
        <section class="intro-section" id="introText">
            <h1 class="text-center fw-bold">How may I assist you today?</h1>
        </section>

        <!-- Loader -->
        <div class="loader" id="loader" style="display: none;"></div>

        <!-- Response container -->
        <section class="response-container" id="responseContainer" style="display: none;">
            <div class="response-message" id="responseMessage"></div>
        </section>

        <!-- Form container -->
        <section class="form-container">
            <div class="position-relative d-flex align-items-center">
                <!-- Input Field -->
                <input type="text" class="input-field" id="userPrompt" placeholder="Type your message here" required>

                <!-- Submit Button -->
                <button class="submit-btn" onclick="submitPrompt()">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <p class="text-xs text-secondary my-3 text-center">This chatbot is not a substitute for professional help.</p>
        </section>
    </main>
    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>