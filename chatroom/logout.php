<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
include_once('include/conn.php');

$sql= "UPDATE users SET online=0 WHERE username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){}

if(isset( $_SESSION['username'])){
	unset($_SESSION['username']);
	session_destroy();
	}	
	
	if(isset($_COOKIE['cookie_username']))
	{
		setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/"); unset($_COOKIE['cookie_username']);
		setcookie('cookie_session_id', $_COOKIE['cookie_session_id'], time() - (86400 * 7), "/"); unset($_COOKIE['cookie_session_id']);
	}
    
	header("Location: signin.php");	

?>