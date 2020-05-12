<script>

var conn = new WebSocket('ws://localhost:8080');



</script>
<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
 <div class="app-header primary dk box-shadow">

        <div class="navbar navbar-toggleable-sm flex-row align-items-center ">

		<!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3 color-change">
              <i class="material-icons">&#xe5d2;</i>
            </a>
			 
           
 		   <!-- / -->
        
		
		
		
		
			
			
			
            <!-- / navbar collapse -->
        
            <!-- navbar right -->
          
			<ul class=" nav navbar-nav ml-auto flex-row" >
            <li class="nav-item dropdown pos-stc-xs">
			   <a class="nav-link mr-2" title="Install MyChatHub" id="installBtn" href="#">
                  <i class="fas fa-arrow-circle-down"></i>
				 
				  <span>
                  
                </a>
			 </li>
			<li class="nav-item dropdown pos-stc-xs">
			   <a class="nav-link mr-2" href="" id="count_new_pm" data-toggle='modal' data-target='#pm_list_modal'>
                  <i class="fas fa-comment-alt"></i>
				  <span id='red_indicator'>
				  <script>
				  
				  </script>
				  <span>
                  
                </a>
			 </li>
			
			<li class="nav-item dropdown pos-stc-xs">   
			   <a class="nav-link mr-2" href="" id="count_new_notify" data-toggle='modal' data-target='#notify_list_modal'>
                  <i class="material-icons"></i>
                   <span id='yellow_indicator'>
				  
				  <span>
                </a>
              
	
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                 <span class=" avatar" style='margin-top:2px;cursor:pointer;height:36px;width:36px;'>
              <?php
 if($row['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$row[profile_pic]";}
?>
              <img style='height:36px;width:36px;' class='profile-pic profile_pic_display' src='../chatroom/upload/profile_pic/<?php echo $profile_pic;?>'></img>


                   
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-overlay pull-right">

<a href='rooms.php' class="leave_room_link dropdown-item">
    <span>Rooms</span>
  </a>
  <a class="dropdown-item my-profile-btn">
    <span>Profile</span>
  </a>
  <div class="dropdown-divider"></div>
  <a href='logout.php' class="dropdown-item">Sign out</a>
</div>
              </li>
              
            </ul>
 		

            <!-- / navbar right -->
        </div>
    </div>
    <!--Messages history modal-->
	
 	<div class="modal fade" id="pm_list_modal" style='border-radius:0;z-index:10000 !important;' role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style='background:#0cc2aa'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Messages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='padding:0;max-height:350px;overflow-y:auto;' id='msg_history_body'>
   <!-- message_history_here... -->
      
	  </div>
      
    </div>
  </div>
</div>
 <!-- notification modal... -->
<div class="modal fade" id="notify_list_modal" style='border-radius:0;z-index:10000 !important;' role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style='background:#0cc2aa;border-bottom:1px solid #0c9482;'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='padding:0;' id='notify_history_body'>
   <!-- notification_history_here... -->
   
   
               
        <div class="b-b b-primary nav-active-primary">
          <ul class="nav nav-tabs" style='width:100%;height:48px;z-index:0;overflow-x:auto;overflow-y:hidden;'>
            <!--<li style='width:33.33%;' class="nav-item" >
              <a class="nav-link active" id='notification_tab_btn' style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab4_2" aria-expanded="false">
			 <center><i style='margin:0px; padding:0px;' class='fas fa-bullhorn fa-lg'></i> 
			 <small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Notifications</small>
			 </center>
			  
			  </a>
            </li>
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link" id='room_notification_tab_btn' style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab5_2" aria-expanded="false"> <center>
<i style='margin:0px; padding:0px;' class='fas fa-globe-asia fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Room Notificstions </small>
</center></a>
            </li>-->
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link active" id='friend_req_tab_btn' style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab_friend_req" aria-expanded="true"><center>
<i style='margin:0px; padding:0px;' class='fas fa-user-plus fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Friend Requests</small>
</center></a>
            </li>
          </ul>
        </div>
        <div class="tab-content" style='height:250px;overflow-y:auto;' >
        <!--  <div class="tab-pane animated fadeIn text-muted active" id="tab4_2" aria-expanded="false">
            <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;'>
						<ul class="list no-border p-b">
						 Notifications
						  </ul>
						
						
			        </div>
					 
          </div>
          <div class="tab-pane animated fadeIn text-muted" id="tab5_2" aria-expanded="false">
           Room notifications
          </div>
		  -->
          <div class="tab-pane animated fadeIn text-muted active" id="tab_friend_req" aria-expanded="true">
             
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="original_image_display_modal" style='border-radius:0;z-index:10000 !important;' role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" data-dismiss='modal' aria-label='Close' role="document" style='text-align:center;'>
    <div class="modal-content"  style='display:inline-block;background:none;border:0;'>
     
      <div class="modal-body text-center" style='padding:0px;' id='original_image_display_body'>

   <!-- image_here... -->
      
	  </div>
      
    </div>
  </div>
</div>
<script>


	$('#room_notification_tab_btn').click(
	function(){
		console.log('room-notification');
	}
	);
	$('#notification_tab_btn').click(
	function(){
		console.log('notification');
	}
	);
	$('#friend_req_tab_btn').click(
	function(){
		$.get('include/friend-requests.php',function(output){$('#tab_friend_req').html(output);});
	}
	);
		$('#count_new_notify').click(
	function(){
		$.get('include/friend-requests.php',function(output){$('#tab_friend_req').html(output);});
	}
	);
	

$('#count_new_pm').click(function(){
	$('#msg_history_body').html("<center><font color='#ccc'>Loading Chats...</font></center>"); 
$.get('include/msg-history.php',function(output){$('#msg_history_body').html(output);});
});
</script>
<!--for phone-->
<script>
$('body').off('click').on('click','.user_id_data',function(){
	     $('#pm-chat-data-phone').html("<center><font class='p-3' color='#ccc'>Loading Chats...</font></center>"); 
		var receiver_id_val=$(this).attr('value');

      
		$('#receiver_id_phone').val(receiver_id_val);
		var receiver_id_val= $('#receiver_id_phone').attr('value');
		
		 $.get('include/get-chat.php',{receiver_user_id :$('#receiver_id_phone').attr('value')},function(output){
		 $('#pm-chat-data').html(output); 
		 $('#overflow-div-pm-phone').scrollTop($('#overflow-div-pm-phone')[0].scrollHeight);});
			});
			
			
			

 

</script>
<script>
	
	$('body').off('click').on('click','.user_id_data',function(){
	     $('#pm-chat-data').html("<center><font color='#ccc'>Loading Chats...</font></center>"); 
		var receiver_id_val=$(this).attr('value');

      
		$('#receiver_id').val(receiver_id_val);
		var receiver_id_val= $('#receiver_id').attr('value');
		
		 $.get('include/get-chat.php',{receiver_user_id :$('#receiver_id').attr('value')},function(output){
			 $.post('include/get_username.php',{receiver_user_id :$('#receiver_id').attr('value')},function(receiver_username){
				  $('.h6').text(receiver_username);
				   $.post('include/get-profile-pic.php',{receiver_user_id :$('#receiver_id').attr('value')},function(receiver_profile_pic){
				 
				   $('#pm_receiver_profile_pic').attr('src','../chatroom/upload/profile_pic/'+receiver_profile_pic);
				  
			 });
				  
			 });
		  	 
			 
			
		 $('#pm-chat-data').html(output); 
		 $('#overflow-div-pm').scrollTop($('#overflow-div-pm')[0].scrollHeight);});
			});
			
			
			var check_pm=function(){
				 if($("#chat_2").is(":visible")){
$.get('include/check-personal-chat-updated.php',{receiver_user_id:	$('#receiver_id').attr('value') }, function(output){if(output!=0 && output.length==1)
{
$.post('include/new-personal-chat.php',{receiver_user_id:$('#receiver_id').attr('value') }, function(outputx){$('#pm-chat-data').append(outputx);
$.get('include/mark-pm-seen.php',{receiver_user_id:	$('#receiver_id').attr('value') });
$('#overflow-div-pm').scrollTop($('#overflow-div-pm')[0].scrollHeight);});	
}
else{} 
});

				 }
}


 if (window.matchMedia('(display-mode: standalone)').matches) {  
 $('#installBtn').hide();    
}
 



</script>
