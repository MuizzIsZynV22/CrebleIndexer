<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVKS Palva</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/user-interface.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div id="header">
        <div class="banner">
            <img src="./img/LogoKVKS2.png" alt="">
            <img src="./img/Group 1Palva_logo.png" alt="My Logo">
        </div>
        <div class="navbar">
            <div class="link"><a href="homepage.php" id="current">HOME</a></div>
            <div class="link"><a href="workspace.php">WORKSPACE</a></div>
            <div class="link"><a href="login.php">LOGIN</a></div>
            <div class="link"><a href="account.php">USER SETTINGS</a></div>
        </div>
    </div>
    <div id="main">
        <img src="./img/hero_bg1.png" alt="hero-bg-img" class="main-background">
        <div class="home-items">
            <p>WELCOME TO PALVA</p>
            <p>&bot;</p>
            <p>LET'S BUILD AS YOU LIKE</p>
            <br>
            <button class="bigset" onclick="window.location.href='http://localhost/Palva/workspace.php'">START CREATING</button>
        </div>
    </div>
    <div id="footer">
        <center>
            &copy;Palva
        </center>
    </div>
</body>
</html>