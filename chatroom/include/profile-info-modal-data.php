<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


include_once('conn.php');
$profile_user_id= htmlentities(stripslashes(trim($_GET['profile_user_id'])));
$sql="SELECT*FROM users WHERE user_id='$profile_user_id'";
$sql_query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($sql_query);

?>
<style>
.disabled_btn{
	background:#ccc;
	 pointer-events: none;
  cursor: default;
}
.disabled_btn:hover{
	background:#ccc;
	coursor:default;
}
</style>
 <div class="modal-body" id='profile_data_main_body' style='padding:0;z-index:1000'>
 
        <div class="box" style='box-shadow:none;'>
		
					    <div class="item">
						    <div class="item-bg">
						      <img src="../chatroom/upload/cover_pic/<?php if($row['cover_pic']==""){echo "user_default.jpg";}else{echo $row['cover_pic'];}?>" class="blur">
						    </div>
						    <div class="p-a-lg pos-rlt text-center">
						    	<img src="../chatroom/upload/profile_pic/<?php if($row['profile_pic']==""){echo "user_default.jpg";}else{echo $row['profile_pic'];}?>" class="img-circle w-56" style="margin-bottom: -7rem">
						    </div>
						</div>
					    <div class="p-a text-center">
					    	<a class="text-md m-t block"><?php echo $row['username']; ?></a>
							<input type='hidden' value='<?php echo $row['user_id']; ?>' name='user_id_hidden' class='user_id_hidden' />
					    	<p><small>Mood:<?php echo $row['mood']; ?></small></p>
					    	
							
							
							<?php

$user_id_2= $row['user_id'];
$username=$_SESSION['username'];
if($user_id_2!='' && $username!=''){
$user_query = "SELECT * FROM users WHERE username='$username' ";
$user_data=mysqli_query($conn,$user_query);
$row_me = mysqli_fetch_array($user_data);

$user_query_2 = "SELECT * FROM users WHERE user_id='$user_id_2' ";
$user_data_2=mysqli_query($conn,$user_query_2);
$row_me_2 = mysqli_fetch_array($user_data_2);

if($row_me['user_id']==$user_id_2){}else{
$sql="SELECT*FROM friends where (user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2') OR (user_id_2='$row_me[user_id]' AND user_id_1='$user_id_2')";
$query=mysqli_query($conn,$sql);
$row_data = mysqli_fetch_array($query);
$count=mysqli_num_rows($query);

 $sql_block="SELECT*FROM block_list where user_id_1='$row_me[user_id]' AND user_id_2='$user_id_2'";
 $query_block=mysqli_query($conn,$sql_block);
 $count_block=mysqli_num_rows($query_block);
 $row_block = mysqli_fetch_array($query_block);
$chat="<a href='' style='' data-toggle='modal' data-target='#chat_2' value='$row[user_id]' class='btn btn-sm primary user_id_data chat-btn-in-modal'><i class='fa fa-comment-dots'></i> Chat </a> ";

$right_btn=''; 
$middle_btn='';
if($row['user_rank']!=0){
if($count!=0)
{
	if($row_data['accept']==1){
		$middle_btn="<a class='remove_frnd_btn btn btn-sm warning'><i class='fa fa-times'></i> Remove Friend </a> ";
	}
	else{
		if($row_data['user_id_1']==$row_me['user_id']){
			$middle_btn="<a class='cancel_req_btn btn btn-sm warning'><i class='fa fa-times'></i> Cancel Request </a> ";
		}
	if($row_data['user_id_2']==$row_me['user_id']){
		$middle_btn="<a class='accpt_req_btn btn btn-sm info'><i class='fa fa-check'></i> Accept Request </a> ";
		
	
	}
	}
	
}
else
{
	$middle_btn="<a  class='add_friend_btn btn btn-sm primary'><i class='fa fa-user-plus'></i> Add Friend </a> ";
}
}else{
	
}


 if($count_block!=0)
 {
	 $chat=' ';
	 $right_btn="<a  class='unblock_person_btn btn btn-sm danger'><i class='fa fa-times'></i>  Unblock </a> ";
	 $middle_btn='';
}
else{
	$right_btn="<a class='block_person_btn btn btn-sm danger'><i class='fa fa-ban'></i>  Block</a> ";
}
 
echo  $chat;
echo $middle_btn;
echo $right_btn;
}
}

							?>
							
							
					    	
					    	<hr>
<p style='text-align:justify;padding:10px;'>
							<b>Bio:</b><br>
							<?php if($row['bio']==""){echo "Hey this my bio section.";}else{ echo $row['bio']; } ?>
							</p>
							<button type="button" style='float:right;margin-left:-15px;border-radius:15px;' class="btn btn-sm danger" data-dismiss="modal">Close</button>
					<br>
					    </div>
						
					</div>
      </div>
	 <script>
	 $('.chat-btn-in-modal').click(function(){
		 $('#profile_2').modal('hide');
		 $('#aside_2').modal('hide');
	 })
	 </script>
