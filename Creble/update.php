<?php
    session_start();
    include('config.php');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //get data from form
        $username = $_POST["username"];
        $password = $_POST["new_password"];

        $name = $_SESSION["username"];
        $id = $_SESSION["userid"];

        $oldpassword = $_SESSION["password"];;

        //$id = uniqid(); create uniq id based on current time in microseconds
        // $id = bin2hex(random_bytes(8));

        // prepare to insert query to database
        $admin = "UPDATE user SET user_name='$username', user_password='$password', user_value='admin' WHERE user_id = $id";
        $nonadmin = "UPDATE user SET user_name='$username', user_password='$password', user_value='nonadmin' WHERE user_id = $id";

        if ($oldpassword == $oldpassword) {
            if ($password == $adminpass) {
                if (mysqli_query($conn, $admin)) {
                    // new admin user successfully sign up
                    $_SESSION['loggedin'] = true; // is logged in
                    $_SESSION["username"] = $username; //store username
                    $_SESSION["password"] = $password; //store password
                    $_SESSION['isadmin'] = true; // log in as admin
                    $_SESSION["userid"] = (mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$username'"));
                    
                    header("Location: account.php");
                } else {
                    $error = mysqli_error($conn); // warning message
                }
            } else {
                if (mysqli_query($conn, $nonadmin)) {
                    // new normal user successfully sign up
                    $_SESSION['loggedin'] = true; // is logged in
                    $_SESSION["username"] = $username; //store username
                    $_SESSION['isadmin'] = false; // log in as normal user
                    $_SESSION["userid"] = (mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$username'")); // store userid from db

                    header("Location: account.php");
                } else {
                    $error = mysqli_error($conn); // warning message
                }
            }
        } else {
            $error = "Incorrect current password! <br>"; // incorrect warning message
        }
    }

    mysqli_close($conn); // close the db connection

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
                <form action="" method="post">
                    <center>
                        <div class="textbox">
                            <p>
                                <?php
                            echo $usertype;
                            ?>
                        </p>
                    </div>
                    </center>
                    <div class="inline">
                        <label for="username" id="name">NAME</label><br>
                        <label for="password" id="password">CURRENT PASSWORD</label><br>
                        <label for="password">NEW PASSWORD</label><br>
                    </div>
                    <div class="inline">
                        <input type="text" name="username" class="bfill" value="<?php echo $username; ?>" required><br>
                        <input type="password" name="old_password" class="bfill" required><br>
                        <input type="password" name="new_password" class="bfill" required><br>
                    </div>
                    <br>
                    <center>
                    <p>      
                        <?php
                            if (isset($error)) {
                                echo $error; //tell error
                            }
                        ?>
                    </p>
                        <input type="submit" value="SIGN UP" class="bclick submit">
                    </center>
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