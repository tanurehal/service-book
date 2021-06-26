<?php
session_start();
if($_SESSION['role'] != 'admin'){
    header("location: index.php");
    exit("Session not logged in as a admin.");
}
//go back to login page if not logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit("Session not logged in.");
}
?>

<!-- admin page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- nav bar here -->
    <div id="nav">
        <a class="nav-brand" href="#">task52-Admin</a>
        <a class="nav-link" href="logout.php">Logout</a>
        <div id="search-bar">
            <label>Search</label>
            <input type="text" id="search" placeholder="Search">
        </div>
    </div>
<h1>Hi, <?php echo $_SESSION['username']; ?></h1>
<div class="container">
    <div class="sidebar">
        <h3>MENU</h3>

        <a class="menu-item" href="">menu item 1</a>
        <hr>
        <a class="menu-item" href="">menu item 2</a>
        <hr>
        <a class="menu-item" href="">menu item 2</a>
        <hr>
    </div>
    <!-- div for the table loading through ajax-->
    <div id="main-table"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    function loadData(){
        $.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
                $("#main-table").html(data);
            }
        });
    }
    loadData();

    // delete functionality for admin
    $(document).on("click", ".dltbtn", function(){
        var user_id = $(this).data("id");
        //alert(user_id); ok
        $.ajax({
            url : "ajax-delete.php",
            type : "POST",
            data : {id : user_id},
            success : function(data){
                if(data == 0){
                    alert('User was not deleted successfully.');
                }else{
                   loadData();
                   // console.log($(this).closest('.parent'));
                   //$(this).parent().parent().hide();
                  // $("#dltbtn").closest('.parent').closest('.parent').hide();
                  //$("#dltbtn").parent().hide();
               }
            }
        });
    });

    // search functionality for the admin
    $('#search').on("keyup", function(){
        var search_term = $(this).val();
        //alert(search_term); working
        $.ajax({
            url : "ajax-search.php",
            type : "POST",
            data : {search: search_term},
            success : function(data){
                $("#main-table").html(data);
            }
        });
    });
});

</script>

</body>
</html>
