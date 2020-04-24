<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


include"conn.php";
$room_id=htmlentities(stripslashes(trim($_POST['room_id'])));
$sql = "select*from rooms where (room_id='$room_id' AND room_type='1')";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if($count==1){echo'1';}else{echo'0';}

?>