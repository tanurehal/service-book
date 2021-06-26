<?php
$conn = mysqli_connect("localhost","root","","users2") or die("connection failed");

$sql = "SELECT * FROM `users` WHERE `is_active`= 'Y' ";
$result = mysqli_query($conn, $sql) or die("sql query failed to fetch table data"); 

$output="";
if(mysqli_num_rows($result) > 0){
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px" class="tbl">
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Delete</th>
                    </tr>';
    $sno=1;
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr>
        <td>".$sno."</td>
        <td>".$row["username"]."</td>
        <td><button class='dltbtn' data-id=".$row["id"].">Delete</button></td>
        </tr>";
        $sno=$sno+1;
    }
    $output .= "</table>";
    echo $output;
}else{
    echo "<h2>No record found</h2>";
}
?>