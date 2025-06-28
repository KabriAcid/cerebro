<?php
session_start();

require __DIR__ . '/../util/utilities.php';
require __DIR__ . '/../components/header.php';
?>

<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>
    <main class="container py-5">
        <h2 class="text-center mb-4">Contact Us</h2>
        <p class="text-center text-secondary">We'd love to hear from you! Feel free to reach out to us using the form below.</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="send-message.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="input-field" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="input-field" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="input-field" id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn primary-btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>