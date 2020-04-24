<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


if(!isset($_POST['room_id'])){header("Location: ../index.php");}
else{
include_once('conn.php');


$room_id = htmlentities(stripslashes(trim($_POST['room_id'])));
$room_check_sql="SELECT*FROM rooms WHERE room_id='$room_id'";
$room_check_query=mysqli_query($conn,$room_check_sql);
$count_room=mysqli_num_rows($room_check_query);

$row=mysqli_fetch_array($room_check_query);



if($count_room==1){
	if($row['room_type']=='1'){
		if(!isset($_POST['room_pass'])){header("Location: ../index.php");}
else{
		$room_pass = md5(htmlentities(stripslashes(trim($_POST['room_pass']))));
		if($row['room_pass']==$room_pass){
		$sql= "UPDATE users SET active_room='$room_id' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}			
		}else{
			echo"0";
		}
}
	}
else{
		$sql= "UPDATE users SET active_room='$room_id' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';
$time=time();
$sql2= "UPDATE users SET last_active='$time' where username='$_SESSION[username]'";
mysqli_query($conn,$sql2);

}else{echo'Not updated';}
}
	

}
else{header("Location: ../index.php");}

}

?>