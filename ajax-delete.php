<?php

$user_id = $_POST['id'];
$conn = mysqli_connect("localhost","root","","users2") or die("connection failed");

//query to turn y to n in is_active
$sql = "UPDATE `users` SET `is_active` = 'N' WHERE `id` = '$user_id'";

if(mysqli_query($conn, $sql)){echo $user_id;}
else{echo 0;}

?>