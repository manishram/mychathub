<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$user_id_2= htmlentities(stripslashes(trim($_POST['user_id'])));
$username=$_SESSION['username'];
if($user_id_2!='' && $username!=''){
$user_query = "SELECT * FROM users WHERE username='$username' ";
$user_data=mysqli_query($conn,$user_query);
$row_me = mysqli_fetch_array($user_data);

$user_query_2 = "SELECT * FROM users WHERE user_id='$user_id_2' ";
$user_data_2=mysqli_query($conn,$user_query_2);
$row_me_2 = mysqli_fetch_array($user_data_2);




$sql_delete_friend="DELETE FROM friends where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";

if(mysqli_query($conn,$sql_delete_friend)){
echo'1';}}else{echo '0';}
?>