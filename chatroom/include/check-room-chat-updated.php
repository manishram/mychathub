<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include('../conn.php');

$last_msg_id= $_SESSION['last_msg_id'];
$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);

$sql="SELECT*FROM room_chat WHERE room_id='$z[active_room]' AND id>$last_msg_id ";
$sql_query=mysqli_query($conn,$sql);
$count= mysqli_num_rows($sql_query);

echo $count;



?>