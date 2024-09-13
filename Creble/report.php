<?php
    session_start();
    // check log in
    if (!isset($_SESSION['loggedin'])) {
        // will redirect user to login page to login
        header('Location: http://localhost/Palva/login.php');
        exit;
    }

    include('config.php'); //connect mysqli

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); //if connection fail
    }

    // check form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get username from session
        $username = $_SESSION["username"];

        // get data from form
        $title = $_POST["title"];
        $report = $_POST["report"];

        // create random id
        $id = bin2hex(random_bytes(8));

        // prepare to insert query to database
        $insert = "INSERT INTO report (report_id, user_name, title, report) VALUES ('$id', '$username', '$title', '$report')";

        if (mysqli_query($conn, $insert)) {
            // report successfully submited
            header("Location: account.php");
        } else {
            $error = mysqli_error($conn); // warning message
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
</hehome
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <center><h3>SUGGEST YOUR IDEA OR REPORT A PROBLEM</h3></center>
                    <div class="inline">
                        <label for="title">Title:</label>
                    </div>
                    <div class="inline">
                        <input type="text" name="title">
                    </div>
                        <br>
                    <div class="inline">
                        <label for="report">Report:</label>
                    </div>
                    <div class="inline">
                        <textarea name="report" id="" cols="25" rows="10"></textarea>
                    </div>
                    <br>
                    <div class="inline">
                        <center><input type="submit" value="SUBMIT" class="bclick submit"></center>
                    </div>
                    <div class="inline">
                        <center><input type="reset" value="RESET" class="bclick reset"></center>
                    </div><br>
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