<?php
    session_start();
    include('config.php');

    // check log in
    if (!isset($_SESSION['loggedin'])) {
        // will redirect user to login page to login
        header('Location: http://localhost/Palva/login.php');
        exit;
    }
    
    // to view user's account information (masih bug)
    $usertype = "";
    if ($_SESSION['isadmin'] == true) {
        $usertype = "&star;ADMIN&star;";
    } else {
        $usertype = "USER";
    }

    $username = $_SESSION["username"];

    // log out function
    function logout() {
        session_start(); // start session
        session_unset(); // unset all session variable such as 'loggedin' and 'isadmin'
        session_destroy(); // destroy the session
        
        header('Location: http://localhost/Palva/homepage.php');
        exit;
    }
    if (isset($_POST['logout'])) {
        logout();
    }
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
            <div class="link"><a href="homepage.php">HOME</a></div>
            <div class="link"><a href="workspace.php">WORKSPACE</a></div>
            <div class="link"><a href="login.php">LOGIN</a></div>
            <div class="link"><a href="account.php" id="current">USER SETTINGS</a></div>
        </div>
    </div>
    <div id="main">
        <img src="./img/hero_bg1.png" alt="hero-bg-img" class="main-background">
        <div class="main-items">
            <div class="glasshold">
                <h2>USER INFORMATION</h2>
                <br>
                <div class="circle">
                    <img src="./img/simple_accImg.png" alt="acc_img">
                </div>
                <br>
                <div class="textbox">
                    <p>
                        <?php
                        echo $usertype;
                        ?>
                    </p>
                </div>
                <div class="textbox">
                    <p>
                        <?php
                            echo $username;
                        ?>
                    </p>
                </div>
                <div class="textbox">
                    <p>*********</p>
                </div>
                <input type="button" value="UPDATE INFO" class="bclick" onclick="window.location.href='http://localhost/Palva/update.php'">
                <br><br>
                <h3>want to report a problem or make suggestion? <a href="http://localhost/Palva/report.php">CLICK HERE</a></h3>
                <br><br>
                <form action="" method="post">
                    <input type="submit" name="logout" value="LOG OUT" class="bclick reset">
                </form><br><br>
            </div>
        </div>
    </div>
    <div id="footer">
        <center>
            &copy;Palva
        </center>
    </div>
</body>
</html>