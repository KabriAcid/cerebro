<!-- filepath: c:\xampp\htdocs\cerebro\public\help.php -->
<?php
session_start();
require __DIR__ . '/../util/utilities.php';
require __DIR__ . '/../components/header.php';
?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main class="container py-5">
        <h2 class="text-center mb-4">Help Center</h2>
        <div class="custom-accordion">
            <!-- Section 1: Getting Started -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>Getting Started</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>Welcome to Cerebro! To get started, create an account or log in if you already have one. Once logged in, you can access the dashboard, chat with the AI, and manage your settings.</p>
                </div>
            </div>

            <!-- Section 2: Chatbot Usage -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>How to Use the Chatbot</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>To use the chatbot, navigate to the chat section from the dashboard. Type your query in the input box and press Enter. The AI will respond based on the selected model and settings.</p>
                    <p>You can configure the chatbot's behavior, such as the maximum tokens, in the settings section.</p>
                </div>
            </div>

            <!-- Section 3: Managing Your Account -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>Managing Your Account</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>You can update your profile information, such as your name, email, and password, in the profile section. If you wish to close your account, you can do so from the same section.</p>
                </div>
            </div>

            <!-- Section 4: Chat History -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>Viewing Chat History</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>Your chat history is saved and can be accessed from the "Chat History" section in the dashboard. You can view past conversations, including the prompts and responses, along with timestamps.</p>
                </div>
            </div>

            <!-- Section 5: Troubleshooting -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>Troubleshooting</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>If you encounter any issues, try the following steps:</p>
                    <ul>
                        <li>Ensure you have a stable internet connection.</li>
                        <li>Clear your browser cache and cookies.</li>
                        <li>Log out and log back in to your account.</li>
                        <li>Contact support if the issue persists.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 6: Contact Support -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h5>Contact Support</h5>
                    <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-body">
                    <p>If you need further assistance, please contact our support team at <a href="mailto:support@cerebro.com">support@cerebro.com</a>.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleAccordion(header) {
            const body = header.nextElementSibling;
            const icon = header.querySelector('.accordion-icon');

            if (body.style.maxHeight) {
                body.style.maxHeight = null;
                icon.textContent = '+';
            } else {
                document.querySelectorAll('.accordion-body').forEach(el => el.style.maxHeight = null);
                document.querySelectorAll('.accordion-icon').forEach(el => el.textContent = '+');
                body.style.maxHeight = body.scrollHeight + 'px';
                icon.textContent = '-';
            }
        }
    </script>
    <script src="../assets/js/script.js"></script>
</body>

</html>