<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');

$username=$_SESSION['username'];
$me_user_query = "SELECT * FROM users WHERE username='$username' ";
$user_data=mysqli_query($conn,$me_user_query);
$row_me = mysqli_fetch_array($user_data);
$time_check=time()-60;
$user_id=$row_me['user_id'];

$friend_req = "SELECT*FROM friends WHERE (user_id_2='$row_me[user_id]') AND (accept=0) ORDER BY id DESC";
$friend_req_query_x=mysqli_query($conn,$friend_req);
$count_req=mysqli_num_rows($friend_req_query_x);

if($count_req==0){
	echo"<br><center><font color='#ccc'>No Friend Requests</font></center>";
}else{

while($row = mysqli_fetch_array($friend_req_query_x))
{
$request_sender_sql = "SELECT*FROM users WHERE user_id='$row[user_id_1]'";
$request_sender_query=mysqli_query($conn,$request_sender_sql);
$members=mysqli_num_rows($request_sender_query);

$sender = mysqli_fetch_array($request_sender_query);
	
	if($sender['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$sender[profile_pic]";}
	echo
	"
		<li class='list-item'>
			                <a  data-toggle='modal' data-target='#profile_2 ' value='$sender[user_id]'  class='list-left user-profile-trigger-class'>
			                	<span class=' avatar' style='height:40px;width:40px;'>
				                  <img style='height:40px;width:40px;'  class='profile-pic' src='../chatroom/upload/profile_pic/$profile_pic' alt='$sender[username]'>
				                  <i class='on b-white bottom'></i>
				                </span>
			                </a>
			                <div class='list-body'>
			                  <div>
							  
 <a data-toggle='modal' data-target='#profile'>$sender[username]</a>
 </div>
			                  <span class=''><input type='hidden' value='$sender[user_id]' class='user_id_hidden'/> <a style='color:#fff;' class='accpt_req_btn btn btn-sm btn-outline rounded b-primary text-primary'>Accept</a>
<a id='dlt_req' style='color:#fff;' class='cancel_req_btn btn btn-sm btn-outline rounded b-danger text-danger'>Decline</a>
							  </span>
			                </div>
			              </li>
	";
}}
?>
