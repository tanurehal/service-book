<?php
session_start();
if($_SESSION['role'] != 'user'){
    header("location: index.php");
    exit("Session not logged in as a user.");
}
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit("Session not logged in.");
}
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $conn = mysqli_connect("localhost","root","","users2") or die("connection failed");
//     $password = $_POST['new-pw'];
//     $username = $_SESSION['username'];
//     $sql = " UPDATE `users` SET `password` = '$password' WHERE `username` = '$username'";
//     $result = mysqli_query($conn, $sql);
//     if($result){
//         echo "successfully changed the password";
//     }else{
//         echo "could not change the password";
//     }
// }
?>

<!-- user page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- nav bar -->
    <div id="nav">
        <a class="nav-brand" href="#">task52-User</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Contact</a>
        <a class="nav-link" href="logout.php">Logout</a>
    </div>
    <!-- do you want to change password -->
    <div class="userque">
        <h2>Hi, <?php echo $_SESSION['username'] ?> </h2>
        <div id="changepassword">
        <p id="question">Do you want to change your password?</p>
        <button type="button" id="pwbtn">Change Password</button>
        </div>
        <!-- change password karne ka hidden div -->
        <div id="modal">
            <form action="user.php" method="POST">
                <input type="password" name="new-pw" id="new-pw" required>
                <button type="button" id="editbtn">Edit</button>
            </form>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#modal").hide();
    $("#pwbtn").click(function(){
        $('#modal').show();
        $("#pwbtn").hide();
    });
    // $("#editbtn").click(function(){
    //     $("#modal").hide();
    // });

    // change the password 
    $("#editbtn").click(function(){
        var user_name = "<?php echo $_SESSION['username']?>";
        var newpw = $("#new-pw").val();
        if(newpw == ""){
            alert("password can not be blank");
        }else{
        //alert(newpw);
        $.ajax({
            url : "ajax-change-pw.php",
            type : "POST",
            data : {user : user_name , pass : newpw},
            success : function(data){
                // alert(data);
                if(data == 1){
                    $('#modal').hide();
                    alert("password changed successfully");
                }else{
                    alert('Could not update the password');
                }
            }
        });
        $("#pwbtn").show();
        }
    });
});
</script>

</body>
</html>
