<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include('../conn.php');

$country=htmlentities(stripslashes(trim($_POST['country'])));
$language=htmlentities(stripslashes(trim($_POST['language'])));
$pm_status=htmlentities(stripslashes(trim($_POST['pm_status'])));
$gender=htmlentities(stripslashes(trim($_POST['gender'])));
$mood=htmlentities(stripslashes(trim($_POST['mood'])));
$bio=htmlentities(stripslashes(trim($_POST['bio'])));

$country_len=strlen($country);
$language_len=strlen($language);
$mood_len=strlen($mood);
$bio_len=strlen($bio);

$gender_array=array(1,2,3);
$who_can_pm_array=array(1,2,3);

if(($country_len<=30)&&($language_len<=100)&&($mood_len<=30)&&($bio_len<=500)&&(in_array($gender,$gender_array))&&(in_array($pm_status,$who_can_pm_array)))
{


$sql= "UPDATE users SET country='$country' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}

$sql= "UPDATE users SET language='$language' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}

$sql= "UPDATE users SET pm_status='$pm_status' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}

$sql= "UPDATE users SET gender='$gender' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}


$sql= "UPDATE users SET mood='$mood' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}

$sql= "UPDATE users SET bio='$bio' where username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){echo'1';}else{echo'Not updated';}	
	
}
else{echo"0";}


?>