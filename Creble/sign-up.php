<?php
    session_start();
    include('config.php'); //connect mysqli

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); //if connection fail
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //get data from form
        $username = $_POST["username"];
        $password = $_POST["password"];
        $comfirm = $_POST["comfirm"];

        //$id = uniqid(); create uniq id based on current time in microseconds
        // $id = bin2hex(random_bytes(8));

        // prepare to insert query to database
        $nonadmin = "INSERT INTO user (user_name, user_password, user_value) VALUES ('$username', '$password', 'nonadmin')";
        $admin = "INSERT INTO user (user_name, user_password, user_value) VALUES ('$username', '$password', 'admin')";

        if ($comfirm == $password) {
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
                    $_SESSION["password"] = $password; //store password
                    $_SESSION['isadmin'] = false; // log in as normal user
                    $_SESSION["userid"] = (mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$username'")); // store userid from db

                    header("Location: account.php");
                } else {
                    $error = mysqli_error($conn); // warning message
                }
            }
        } else {
            $error = "Both password must be the same! <br>"; // incorrect warning message
        }
    }

    mysqli_close($conn); // close the db connection
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
            <div class="link"><a href="login.php" id="current">LOGIN</a></div>
            <div class="link"><a href="account.php">USER SETTINGS</a></div>
        </div>
    </div>
    <div id="main">
        <img src="./img/hero_bg1.png" alt="hero-bg-img" class="main-background">
        <div class="main-items">
            <div class="glasshold">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <center><h3>SIGN UP</h3></center>
                    <div class="inline">
                        <label for="username" id="name">NAME</label><br>
                        <label for="password" id="password">PASSWORD</label><br>
                        <label for="password">COMFIRM PASSWORD</label><br>
                    </div>
                    <div class="inline">
                        <input type="text" name="username" class="bfill" required><br>
                        <input type="password" name="password" class="bfill" required><br>
                        <input type="password" name="comfirm" class="bfill" required><br>
                    </div>
                    <br>
                    <p>      
                        <?php
                            if (isset($error)) {
                                echo $error; //tell error
                            }
                        ?>
                    </p>
                    <div class="inline">
                        <center><input type="submit" value="SIGN UP" class="bclick submit"></center>
                    </div>
                    <div class="inline">
                        <center><input type="reset" value="RESET" class="bclick reset"></center>
                    </div>
                    <br>
                    <div class="inline">
                        <center><label for="">ALREADY HAVE ACCOUNT?</label></center>
                    </div>
                    <div class="inline">
                        <center><input type="button" value="LOGIN" class="bclick" onclick="window.location.href='http://localhost/Palva/login.php'"></center>
                    </div>
                    <br>
                </form>
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