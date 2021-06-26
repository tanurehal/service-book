<?php
$encryption = "";
// INDEX2

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

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $uname = $_POST["username"];
    $options = 0; 
    $ciphering = "aes-128-cbc";
    $encryption_iv = '1234567891011121'; 
    $encryption_key = "GeeksforGeeks"; 
    $encryption = openssl_encrypt($uname, $ciphering, $encryption_key, $options, $encryption_iv); 
}
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
                    <button type="submit" id="loginbtn">Login</button>
                </td></tr>   
            </table>
        </form>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e){
$("#loginbtn").on("click", function(){
    var u = "<?php echo $encryption; ?>";
    var p = $("#password").val();
    var r = $("#role").val();
    alert(u);
    //$("#loginbtn").preventDefault();
    $.ajax({
        url : "ajax-login.php",
        type : "POST",
        data : {username: u, password: p, role: r},
        success : function(data){
            if(data == 1){
                document.location.href ="user.php";
            }
            if(data == 0){
               document.location.href ="admin.php";
            }
            else{
                $("#error").html(data);
            }
        }
    });
 });
})
</script>
</body>
</html>