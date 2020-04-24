<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

		  include('conn.php');
		  $username=$_SESSION['username'];
		
		  $receiver_user_id=htmlentities(stripslashes(trim($_POST['receiver_user_id'])));
$user_query = "SELECT * FROM users WHERE user_id='$receiver_user_id' ";
$user_data=mysqli_query($conn,$user_query);
$row_receiver = mysqli_fetch_array($user_data);
$time_check=time()-60;
$receiver_username=$row_receiver['username'];
echo $receiver_username;


?>