<?php

if(!(isset($_POST['username'])) || !(isset($_POST['email'])) || !(isset($_POST['password'])) || !(isset($_POST['tp'])) || $_POST['username']=='' || $_POST['email']=='' || $_POST['password']==''){header("Location: signup.php");}
else{
include('conn.php');
$username = htmlentities(stripslashes(trim($_POST['username'])));
$email = htmlentities(stripslashes(trim($_POST['email'])));
$pass = md5(htmlentities(stripslashes(trim($_POST['password']))));
$tp = (htmlentities(stripslashes(trim($_POST['tp']))));

$username_check_query = "select*from users where username='$username' ";
$query_username=mysqli_query($conn,$username_check_query);
$count_username_row=mysqli_num_rows($query_username);

$username_length=strlen($username);
$pass_length=strlen($pass);
$email_length=strlen($email);


$account_created=time();
$email_check_query = "select*from users where email='$email' ";
$query_email=mysqli_query($conn,$email_check_query);
$count_email_row=mysqli_num_rows($query_email);
$is_username_valid=preg_match("/^[a-zA-Z0-9_ ]*$/", $username);
$is_email_valid=preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/",$email);




do{
$user_id = md5(time().mt_rand(10000,99999).mt_rand(10000,99999));
$user_id_check_query = "select*from users where user_id='$user_id'";
$query_user_id=mysqli_query($conn,$user_id_check_query);
$count_user_id_row=mysqli_num_rows($query_user_id);
}while($count_user_id_row!=0);


if($count_username_row==0 && $count_email_row==0 && $is_username_valid && $username_length<=60 && $is_email_valid && $email_length<=60 && $pass_length>=8 &&  $pass_length<=120 && $tp=='1')
{
$sql = "INSERT INTO users (user_id,username,email,password,account_created) values('$user_id','$username','$email','$pass','$account_created')";	
if(mysqli_query($conn,$sql))
{
$sql = "SELECT*FROM users WHERE (username='$username' AND password='$pass')";
$signin_query = mysqli_query($conn,$sql);
$user_row=mysqli_fetch_array($signin_query);	
   
    $original_url='https://'.$_SERVER['HTTP_HOST']; //try with all urls above

    $pieces = parse_url($original_url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
	$host = $regs['domain'];}
	if(isset($host)){}else{$host='localhost';}
	
	
	//To delte previous sessions if any....(don't delete this block of code)
	if(isset( $_SESSION['username'])){unset($_SESSION['username']);session_destroy();}	
	
	if(isset($_COOKIE['cookie_username'])){setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/",$host); 
	unset($_COOKIE['cookie_username']);}
	if(isset($_COOKIE['cookie_session_id'])){setcookie('cookie_session_id', $_COOKIE['cookie_session_id'], time() - (86400 * 7), "/",$host);
	unset($_COOKIE['cookie_session_id']);}
	
	session_start();
	$session_id = session_id();
	setcookie('cookie_username', $user_row['username'], time() + (86400 * 7), "/",$host);
	setcookie('cookie_session_id', session_id(), time() + (86400 * 7), "/",$host);
    $_SESSION['username']=$user_row['username'];
	
	
	

$sql = "UPDATE users SET session_id='$session_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){}else{echo mysqli_error($conn);}


	echo"1";
	

}else{echo"database-error";}
}
else{header("Location: signup.php");
die();}

}

?>