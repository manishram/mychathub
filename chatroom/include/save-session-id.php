<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$username=$_SESSION['username'];
$session_id = session_id();
$sql = "UPDATE users SET session_id='$session_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){echo"1";}else{"0";}


?>
	