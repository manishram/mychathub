<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


if(!isset($_GET['last_msg_id']) || $_GET['last_msg_id']==''){}
else{

include('../conn.php');

$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);


if(isset($_SESSION['last_msg_id'])){$last_msg_id= $_SESSION['last_msg_id'];
$sql="SELECT*FROM room_chat WHERE room_id='$z[active_room]' AND id>$last_msg_id ";
}else{
$sql="SELECT*FROM room_chat WHERE room_id='$z[active_room]'";
}
$sql_query=mysqli_query($conn,$sql);

while($c = mysqli_fetch_array($sql_query)){
		$time_ago=date('Y-m-d\TH:i:sO', $c['msg_time']);
	$x = "SELECT * FROM users WHERE user_id='$c[user_id]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);



$str = $c['msg'];
$file="emoji/emoji_1.txt";
    $file_2="emoji/emoji_2.txt";
include_once('content_parser.php');


if($z['username']==$_SESSION['username']){
	$left_border='4px solid #0cc2aa';
	$my_post_bg='#e1f3f1';
	$my_post_border_bottom='#bdf0ea';
	$delete_post="<small  msgid=$c[id]  title='Delete' data-toggle='modal' data-target='#delete_my_post_modal' class='text-muted delete_my_msg' style='cursor:pointer;font-size:10px;float:right;'>  <i class='fas fa-trash-alt'> </i></small>";
	$report_post='';
	}
	else
	{
		$left_border='';
		$my_post_bg='';
		$my_post_border_bottom='0.5px solid $my_post_border_bottom';
	    $delete_post='';
		$report_post=" <small msgid=$c[id] title='Report' class='text-muted' style='cursor:pointer;font-size:10px;float:right;'><i class='fas fa-flag'>  </i></small>";
		}
if($z['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$z[profile_pic]";}
echo
"
<div class='msg_div_box' style='border-left:$left_border;background:$my_post_bg;border-bottom:0.5px solid $my_post_border_bottom;'>
<li class='list-item '>
			                <a data-toggle='modal'  data-target='#profile_2 ' value='$z[user_id]' class='list-left user-profile-trigger-class'>
			                	<span class='avatar' style='height:40px;width:40px;'>
				                  <img style='height:40px;width:40px;' class='profile-pic' src='../chatroom/upload/profile_pic/$profile_pic' alt='$z[username]'>
				                  <i class='on b-white bottom'></i>
				                </span>
			                </a>
	<div class='list-body'>
			                  <div>
							  
 <a data-toggle='modal' data-target='#profile_2 ' value='$z[user_id]' class='user-profile-trigger-class' style='color:#0cc2aa;font-weight:bold;'>$z[username]</a>
 <small class='text-muted' style='font-size:10px;float:right;'> <time class='timeago' datetime='$time_ago'></time></small> </div>
			                  <small class=' '>$str</small>
							  $report_post  $delete_post
			                </div></li>			                
		</div>		              
";	
}
$a = "SELECT * FROM room_chat WHERE room_id='$z[active_room]' ORDER BY id DESC LIMIT 1";
$b=mysqli_query($conn,$a);
$n= mysqli_fetch_array($b);
if($n['id']==null){$_SESSION['last_msg_id']=0;}else{$_SESSION['last_msg_id']=$n['id'];}
}

?>
<script src="scripts/jquery.timeago.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
$('.delete_my_msg').click(function(){
$('#id_of_msg_to_dlt').val($(this).attr("msgid"));	
});
</script> 