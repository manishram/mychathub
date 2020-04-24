<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username']) && (!isset($_COOKIE['cookie_username']))){die(header('location: signin.php'));}


include"include/app-data.php";

include"conn.php";

if(!(isset($_SESSION['username'])) && (!isset($_COOKIE['cookie_username']))){header("Location: index.php");
die();}
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}else{$username=$_COOKIE['cookie_username'];}

$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$count=mysqli_num_rows($query);
if($count==0){die(header("Location: logout.php"));}

include('include/guest-username-modify.php');
?>
<!DOCTYPE html>
<html lang="en">
<head style=''>
  <meta charset="utf-8" />
  <title>MyChatHub | Chat Room</title>
  <meta name="viewport" content= "width=device-width, user-scalable=no">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <meta name="viewport" content="width=device-width, height=device-height">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#0cc2aa">
  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel='stylesheet' href='../assets/styles/all.css' type='text/css' >
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />

  <script src="../libs/jquery/jquery/dist/jquery.js"></script>  
  <link rel="stylesheet" href="../assets/styles/style.css" type="text/css" />
   <style>
/* Compose */

.conversation-compose {
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  overflow: hidden;
  height: 40px;
  width: 100%;
  z-index: 2;
}

.conversation-compose div,
.conversation-compose input {
  background: #fff;
  height: 100%;
}

.conversation-compose .emoji {
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border-radius: 50% 0 0 50%;
  flex: 0 0 auto;
  margin-left: 8px;
  width: 38px;
  height: 38px;
}

.conversation-compose .input-msg {
  border: 0;
  flex: 1 1 auto;
  font-size: 14px;
  margin: 0;
  outline: none;
  min-width: 50px;
  height: 36px;
}

.conversation-compose .photo {
  flex: 0 0 auto;
  border-radius: 0 30px 30px 0;
  text-align: center;
  width: auto;
  display: flex;
  padding-right: 6px;
  height: 38px;
}

.conversation-compose .photo img {
  display: block;
  color: #7d8488;
  font-size: 24px;
  transform: translate(-50%, -50%);
  position: relative;
  top: 50%;
  margin-left: 10px;
}


.conversation-compose .send {
  background: transparent;
  border: 0;
  cursor: pointer;
  flex: 0 0 auto;
  margin-right: 8px;
  padding: 0;
  position: relative;
  outline: none;
  margin-left: .5rem;
}

.conversation-compose .send .circle {
  background: #0cc2aa;
  border-radius: 50%;
  color: #fff;
  position: relative;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.conversation-compose .send .circle i {
  font-size: 24px;
  margin-left: 1px;
}

/* Small Screens */



@media (min-width: 575px){

#msg-input-div-2{
	display:none !important;
}	
}
.image-cropper {
	border:2px solid white;
	background:white;
	display:block;
    width: 100px;
    height: 100px;
    position: relative;
    overflow: hidden;
	
    border-radius: 50%;
}
.profile-pic {
	
  display: inline;
  margin-left: 0px;

  height: 100px;
  width: auto;
}
</style> 
<script>

</script>
</head>

<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

<!-----aside--->
<?php include('include/aside.php'); ?>

  
  <!-- content -->
  <div id="content"  class="app-content box-shadow-z0" role="main">

<!--- Top main Nav -->
<?php include('include/top-nav.php'); ?>

   
    <div ui-view class="app-body" id="view">
	
<?php
$sql = "SELECT*from users where username='$_SESSION[username]' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
if($row['active_room']!='')
{include('chat-room.php');}
else{include('include/room-list.php');}
 ?>
<!-- ############ PAGE START-->

        </div>
		
    </div>

	</div>
<!-- ############ PAGE END-->




 
  <!---Theme change settings script-->

 <?php include('include/theme-script.php'); ?>
<div class="modal fade" id="profile_2"  style='z-index:2002;' role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content col-xs-#" id='profile-info-modal-data' style='padding:0;'>
      
      
     
     
    </div>
  </div>
</div>

<script>

$('body').delegate(".user-profile-trigger-class","click",function(){
	$.get('include/profile-info-modal-data.php',{profile_user_id: $(this).attr('value')},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
});



	
	var update_room_members=function()
{
	$('.members-list-ul').load('include/room-members.php')
	$('.members-list-ul-phone').load('include/room-members.php')
	$('.room_list_right').load('include/room-list-right.php')
}

	$(document).ready(function() {

$.get('include/update-active-status.php');
update_room_members();
});

var update_active=function()
{
$.get('include/update-active-status.php');
}

setInterval(update_active,30000);



 // var check_session=function()
 // {
  
 // $.get('include/check-session.php',{},function(output){if(output!='1'){$('#view').hide();window.location.replace("signin.php");}});
 // }
 // setInterval(check_session,1000);

var count_new_pm_and_noti=function ()
{
$.get('include/count_new_pm.php',function(output){if(output>0){$('#red_indicator').empty();$('#red_indicator').append("<span class='label up rounded danger pm_count_value'>"+output+"</span>");}else{$('#red_indicator').empty();}});

$.get('include/count-notification.php',function(output_2){if(output_2>0){$('#yellow_indicator').empty();$('#yellow_indicator').append("<span class='label up rounded warn pm_count_value'>"+output_2+"</span>");}else{$('#yellow_indicator').empty();}});


}


</script>

<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>

<script src="scripts/jquery.timeago.js" type="text/javascript"></script>
  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
<script>
jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
</script>


<script>


$('#personal-chat-form').submit(function(){ return false; });
$('body').on('click','#send_pm_btn',function(){
		$.post('include/send-pm.php',$('#personal-chat-form :input').serializeArray(),function(output)
	{
		if(output==1){$("#personal-chat-form").trigger("reset");
		var ws_data=JSON.stringify({"data":$('#receiver_id').val(),"action":"update_pm"});
         	conn.send(ws_data);
			check_pm();	
         count_new_pm_and_noti();
		$('.emoji_picker_plate_pm').stop().hide(250);check_pm();}
	}
	);
});

</script>
<?php 
	$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$user_id=$row['user_id'];
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  count_new_pm_and_noti();
  $.get('include/check-session.php',{},function(output){if(output!='1'){$('#view').hide();window.location.replace("signin.php");}});
});



$(window).on('resize', function(event){
    var windowWidth = $(window).width();
if(windowWidth > 576){
  $('#aside_2').modal('hide');
}
});




$('body').on('click','.room_chat_thumbs',function(){
	$('#img_original_loading').show();
	var raw_img_path=$(this).attr('src');
	var origina_img_path=raw_img_path.replace('/thumbnails/thumb_x_sm_','/');
	$('#original_image_display_body').html("<button type='button' style='background:none;border:none;cursor:pointer;' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='text-danger' style='font-size:20px;'><i class='fa fa-times-circle mx-auto d-block'></i></span></button><br/><img style=' max-height:90vh;' class='img-thumbnail original_image_on_modal' src="+origina_img_path+"></img>");
	
	$('.original_image_on_modal').on('load',function(){
		
	$('#img_original_loading').hide();	
	});
	
});
$("body").delegate(".msg_button", "click", function(){
   $('#aside_2').modal('hide');
});

 
	
$("body").delegate(".my-profile-btn", "click", function(){
		$.get('include/my-profile.php',{},function(output){
			 $(".main-bdy").html(output);
   $('#aside').modal('hide');
   $('#msg-input-div-2').hide();
});});	



conn.onmessage = function(e) {
	var obj = JSON.parse(e.data);
	switch(obj.action) {
  case "update_room_msg":
    if(myrmdat==obj.data){
	check();}
    break;
  case "update_dlt_room_msg":
  
    $("small[msgid='"+obj.data+"']").closest('.msg_div_box').remove();
	
	break;
  case "update_pm":
    if(`<?php echo $user_id;?>`==obj.data){ 
  
    check_pm();
	count_new_pm_and_noti();
	
	}
    break;
  case "update_members":
    if(myrmdat==obj.data){
	update_room_members();}
    break;
  case "update_notifications":
    if(`<?php echo $user_id;?>`==obj.data){
	count_new_pm_and_noti();
	}
    break;
	///////////////////////////////////////////////////////////////check here to change for notification due to other triggers like friend requests
 }};	





</script>
  <script>
	  $('body').delegate('.add_friend_btn','click',function(){
		   var t=$(this);
		$.post('include/add-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.add_friend_btn').addClass('disabled_btn');
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
      $('body').delegate('.block_person_btn','click',function(){	
	  var t=$(this);
		$.post('include/block-person.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.block_person_btn').addClass('disabled_btn');
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
	count_new_pm_and_noti();
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});}else{};}); 
	 });
	 
	 
	  $('body').delegate('.remove_frnd_btn','click',function(){	
	   var t=$(this);
		$.post('include/remove-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.remove_frnd_btn').addClass('disabled_btn');
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
	 
	 
	   $('body').delegate('.cancel_req_btn','click',function(){	
	   var t = $(this);
		$.post('include/remove-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			t.closest('.list-item').fadeOut("slow",function(){
				$(this).remove();
			});
			$('.cancel_req_btn').addClass('disabled_btn');
			count_new_pm_and_noti();
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
	$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});}else{};}); 
	 });
	 
	 
	 
	  $('body').delegate('.accpt_req_btn','click',function(){	
	   var t = $(this);
		$.post('include/accept-request.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			t.closest('.list-item').fadeOut("slow",function(){
				$(this).remove();
			});
			$('.accpt_req_btn').addClass('disabled_btn');
			count_new_pm_and_noti();
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
	 
	 
	 $('body').delegate('.unblock_person_btn','click',function(){
        var t=$(this);		 
		$.post('include/unblock-person.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.unblock_person_btn').addClass('disabled_btn');
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	
	
	$( document ).ajaxStart(function() {
  console.log( "Triggered ajaxStart handler." );
});
	 </script>
	 
</body>
</html>
