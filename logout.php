<?php
session_start();
session_unset();
session_destroy();
//header("location: index.php");
?>

<!-- result page of logging out -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogOut</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- nav bar here -->
    <div id="nav">
        <a class="nav-brand" href="#">task52-Logout</a>
        <a class="nav-link" href="signup.php">Sign Up</a>
        <a class="nav-link" href="index.php">Login</a>
    </div>
    <div id="logout">
        <h2>Success!</h2>
        <p>You have been logged out.</p>
    </div>
</body>
</html>