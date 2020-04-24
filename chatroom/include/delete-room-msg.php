<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}
include('../conn.php');

$msg_id=htmlentities(stripslashes(trim($_POST['msg_id'])));
if($msg_id!=''){
$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$user = mysqli_fetch_array($y);


$sql="DELETE FROM room_chat WHERE id='$msg_id' AND user_id='$user[user_id]' AND room_id='$user[active_room]'";

if(mysqli_query($conn,$sql))
{echo'1';}else{mysqli_error($conn);}
}
?>