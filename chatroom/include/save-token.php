<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$username=$_SESSION['username'];
$token_id = htmlentities(stripslashes(trim($_POST['token_id'])));
$sql = "UPDATE users SET token_id='$token_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){echo"1";}else{"0";}


?>
	