<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include('../conn.php');


$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);
$my_user_id=$z['user_id'];
$receiver_user_id= htmlentities(stripslashes(trim($_GET['receiver_user_id'])));
$sql="UPDATE personal_chats SET seen=1 WHERE (sender_user_id='$receiver_user_id' AND receiver_user_id='$my_user_id' AND seen=0)";
if(mysqli_query($conn,$sql)){}

$sql="UPDATE personal_chats SET sender_seen=1 WHERE (sender_user_id='$my_user_id' AND receiver_user_id='$receiver_user_id' AND sender_seen=0)";
if(mysqli_query($conn,$sql)){}
?>
