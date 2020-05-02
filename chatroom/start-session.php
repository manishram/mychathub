<?php
if(!(isset($_POST['username'])) || !(isset($_POST['password'])) || $_POST['username']=='' || $_POST['password']==''){header("Location: singup.php");}
else{
include('conn.php');


$username = htmlentities(stripslashes(trim($_POST['username'])));
$pass = md5(htmlentities(stripslashes(trim($_POST['password']))));



$sql = "SELECT*FROM users WHERE (username='$username' AND password='$pass' AND user_rank>0)";

$signin_query = mysqli_query($conn,$sql);

$count_row=mysqli_num_rows($signin_query);
echo $count_row;

if($count_row==1)
{
$user_row=mysqli_fetch_array($signin_query);	
	
if(isset($_POST['keepsigned']) && $keepsigned=='1')
{
	$keepsigned=md5(htmlentities(stripslashes(trim($_POST['keepsigned']))));
	//To delte previous sessions if any....(don't delete this block of code)
	if(isset( $_SESSION['username'])){session_destroy();}	
	if(isset($_COOKIE['cookie_username'])){setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/"); unset($_COOKIE['cookie_username']);}
	
	session_start();
	
	setcookie('cookie_username', $username, time() + (86400 * 7), "/");
    $_SESSION['username']=$user_row['username'];	
	
}

else
{ 	
//To delte previous sessions if any....(don't delete this block of code)
if(isset( $_SESSION['username'])){session_destroy();}	
	if(isset($_COOKIE['cookie_username'])){setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/"); unset($_COOKIE['cookie_username']);}
	
session_start();
$_SESSION['username']= $user_row['username'];	
	
}
$last_active=time();
$sql= "UPDATE users SET last_active='$last_active' where username='$username'";
if(mysqli_query($conn,$sql)){
	$sql= "UPDATE users SET online=1 where username='$username'";
	mysqli_query($conn,$sql);
	
}	
}

else{echo"0";}	



}
?>