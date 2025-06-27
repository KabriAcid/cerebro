<?php
require __DIR__ . '/util/utilities.php';
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
        <nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm" id="mainNavbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" class="favicon" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#about">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="py-5 text-center mt-5">
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