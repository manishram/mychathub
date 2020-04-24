<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){echo "1";die();}

include_once('conn.php');

$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

$user_id=$row['user_id'];

$pictype=htmlentities(stripslashes($_POST['pictype']));



$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

if($pictype=="a"){
	$path = '../upload/profile_pic/'; // upload directory
$thumbnail_path = '../upload/profile_pic/thumbnails/';


if(!empty($_FILES['image_file']) && ($_FILES['image_file']['size']<2097152))
{$image_text='';
	
$img = $_FILES['image_file']['name'];
$tmp = $_FILES['image_file']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$time=time();
$rand=rand(1000,1000000);
$final_image = $rand.$row['user_id'].$time.'.'.$ext;
// checks valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
 
if($pictype=="a"){
	$thumbnail_file_path_name=$thumbnail_path.'thumb_x_sm_'.$final_image;
	
	if($ext=='jpg'||$ext=='jpeg'||$ext=='png'){
		include_once('thumbnailer_jpg_png.php');
		
	}
}

$profile_pic="$final_image";	
$sql = "UPDATE users SET profile_pic='$profile_pic' where username='$_SESSION[username]'";	
if(mysqli_query($conn,$sql))
{echo'okdone';echo $profile_pic;}else{mysqli_error($conn);}
}
} 
else 
{
echo 'invalid';
}
}


}else{
	$path = '../upload/cover_pic/'; // upload directory
	
	if(!empty($_FILES['image_file']) && ($_FILES['image_file']['size']<2097152))
{$image_text='';
	
$img = $_FILES['image_file']['name'];
$tmp = $_FILES['image_file']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$time=time();
$rand=rand(1000,1000000);
$final_image = $rand.$row['user_id'].$time.'.'.$ext;
// checks valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
 

$profile_pic="$final_image";	
$sql = "UPDATE users SET cover_pic='$profile_pic' where username='$_SESSION[username]'";	
if(mysqli_query($conn,$sql))
{echo'okdone';echo $profile_pic;}else{mysqli_error($conn);}
}
} 
else 
{
echo 'invalid';
}
}
}


?>