<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

		  include('conn.php');
		  $username=$_SESSION['username'];
		  $receiver_user_id=htmlentities(stripslashes(trim($_GET['receiver_user_id'])));
$user_query = "SELECT * FROM users WHERE username='$username' ";
$user_data=mysqli_query($conn,$user_query);
$row_me = mysqli_fetch_array($user_data);
$time_check=time()-60;
$my_user_id=$row_me['user_id'];
		  
		  $sql="SELECT*FROM personal_chats WHERE (sender_user_id='$my_user_id' AND receiver_user_id='$receiver_user_id') OR (sender_user_id='$receiver_user_id' AND receiver_user_id='$my_user_id')";
		  $chat_data=mysqli_query($conn,$sql);
		  while($row=mysqli_fetch_array($chat_data)){
			  
			  $str=$row['msg'];
			  $file="emoji/emoji_1.txt";
    $file_2="emoji/emoji_2.txt";
	include('content_parser.php');
			  $time_ago=date('Y-m-d\TH:i:sO', $row['sent_time']);
			 if($row['sender_user_id']==$my_user_id){
				 echo"
				  <div class='m-b'>
              <a href class='pull-right w-32 m-l-sm'><img src='../assets/images/user_default.jpg' class='w-full img-circle' alt='...'></a>
              <div class='clear text-right'>
                <div class='p-a p-y-sm primary inline text-left r'>
                  $str
                </div>
                <div class='text-muted text-xs m-t-xs'><time class='timeago' datetime='$time_ago'></time></div>
              </div>
            </div>
				 "; 
				 }else{
					 
					 echo"
					  <div class='m-b'>
              <a href class='pull-left w-40 m-r-sm'><img src='../assets/images/user_default.jpg' alt='...' class='w-full img-circle'></a>
              <div class='clear'>
                <div class='p-a p-y-sm white inline r'>
                  $str
                </div>
                <div class='text-muted text-xs m-t-xs'><i class='fa fa-ok text-primary'></i><time class='timeago' datetime='$time_ago'></time></div>
              </div>
            </div>
					 ";
				 }
			 
		  }
		  
	
$sql="UPDATE personal_chats SET seen=1 WHERE (sender_user_id='$receiver_user_id' AND receiver_user_id='$my_user_id' AND seen=0)";
if(mysqli_query($conn,$sql)){}
		  
echo'<script src="scripts/jquery.timeago.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
</script>';  
		  ?>