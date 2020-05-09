<?php


if(!(isset($_POST['username'])) || !(isset($_POST['password'])) || $_POST['username']=='' || $_POST['password']==''){header("Location: singup.php");}
else{
include('conn.php');

   

$username = htmlentities(stripslashes(trim($_POST['username'])));
$pass = md5(htmlentities(stripslashes(trim($_POST['password']))));
if(isset($_POST['keepsigned'])){
	$keepsigned=htmlentities(stripslashes(trim($_POST['keepsigned'])));
}

$sql = "SELECT*FROM users WHERE (username='$username' AND password='$pass' AND user_rank>0)";

$signin_query = mysqli_query($conn,$sql);

$count_row=mysqli_num_rows($signin_query);
echo $count_row;

if($count_row==1)
{
$original_url='https://'.$_SERVER['HTTP_HOST']; //try with all urls above

    $pieces = parse_url($original_url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
	$host = $regs['domain'];}
	if(isset($host)){}else{$host='localhost';}
	

$user_row=mysqli_fetch_array($signin_query);	
	
if(isset($_POST['keepsigned']) && $keepsigned=='1')
{
	

	//To delte previous sessions if any....(don't delete this block of code)
	if(isset( $_SESSION['username'])){unset($_SESSION['username']);session_destroy();}	
	if(isset($_COOKIE['cookie_username'])){setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/",$host); unset($_COOKIE['cookie_username']);}
	if(isset($_COOKIE['cookie_session_id'])){setcookie('cookie_session_id', $_COOKIE['cookie_session_id'], time() - (86400 * 7), "/",$host); unset($_COOKIE['cookie_session_id']);}
	
	session_start();
	
	setcookie('cookie_username', $user_row['username'], time() + (86400 * 7), "/",$host);
	setcookie('cookie_session_id', session_id(), time() + (86400 * 7), "/",$host);
    $_SESSION['username']=$user_row['username'];	
	
}

else
{ 	
//To delte previous sessions if any....(don't delete this block of code)
if(isset( $_SESSION['username'])){unset($_SESSION['username']);session_destroy();}	
	if(isset($_COOKIE['cookie_username'])){setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/",$host); unset($_COOKIE['cookie_username']);}
	if(isset($_COOKIE['cookie_session_id'])){setcookie('cookie_session_id', $_COOKIE['cookie_session_id'], time() - (86400 * 7), "/",$host); unset($_COOKIE['cookie_session_id']);}
	
session_start();
$_SESSION['username']= $user_row['username'];	
	
}
$last_active=time();
$sql= "UPDATE users SET last_active='$last_active' where username='$username'";
if(mysqli_query($conn,$sql)){
	$sql= "UPDATE users SET online=1 where username='$username'";
	mysqli_query($conn,$sql);
	
}

$session_id = session_id();

$sql = "UPDATE users SET session_id='$session_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){}else{echo mysqli_error($conn);}
}

else{echo"0";}	



}
?>