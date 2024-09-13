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
            <div class="link"><a href="workspace.php" id="current">WORKSPACE</a></div>
            <div class="link"><a href="login.php">LOGIN</a></div>
            <div class="link"><a href="account.php">USER SETTINGS</a></div>
        </div>
    </div>
    <div id="main">
        <img src="./img/hero_bg1.png" alt="hero-bg-img" class="main-background">
        <div class="main-items">

            <!-- Workspace -->
            <div id="workspace">
                <form action="" method="POST" class="d-flex">
                    <h2>Table Title</h2><input type="text" name="table_title" value="Jadual Cuti  Sem">
                </form>
                <br>
                <h2>Add Block</h2>
                <div id="wordInput">
                    <label for="blockText">Block Text:</label>
                    <input type="text" id="blockText">
                    <label for="blockColor">Block Color:</label>
                    <input type="color" id="blockColor">
                    <button id="createBlockBtn">Create Block</button>
                </div>
                <br><br>
                <canvas id="maketable"></canvas>
                <script src="./JS/tablebase.js"></script>
                <br><br>

                <?php
                    session_start();
                    include('config.php');


                ?>
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