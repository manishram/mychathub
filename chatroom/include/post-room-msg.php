<?php
session_Start();
if(!isset($_SESSION['username'])){die();}


if(!isset($_GET['room-msg-input']) || $_GET['room-msg-input']=='' || strlen($_GET['room-msg-input'] )>400 ){}
else
{

include_once('conn.php');
$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

$user_id=$row['user_id'];
$active_room_id=$row['active_room'];

$room_msg = htmlentities(stripslashes(trim($_GET['room-msg-input'])));	
$msg_posted_time=time();


//need to work on file attachment//

$sql = "INSERT INTO room_chat (room_id,user_id,msg,msg_time) VALUES ('$active_room_id' , '$user_id', '$room_msg', '$msg_posted_time')";	
if(mysqli_query($conn,$sql))
{echo'1';}else{mysqli_error($conn);}
}

?>
