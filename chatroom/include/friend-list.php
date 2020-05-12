<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');

$username=$_SESSION['username'];
$room_query = "SELECT * FROM users WHERE username='$username' ";
$room_data=mysqli_query($conn,$room_query);
$row_me = mysqli_fetch_array($room_data);
$time_check=time()-60;
$user_id=$row_me['user_id'];

$members_query = "SELECT*FROM friends WHERE ((user_id_1='$user_id') or (user_id_2='$user_id')) AND accept='1' ";
$members_query_x=mysqli_query($conn,$members_query);
$members=mysqli_num_rows($members_query_x);

if($members==0){
	echo"<center><b><small class='text-muted'>No friends.</small></b></center>";
}else{
while($row = mysqli_fetch_array($members_query_x))
{
	
	if($row['user_id_1']==$row_me['user_id']){$friend= $row['user_id_2'];}
	
	else
	{
		$friend= $row['user_id_1'];
	}
	
	$members_query = "SELECT*FROM users WHERE user_id='$friend'";
	$members_query_y=mysqli_query($conn,$members_query);

	$row_friend = mysqli_fetch_array($members_query_y);
	if($row_friend['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$row_friend[profile_pic]";}
	
	$chat_btn="
 <a data-toggle='modal' data-target='#chat_2' class='user_id_data' value='$row_friend[user_id]'  style='float:right'><i class='fas fa-comment-dots fa-2x'></i></a>";
$time_check=time()-120;
	
	if((intval($row_friend['last_active'])>$time_check)) {$active_status="on";}else{$active_status="busy";} //active status of users
	echo
	"
	<li class='list-item'>
			                <a  data-toggle='modal' data-target='#profile_2 ' value='$row_friend[user_id]'  class='list-left user-profile-trigger-class'>
			                	<span class=' avatar' style='height:40px;width:40px;'>
				                  <img style='height:40px;width:40px;' class='profile-pic' src='../chatroom/upload/profile_pic/$profile_pic' alt='$row_friend[username]'>
				                  <i class='$active_status b-white bottom'></i>
				                </span>
			                </a>
			                <div class='list-body'>
			                  <div>
							  
 <a data-toggle='modal' value='$row_friend[user_id]' class='user-profile-trigger-class' data-target='#profile_2'>$row_friend[username]</a>$chat_btn
 </div>
			                  <small class='text-muted text-ellipsis'> $row_friend[mood] </small>
			                </div>
			              </li>
	";
}}
?>
<script>
$('.user_id_data').click(function(){
	$('#aside_2').modal('hide');
});
</script>