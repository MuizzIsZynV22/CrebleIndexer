<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('config.php'); //connect mysql
        
        // Call the form
        $username = $_POST["username"]; //get username from input
        $password = $_POST["password"]; //get password from input

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error()); //if connection fail
        }

        $select = "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$password'";
        $result = mysqli_query($conn,$select);

        //check if query is success
        if (mysqli_num_rows($result) == 1) {
            if ($password == $adminpass) {
                $_SESSION['loggedin'] = true; // is logged in
                $_SESSION["username"] = $username; //store username
                $_SESSION["password"] = $password; //store password
                $_SESSION['isadmin'] = true; // log in as admin
                $_SESSION["userid"] = (mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$username'"));
            
                header("Location: account.php");
            } else {
                $_SESSION['loggedin'] = true; // is logged in
                $_SESSION["username"] = $username; //store username
                $_SESSION["password"] = $password; //store password
                $_SESSION['isadmin'] = false;
                $_SESSION["userid"] = (mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$username'"));
            
                header("Location: account.php");
            }
        } else {
            $error = "Invalid username or password <br>"; // incorrect warning message
        }
        mysqli_close($conn); //close db connection
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
            <div class="link"><a href="login.php" id="current">LOGIN</a></div>
            <div class="link"><a href="account.php">USER SETTINGS</a></div>
        </div>
    </div>
    <div id="main">
        <img src="./img/hero_bg1.png" alt="hero-bg-img" class="main-background">
        <div class="main-items">
            <div class="glasshold">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <center><h3>LOGIN</h3></center>
                    <div class="inline">
                        <label for="username">NAME</label><br>
                        <label for="password">PASSWORD</label><br>
                    </div>
                    <div class="inline">
                        <input type="text" class="bfill" name="username" required><br>
                        <input type="password" class="bfill" name="password" required><br>
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
                        <center><input type="submit" value="LOGIN" class="bclick submit"></center>
                    </div>
                    <div class="inline">
                        <center><input type="reset" value="RESET" class="bclick reset"></center>
                    </div>
                    <br>
                    <div class="inline">
                        <center><label for="">DON'T HAVE ACCOUNT?</label></center>
                    </div>
                    <div class="inline">
                        <center><input type="button" value="SIGN UP" class="bclick" onclick="window.location.href='http://localhost/Palva/sign-up.php'"></center>
                    </div>
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