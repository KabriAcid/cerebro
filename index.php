<?php
require __DIR__ . '/util/utiliities.php';
$user = [
    "name" => "M Shehu",
    "username" => "Shehu",
    "email" => "shehu@gmail.com",
]
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title is set dynamically -->
    <title><?= set_title('Cerebro' ?? null) ?></title>
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }
    </style>

</head>

<body>
    <header>
        <nav class="container-fluid navbar-fixed navbar-top p-4">
            <div class="d-flex justify-content-between">
                <a href="index.php">
                    <img src="assets/img/logo.png" class="favicon">
                </a>
                <ul class="nav-links">
                    <li>Home</li>
                    <li>Contact</li>
                    <li>About</li>
                </ul>
                <span></span>
            </div>
        </nav>
    </header>
    <main>
        <section class="py-5 text-center">
            <h1>Smart AI companion for anytime assistance</h1>
            <p class="text-secondary">Your smart AI companion, ready to assist with mental health conditions, keeping you <br> informed and engaged anytime, anywhere you go.</p>
        </section>
        <section id="button-container">
            <div class="d-flex justify-content-center align-items-center">
                <a href="/cerebro/auth/login.php" class="secondary-btn">Login</a>
                <a href="/cerebro/auth/register.php" class="primary-btn">Register</a>
            </div>
        </section>
    </main>
</body>

</html>