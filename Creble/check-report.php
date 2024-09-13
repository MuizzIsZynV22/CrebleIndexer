<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        // will redirect user to login page to login
        header('Location: http://localhost/miniProject_Sem3/login.php');
    }

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
</head>
<body>
    <div id="header">
        <div class="banner">
            <img src="./img/LogoKVKS2.png" alt="">
            <img src="./img/Group 1Palva_logo.png" alt="My Logo">
        </div>
        <div class="navbar">
            <div class="link"><a href="homepage.php">HOME</a></div>
            <div class="link"><a href="workspace.php" id="current">WORKSPACE</a></div>
            <div class="link"><a href="login.php">LOGIN</a></div>
            <div class="link"><a href="account.php">USER SETTING</a></div>
        </div>
    </div>
    <div id="main">

    </div>
    <div id="footer">
        <center>
            &copy;Palva
        </center>
    </div>
</body>
</html>