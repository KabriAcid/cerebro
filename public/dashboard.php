<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main class="container-fluid">
        <section class="intro-section" id="introText">
            <h1 class="text-center fw-bold">How may I assist you today?</h1>
        </section>

        <!-- Chat Container -->
        <section class="chat-container container my-4" id="chatContainer">
            <!-- Messages will be appended here -->
        </section>

        <!-- Form Container -->
        <section class="form-container container pb-4">
            <div class="d-flex align-items-center position-relative">
                <!-- Textarea for input -->
                <textarea id="userPrompt"
                    class="form-control input-field me-2"
                    rows="1"
                    placeholder="Type your message here..."
                    oninput="autoResize(this)"></textarea>

                <!-- Submit button -->
                <button class="submit-btn d-flex align-items-center justify-content-center"
                    onclick="submitPrompt()" id="submitBtn">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437"
                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <!-- Info Text -->
            <p id="info-text">
                This chatbot is not a substitute for professional help.
            </p>
        </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>