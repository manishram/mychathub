<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('../conn.php');
$last_active=time();
$sql= "UPDATE users SET last_active='$last_active' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}
$sql= "UPDATE users SET online=1 where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}
?>