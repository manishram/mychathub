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


$sql="SELECT*FROM block_list where user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if($count==0 && ($row_me['user_id']!=$user_id_2))
{
	$sql="INSERT INTO block_list (user_id_1,user_id_2)VALUES('$row_me[user_id]','$user_id_2') ";
if(mysqli_query($conn,$sql)){
	$sql="SELECT*FROM block_list where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";
$query=mysqli_query($conn,$sql);
$sql_delete_friend="DELETE FROM friends where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";

if(mysqli_query($conn,$sql_delete_friend)){
echo'1';}}else{echo '0';}

}
else{echo '0';}
}
?>