<?php

if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$username=$_SESSION['username'];
$session_id = session_id();
$sql = "UPDATE users SET session_id='$session_id' where username='$_SESSION[username]' AND user_rank!='0'";
if(mysqli_query($conn,$sql)){
	
$original_url='https://'.$_SERVER['HTTP_HOST']; //try with all urls above

    $pieces = parse_url($original_url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
	$host = '.'.$regs['domain'];
	}
	if(isset($host)){}else{$host='localhost';}

$sql = "SELECT*from users where username='$username'";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

if($row['user_rank']==0){}else{setcookie('cookie_session_id', $session_id, time() + (86400 * 7), "/",$host);}
	
	echo"1";}else{echo mysqli_error($conn);}


?>
	