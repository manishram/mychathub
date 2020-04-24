<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include('../conn.php');

$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);
$my_user_id=$z['user_id'];
$receiver_user_id= htmlentities(stripslashes(trim($_GET['receiver_user_id'])));
$sql="SELECT*FROM personal_chats WHERE (sender_user_id='$my_user_id' AND receiver_user_id='$receiver_user_id' AND sender_seen=0) OR (sender_user_id='$receiver_user_id' AND receiver_user_id='$my_user_id' AND seen=0)";
$sql_query=mysqli_query($conn,$sql);
$count= mysqli_num_rows($sql_query);

echo $count;


?>