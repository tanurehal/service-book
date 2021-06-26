<?php

$username = $_POST['user'];
$password = md5($_POST['pass']);

$conn = mysqli_connect("localhost","root","","users2") or die("connection failed");

$sql = " UPDATE `users` SET `password` = '$password' WHERE `username` = '$username'";

if(mysqli_query($conn, $sql)){echo 1;}
else{echo 0;}

?>