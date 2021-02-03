<?php include 'db.php'; ?>
<?php include 'functions.php';

$page = substr($_SERVER['REQUEST_URI'], 0, -4);

if (!isset($_SESSION['loggedin']) && (strpos($page, 'login') === false)) {
    redirect_to('login.php');
} ?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta meta="" name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" type="image/png" href="assets/images/favicon.png"/>
    <link rel="stylesheet" href="assets/style/style.css">
    <title>ReMaS ~ Recycling Management System</title>
</head>
<html>
<body>

<header class="top-bar">
    <div class="left">
        ReMaS Superior Waste Recycling
        <span class="version">Versie: 1.00</span>
    </div>
    <div class="right">
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        }

        if (!isset($_SESSION['loggedin'])) { ?>
            <form class="login-form" action="" method="post">
                <input type="email" name="email" required placeholder="E-mail">
                <input type="password" name="password" required placeholder="Wachtwoord">
                <button class="login-button" type="submit" name="login">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 551.13 551.13" height="20"
                         viewBox="0 0 551.13 551.13" width="20">
                        <path fill="#FFFFFF"
                              d="m499.462 0h-378.902c-9.52 0-17.223 7.703-17.223 17.223v51.668h34.446v-34.445h344.456v482.239h-344.456v-34.446h-34.446v51.668c0 9.52 7.703 17.223 17.223 17.223h378.902c9.52 0 17.223-7.703 17.223-17.223v-516.684c0-9.52-7.704-17.223-17.223-17.223z"/>
                        <path fill="#FFFFFF"
                              d="m204.588 366.725 24.354 24.354 115.514-115.514-115.514-115.514-24.354 24.354 73.937 73.937h-244.079v34.446h244.08z"/>
                    </svg>
                </button>
            </form>
        <?php } else { ?>
            Ingelogd als <?= $_SESSION["name"] ?>
            <a class="logout-button" href="logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Capa_1" x="0px" y="0px" viewBox="0 0 384.971 384.971"
                     xml:space="preserve" width="20" height="20">
                        <path fill="#FFFFFF"
                              d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03    C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03    C192.485,366.299,187.095,360.91,180.455,360.91z"/>
                    <path fill="#FFFFFF"
                          d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279    c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179    c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"/>
                </svg>
            </a>
        <?php } ?>
    </div>
</header>

<div class="<?php if (isset($_SESSION['loggedin'])) { ?>layout<?php } ?> container">
    <?php if (isset($_SESSION['loggedin'])) { ?>
        <nav>
            <img class="logo" src="assets/images/logo.png" alt="logo ReMaS">
            <ul>
                <?php $role = $_SESSION['role']; ?>
                <?php if ($role == 2 || $role == 5) { ?><a class="link" href="inname.php">Inname</a><?php } ?>
                <?php if ($role == 3 || $role == 5) { ?><a class="link" href="verwerking.php">Verwerking</a><?php } ?>
                <?php if ($role == 4 || $role == 5) { ?><a class="link" href="uitgifte.php">Uitgifte</a><?php } ?>
                <?php if ($role != 6) { ?>              <a class="link" href="rapportage.php">Rapportage</a><?php } ?>
                <?php if ($role == 5 || $role == 6) { ?><a class="link" href="onderhoud.php">Onderhoud</a><?php } ?>
            </ul>
        </nav>
    <?php } ?>
    <main>