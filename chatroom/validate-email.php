<?php
include"conn.php";
$email=$_POST['email'];
$sql = "select*from users where email='$email' ";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
echo $count;
if(filter_var($email, FILTER_VALIDATE_EMAIL) && $count==0){echo'0';}else{echo'1';}
?>