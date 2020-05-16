<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

include_once('conn.php');
$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);

$a = "SELECT * FROM rooms WHERE room_id='$z[active_room]'";
$b=mysqli_query($conn,$a);
$c = mysqli_fetch_array($b);

?>
<div class='padding-lg main-bdy' style='padding-bottom:0;'>

<div class="box " style='float:right;padding:0;margin-bottom:0;width:270px' id="member-box-z">
			            
     
	<!----right main col body content --->
	 <?php include('include/right-main-col.php'); ?>
					</div>
<div class='row white box-shadow-z1' >
<div class="box col-12" style='padding:0;margin-bottom:0;max-height:100% !important; '>
						<div class="box-header box-shadow-z2" style='background-color:#e7efee;'>
							 <a data-toggle="modal" id='aside2-tgl-btn' data-target="#aside_2" style='float:right;'  class="hidden-lg-up mr-3 ">
							 
              <button style="height:50px;width:50px;position:fixed;bottom:50px;right:10px;" class="md-btn md-fab m-b-sm primary"><i class="fas fa-users fa-lg" style="vertical-align:0px;"></i></button>
			  
            </a> 
							<h3> <i class="fa fa-home fa-sm"></i> <?php echo $c['room_name']; ?>  | <a class='leave_room_link' style='color:#0cc2aa'><i style='margin-left:10px;color:#0cc2aa;' class='fas fa-sign-out-alt fa-sm'></i> Exit  </a></h3>
							
						</div>
						 <div class="box-divider m-0"></div>
						<div class="box-body inner-box-overflow height-main-body " id='main-body-left' style='padding:0;height: calc(100vh - 165px); '>
						  	
							
							<!----left main col body content --->
						<?php include('include/main-col-content.php'); ?>
				  		
						</div>
				
				          
				
							
						
					</div>



							
				
	<?php include('include/lower-message-input-box.php'); ?>
		
</div>		


						
						
<!---desktop-chat-box-->
<?php include('include/desktop-chat-box.php'); ?>


<!-- profile info--->
<?php //include('include/profile-info.php'); ?>

		              
				
				</div>
				
				
				
				

						   
<!-- aside-2 ---->
<?php include('include/aside-2-phone.php'); ?>
		
<!--- Lower msg box fixed --->

      
<!-- ############ PAGE END-->

<script>
$('.image_input_btn').click(function(){
 $('#room_chat_img_input').val(null);
 $('#room_chat_img_input').attr('accept','image/x-png,image/gif,image/jpeg'); 
});

$('.attachment_input_btn').click(function(){
 $('#room_chat_img_input').val(null);
 $('#room_chat_img_input').attr('accept','video/mp4, audio/mpeg'); 
});

var myrmdat=`<?php 
	$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$active_room_id=$row['active_room'];
	echo $active_room_id;?>`;
$('body').delegate('.leave_room_link','click', function(){
	$.get('include/exit_room.php',{},function(output){if(output==1){
		
	var ws_data=JSON.stringify({"data":myrmdat,"action":"update_members"});
	conn.send(ws_data);
	window.location.replace("rooms.php");}else{}});	
});

  $('#post-room-msg-form').submit(function(){ return false; });

$('#post-room-msg').click( function(){
	
$.get('include/post-room-msg.php',$('#post-room-msg-form :input ').serializeArray(),function(output){if(output==1){$("#post-room-msg-form").trigger("reset");
$('.emoji_picker_plate').stop().hide(250);
}else{$('#post-room-msg-form :input ').serializeArray()}});

var ws_data=JSON.stringify({"data":myrmdat,"action":"update_room_msg"});
	conn.send(ws_data);

check();
});

</script>

<script>


</script>
