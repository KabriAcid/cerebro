<!-- filepath: c:\xampp\htdocs\cerebro\public\about.php -->
<?php
session_start();
require __DIR__ . '/../util/utilities.php';
require __DIR__ . '/../components/header.php';
?>

<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>
    <main class="container py-5">
        <h2 class="text-center mb-4">About Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="text-secondary text-center">
                    Welcome to Cerebro, your smart AI companion designed to assist you with everyday tasks and provide insightful responses. Our mission is to make AI accessible and helpful for everyone, empowering users with intelligent tools to stay informed and engaged.
                </p>
                <p class="text-secondary text-center">
                    Whether you're looking for quick answers, mental health support, or just a friendly conversation, Cerebro is here to help. Built with cutting-edge AI technology, our platform ensures a seamless and user-friendly experience.
                </p>
                <p class="text-secondary text-center">
                    Thank you for choosing Cerebro. Together, let's explore the possibilities of AI and make your life easier.
                </p>
            </div>
        </div>
    </main>
    <p class="text-xs small text-secondary text-center">@Copyright Dreamerscodes | github@KabriAcid</p>
</body>

</html>