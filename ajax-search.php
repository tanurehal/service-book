<?php
$search_value = $_POST["search"];
$conn = mysqli_connect("localhost","root","","users2") or die("connection failed");

$sql1 = " SELECT * FROM users WHERE username LIKE '%$search_value%'";
$result1 = mysqli_query($conn, $sql1) or die("sql query failed"); 

$output="";
if(mysqli_num_rows($result1) > 0 ){
    $output = "<table border='1' width='100%' cellspacing='0' cellpadding='10px' class='tbl'>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Delete</th>
                    </tr>";
                $sno=1;
                while($row = mysqli_fetch_assoc($result1)){
                    $output .= "<tr>
                    <td>".$sno."</td>
                    <td>".$row["username"]."</td>
                    <td><button class='dltbtn' data-id=".$row["id"].">Delete</button></td>
                    </tr>";
                    $sno=$sno+1;
                   }        
    $output .= "</table>";
    //mysqli_close($conn);
    echo $output;
}else{
    echo "<h2>No record found</h2>";
}
?>