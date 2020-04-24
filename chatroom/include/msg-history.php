  <style>
  .msg-list-item:hover{background-color:#eaeaea !important;}
  </style>
  <?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}
     
     include_once('conn.php');

$username=$_SESSION['username'];
$room_query = "SELECT * FROM users WHERE username='$username' ";
$room_data=mysqli_query($conn,$room_query);
$row_me = mysqli_fetch_array($room_data);
$user_id=$row_me['user_id'];
            
            $sql="SELECT*FROM personal_chats WHERE (receiver_user_id='$user_id' OR sender_user_id='$user_id')";

$sql_query=mysqli_query($conn,$sql);
$count_total_msg=mysqli_num_rows($sql_query);
if($count_total_msg==0){echo"<center><b><small class='text-muted'><i class='fas fa-envelope fa-lg'></i><br> Inbox is Empty</small></b></center>";}else{
$senders=array();
while($row=mysqli_fetch_array($sql_query)){
if($row['sender_user_id']==$row_me['user_id']){array_push($senders,$row['receiver_user_id']);}else{array_push($senders,$row['sender_user_id']);}

}
$final_senders=array_unique(array_reverse($senders));
     foreach($final_senders as $sender){
     $sql="SELECT*FROM personal_chats WHERE (receiver_user_id='$row_me[user_id]' AND sender_user_id='$sender' AND seen=0)";
$sql_query=mysqli_query($conn,$sql);
$count_unseen_msg=mysqli_num_rows($sql_query);
    
    if($count_unseen_msg==0){$display_msg_num='';}else{$display_msg_num="<span class='label rounded  pos-rlt text-sm m-r-xs danger'> <b class='arrow left b-danger pull-in'></b>$count_unseen_msg </span>";}
           $sql="SELECT*FROM personal_chats WHERE (receiver_user_id='$sender' OR sender_user_id='$sender') ORDER BY id DESC LIMIT 1";
$sql_query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($sql_query)){
    
    
    $room_query = "SELECT * FROM users WHERE user_id='$sender' ";
$room_data=mysqli_query($conn,$room_query);
$row_me_z = mysqli_fetch_array($room_data);
$sender_username=$row_me_z['username'];

$str=$row['msg'];
			  $file="emoji/emoji_1.txt";
    $file_2="emoji/emoji_2.txt";
	include('content_parser_notif.php');
	
if($row_me_z['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$row_me_z[profile_pic]";}
if($row['receiver_user_id']==$row_me['user_id'] && $row['seen']==0){$bg='#e7f7f5';}else{$bg='#fff';}
echo"

<li class='list-item msg-list-item user_id_data' onClick='chatboxshow()' data-target='#chat_2' data-dismiss='modal' aria-label='close' value='$sender' style='cursor:pointer;background:"; echo $bg; echo"'>
		
			<a class='list-left'>
			                	<span class='w-40 avatar'>
				                  <img src='../chatroom/upload/profile_pic/$profile_pic' alt='...'>
				                  <i class='on b-white bottom'></i>
				                </span>
			                </a>
			                <div class='list-body'>
			                  <div>
							  
"; echo $sender_username; echo"<span style='float:right'>$display_msg_num</span>
 </div>
			                  <small class='text-muted text-ellipsis'>";echo $str; echo "</small>
			                </div>
							
			              </li>";
}


}}
     ?>
  <script>
  function chatboxshow(){
  $('#chat_2').modal('show');
  }</script>