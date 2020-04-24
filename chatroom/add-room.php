<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


if(!(isset($_POST['room_name'])) || !(isset($_POST['room_desc'])) || !(isset($_POST['room_msg'])) || !(isset($_POST['room_type'])) || !(isset($_POST['who_can'])) || !(isset($_POST['room_cat'])) || $_POST['room_name']=='' || $_POST['room_desc']=='' || $_POST['room_msg']=='' || $_POST['room_type']=='' || $_POST['who_can']=='' || $_POST['room_cat']==''){header("Location: index.php");}

else{
	
include('conn.php');
$room_name = htmlentities(stripslashes(trim($_POST['room_name'])));
$room_desc = htmlentities(stripslashes(trim($_POST['room_desc'])));
$room_msg = htmlentities(stripslashes(trim($_POST['room_msg'])));
$room_type = htmlentities(stripslashes(trim($_POST['room_type'])));
$who_can = htmlentities(stripslashes(trim($_POST['who_can'])));
$room_cat = htmlentities(stripslashes(trim($_POST['room_cat'])));
if(isset($_POST['room_pass'])){$room_pass=md5(htmlentities(stripslashes(trim($_POST['room_pass']))));;}else{$room_pass='';}

do{
$room_id = md5(time().mt_rand(10000,99999).mt_rand(10000,99999));
$room_id_check_query = "select*from rooms where room_id='$room_id'";
$query_room_id=mysqli_query($conn,$room_id_check_query);
$count_room_id_row=mysqli_num_rows($query_room_id);
}while($count_room_id_row!=0);


$room_check_query = "select*from rooms where room_name='$room_name' ";
$query_room=mysqli_query($conn,$room_check_query);
$count_room_row=mysqli_num_rows($query_room);

$room_name_length=strlen($room_name);
$room_desc_length=strlen($room_desc);
$room_msg_length=strlen($room_msg);



$room_created=time();

$username=$_SESSION['username'];


$vip_check_query = "select*from users where (username='$username' AND vip_status='1') ";
$query_vip=mysqli_query($conn,$vip_check_query);
$count_vip_row=mysqli_num_rows($query_vip);
$row = mysqli_fetch_array($query_vip);

if($count_vip_row==1){$vip_status_check='1';}else{$vip_status_check='0';}
$user_id=$row['user_id'];

$is_room_name_valid=preg_match("/^[a-zA-Z0-9_ ]*$/", $room_name);



if(($count_room_row==0 && $is_room_name_valid && $room_name_length<=20 && $room_desc_length<=80 && $room_msg_length<=300 && $room_type!='' && $who_can!='' && $room_cat!='') && (($room_type=='1' && $room_pass!='' &&  strlen($room_pass)>=4)|| ($room_type=='0')) && $vip_status_check=='1')
{
$sql = "INSERT INTO rooms (room_id,room_name,room_desc,room_type,room_created,creator_user_id,wlcm_msg,who_can_enter,category,room_pass) values('$room_id','$room_name','$room_desc','$room_type','$room_created','$user_id','$room_msg','$who_can','$room_cat','$room_pass')";	
if(mysqli_query($conn,$sql))
{
	echo"1";
	
}
else
{echo"database-error";}

}

else{header("Location: index.php");}

}
?>