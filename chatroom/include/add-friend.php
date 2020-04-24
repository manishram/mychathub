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


$sql="SELECT*FROM friends where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

$sql_block="SELECT*FROM block_list where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";
$query_block=mysqli_query($conn,$sql_block);
$count_block=mysqli_num_rows($query_block);

//add code to not allow sent friend request for blocked members
if($count==0 && $count_block==0 && $row_me['user_id']!=$user_id_2 && $row_me_2['user_rank']!=0 && $row_me['user_rank']!=0)
{
	$sql="INSERT INTO friends (user_id_1,user_id_2)VALUES('$row_me[user_id]','$user_id_2') ";
if(mysqli_query($conn,$sql)){echo'1';}else{echo '0';}
}
else{echo '0';}
}
?>