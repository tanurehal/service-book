<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = mysqli_connect("localhost","root","","users2") or die("connection failed");
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql="SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        $sql = "INSERT INTO `users` ( `username`, `password`,`role`) VALUES ('$username', '$password','U')";
        $result = mysqli_query($conn, $sql);
        if($result){
        header("location:index.php");
        }else{
            echo '<div class="error">
                <p><b>ERROR!</b> Could not create a new user.</p>
                </div>';
        }
    }else{
        echo '<div class="error">
              <p><b>ERROR!</b> User already exists.</p>
              </div>';
    }
}
?>

<!-- signup page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body{
        background-image: url('bg2.jpg');
        background-repeat: no-repeat;
        background-size: 100vw 100vh;
    }
    </style>
</head>
<body>
    <!-- nav bar here -->
    <div id="nav">
        <!-- logo -->
        <a class="nav-brand" href="#">task52-SignUp</a>
        <!-- link to another page -->
        <a class="nav-link" href="index.php">Login</a>
    </div>

    <!-- sign up form -->
    <div id="formField">
        <form action="" method="post">
            <table>
                <tr><td>
                    <!-- username field -->
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required autocomplete="off">
                </td></tr>
                <tr><td>
                     <!-- password field -->
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </td></tr>   
                <!-- <tr><td>
                   role field
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                    </select>
                </td></tr>  -->
                <tr><td>
                    <!-- signup button  -->
                    <button type="submit">Sign Up</button>
                </td></tr>   
            </table>
        </form>
    </div>
</body>
</html>