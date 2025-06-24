<?php
function set_title(string $title = 'Cerebro')
{
    if (isset($title)) {
        return $title;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title is set dynamically -->
    <title><?= set_title('Cerebro' ?? null) ?></title>
    <link rel="icon" href="/cerebro/assets/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="/cerebro/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cerebro/assets/css/style.css">

    <style>
        body {
            font-family: 'SF Pro Display', sans-serif;
        }
    </style>

</head>