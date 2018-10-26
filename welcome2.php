<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login2.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="navcontainer">
        <nav>

            <a class="site-logo" href="index.html"><span class="logo"></span>MarketPlace</span></a>
        </nav>
    </div>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <footer class="sub-footer">
            <a href="#">About</a>
            <a href="#">Our team</a>
            <a href="#">Work with us</a>
            <a href="#">Become a partner</a>
            <a href="#">F.A.Q.</a>
            <a href="#">Contact us</a>
        </footer>  
</body>
</html>