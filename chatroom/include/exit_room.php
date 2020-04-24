<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$sql= "UPDATE users SET active_room='' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}
?>