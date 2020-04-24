<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include"conn.php";
$room_name=htmlentities(stripslashes(trim($_POST['room_name'])));
$sql = "select*from rooms where room_name='$room_name' ";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
echo $count;
?>