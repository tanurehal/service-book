<?php

// INDEX

session_start();
if(isset($_SESSION['role']) && $_SESSION["role"] == 'admin'){
    header("location: admin.php");
}
elseif(isset($_SESSION['role']) && $_SESSION["role"] == 'user'){
    header("location: user.php");
}
else{
    session_unset();
    session_destroy();
}
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $error = false;
//     $conn = mysqli_connect("localhost","root","","users2") or die("connection failed");
//     $username = $_POST["username"];
//     $password = md5($_POST["password"]); 
//     $role = $_POST["role"];

//     if($role == 'user'){
//         $sql = "SELECT * FROM `users` WHERE `username` ='$username' AND `password`='$password' AND `role` = 'U' AND `is_active`='Y'";
//         $result = mysqli_query($conn, $sql);
//         $num = mysqli_num_rows($result);
//         if ($num == 1){
//             session_start();
//             $_SESSION['loggedin'] = true;
//             $_SESSION['username'] = $username;
//             $_SESSION['role'] = $role;
//             header("location: user.php");
//         }else{
//             $error = "Invalid credentials";
//         }
//     }else{
//         $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password' AND `role` = 'A' AND `is_active`='Y'";
//         $result = mysqli_query($conn, $sql);
//         $num = mysqli_num_rows($result);
//         if ($num == 1){
//             session_start();
//             $_SESSION['loggedin'] = true;
//             $_SESSION['username'] = $username;
//             $_SESSION['role'] = $role;
//             header("location: admin.php");
//         } 
//         else{
//             $error = "Invalid credentials";
//         }
//     }

//     if($error){
//         echo "<div class='error'>
//         <p><b>Error! </b>Invalid credentials.</p>
//         </div>";
//     }
// }
?>

<!-- login page will come here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body{
        background-image:  url('bg2.jpg');
        background-repeat: no-repeat;
        background-size: 100vw 100vh;
    }
    </style>
</head>
<body>
    <!-- nav bar here -->
    <div id="nav">
        <a class="nav-brand" href="#">task52-Login</a>
        <a class="nav-link" href="signup.php">Sign Up</a>
    </div>

    <!-- error div -->
    <div id="error"></div>
    
     <!-- login form -->
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
                <tr><td>
                    <!-- role field -->
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                    </select>
                </td></tr> 
                <tr><td>
                    <!-- signup button  -->
                    <button type="button" id="loginbtn">Login</button>
                </td></tr>   
            </table>
        </form>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$("#loginbtn").on("click", function(){
    var u = $("#username").val();
    var p = $("#password").val();
    var r = $("#role").val();

    $.ajax({
        url : "ajax-login.php",
        type : "POST",
        data : {username: u, password: p, role: r},
        success : function(data){
           // alert(data);
            if(data == 1){
                document.location.href ="user.php";
            }
            if(data == 0){
               //$(window).attr('location','user.php');
               document.location.href ="admin.php";
            }
            else{
                //alert("invalid credentials");
                $("#error").html(data);
            }
        }
    });
 });
})
</script>
</body>
</html>