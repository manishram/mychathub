<?php
include"conn.php";
$username=$_POST['username'];
$sql = "select*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
echo $count;
?>