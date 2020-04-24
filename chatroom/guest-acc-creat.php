<?php

if(!(isset($_POST['username'])) || $_POST['username']==''|| !(isset($_POST['tp'])) ){header("Location: singup.php");}
else{
include('conn.php');
$username = htmlentities(stripslashes(trim($_POST['username'])));
$tp = (htmlentities(stripslashes(trim($_POST['tp']))));

$username_check_query = "select*from users where username='$username' ";
$query_username=mysqli_query($conn,$username_check_query);
$count_username_row=mysqli_num_rows($query_username);


$time=time();


$is_username_valid=preg_match("/^[a-zA-Z0-9_ ]*$/", $username);
do{
$user_id = md5(time().mt_rand(10000,99999).mt_rand(10000,99999));
$user_id_check_query = "select*from users where user_id='$user_id'";
$query_user_id=mysqli_query($conn,$user_id_check_query);
$count_user_id_row=mysqli_num_rows($query_user_id);
}while($count_user_id_row!=0);



if($count_username_row==0 && $is_username_valid && $tp=='1')
{
$sql = "INSERT INTO users (user_id,username,last_active,account_created,user_rank) values('$user_id','$username','$time','$time',0)";	
if(mysqli_query($conn,$sql))
{

	session_start();
	$_SESSION['username']=$username;
	echo"1_ok";
	

}else{echo"database-error";}
}
else{header("Location: guest-login.php");
die();}

}
?>