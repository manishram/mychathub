<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');

$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

$user_id=$row['user_id'];
$active_room_id=$row['active_room'];

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'mp3','mp4'); // valid extensions
$path = '../upload/room_chat_uploads/'; // upload directory
$thumbnail_path = '../upload/room_chat_uploads/thumbnails/';
if(!empty($_FILES['image_file']) && ($_FILES['image_file']['size']<4194280))
{$image_text='';
	if(isset($_POST['image_text'])){$image_text= htmlentities(stripslashes($_POST['image_text']));}
$img = $_FILES['image_file']['name'];
$tmp = $_FILES['image_file']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$time=time();
$rand=rand(1000,1000000);
$final_image = $rand.$row['user_id'].$time.'.'.$ext;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
    $x='';
	$thumbnail_file_path_name=$thumbnail_path.'thumb_x_sm_'.$final_image;
	
	if($ext=='jpg'||$ext=='jpeg'||$ext=='png'){
		include_once('thumbnailer_jpg_png.php');
		$x='thumbnails/thumb_x_sm_';
	}
	if($ext=='gif'){include_once('thumbnailer_gif.php');
	    $x='thumbnails/thumb_x_sm_';
	}
	

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
{$link = "https";}
else{$link = "http";} 
$link .= "://";  
$link .= $_SERVER['HTTP_HOST'];  

$room_msg="$link/chatroom/upload/room_chat_uploads/$x$final_image $image_text";	
$sql = "INSERT INTO room_chat (room_id,user_id,msg,msg_time) VALUES ('$active_room_id' , '$user_id', '$room_msg', '$time')";	
if(mysqli_query($conn,$sql))
{echo'1';}else{mysqli_error($conn);}
}
} 
else 
{
echo 'invalid';
}
}
?>