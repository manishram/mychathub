<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$user_id=$row['user_id'];
$receiver_user_id = htmlentities(stripslashes(trim($_POST['receiver_user_id'])));	
//////////////////////////////////






$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'mp3','mp4'); // valid extensions
$path = '../upload/pm_chat_uploads/'; // upload directory
$thumbnail_path = '../upload/pm_chat_uploads/thumbnails/';
if(!empty($_FILES['pm_attachment']) && ($_FILES['pm_attachment']['size']<4194280))
{$image_text='';
	if(isset($_POST['image_text'])){$image_text= htmlentities(stripslashes($_POST['image_text']));}
$img = $_FILES['pm_attachment']['name'];
$tmp = $_FILES['pm_attachment']['tmp_name'];
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
$sent_time=time();
$msg="$link/chatroom/upload/pm_chat_uploads/$x$final_image $image_text";	

$sql = "INSERT INTO personal_chats (sender_user_id,receiver_user_id,msg,sent_time) VALUES ('$user_id' , '$receiver_user_id', '$msg', '$sent_time')";	
if(mysqli_query($conn,$sql))
{echo'1';}else{mysqli_error($conn);}
}
}
else 
{
echo 'invalid';
}

}
/////////////////////////////////
else{

$msg = htmlentities(stripslashes(trim($_POST['pm_text'])));	

if(!isset($_POST['pm_text']) || !isset($_POST['receiver_user_id']) || $_POST['pm_text']=='' || $_POST['receiver_user_id']=='' ||  $user_id==$receiver_user_id || strlen($msg)>400){}
else
{

$sent_time=time();


//need to work on file attachment//

$sql = "INSERT INTO personal_chats (sender_user_id,receiver_user_id,msg,sent_time) VALUES ('$user_id' , '$receiver_user_id', '$msg', '$sent_time')";	

if(mysqli_query($conn,$sql))
{
	
	$sql = "SELECT*from users where user_id='$receiver_user_id' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

	// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAA9MLkv08:APA91bFsKwI5qg-P2TSU2QAv0zSxe1FsYQeLrJ9C8zXay7CLDOV8UHbA1f90lDmBBD1WJt-wNK1B0ytzn5fAmNVV3SsyrdlOpdzckYb33iXaux6uRpWBy7bFviv8iaoQrOKQzh-bo_Y9' );


$registrationIds ="$row[token_id]";

// prep the bundle
$msg = array
('title'		=> 'MyChatHub',
	'body' => 'New Message Received',
	'click_action' => 'https://www.mychathub.in',
    'icon'=> 'https://i.ibb.co/ckRLT5h/icon-256x256.png',
    'priority'=> 'high'
);

$fields = array
(
	'registration_ids' 	=> array($registrationIds),
	'notification'		=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );


	
	echo'1';}else{}

}
}
?>