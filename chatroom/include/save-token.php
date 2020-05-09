<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$username=$_SESSION['username'];
$token_id = htmlentities(stripslashes(trim($_POST['token_id'])));
$sql = "UPDATE users SET token_id='$token_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){echo"1";}else{"0";}

$sql = "SELECT*FROM users WHERE (username='$username' AND user_rank!='0')";
$signin_query = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($signin_query);

$token_id=$row['token_id'];

$sql= "UPDATE users SET token_id='' where (username!='$username' AND token_id='$token_id')";
mysqli_query($conn,$sql);

?>
