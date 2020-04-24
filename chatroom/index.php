<?php
session_start();
if(isset($_SESSION['username'])){header("Location: rooms.php");}
else
{
	if(isset($_COOKIE['cookie_username'])){$_SESSION['username']=$_COOKIE['cookie_username'];header("Location: rooms.php");}
	else{header("Location: signin.php");}
}

?>