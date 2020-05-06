<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<style>
@keyframes spinner {
  to {transform: rotate(360deg);}
}
 
.spinner:before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 40px;
  height: 40px;
  margin-top: -10px;
  margin-left: -10px;
  border-radius: 50%;
  border-top: 2px solid #0cc2aa;
  border-right: 2px solid transparent;
  animation: spinner .6s linear infinite;
}
</style>	<div class="spinner-grow text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<?php if($row['vip_status']==1){$room_btn_top= " | <a id='creat-room-btn' data-toggle='modal' data-target='#creat_new_room_modal'><i style='margin-left:10px;color:#0cc2aa;' class='fa fa-plus fa-sm'></i><font style='color:#0cc2aa;'> New </font></a>
							
							" ;}else{$room_btn_top= "";} ?>

<div class='padding-lg main-bdy' style='padding-bottom:0;'>
<div class="box" style='padding:0px;margin-bottom:0;float:right;width:270px;' id="member-box-z">
			            
     
	<!----right main col body content --->
	 <?php include('include/right-col-in-roompage.php'); ?>
	 
					</div>
<div class='row white box-shadow-z1'>
<div class="box  col-12" style='padding:0;margin-bottom:0; '>
						<div class="box-header box-shadow-z2" style='background-color:#e7efee;'>
							 <a data-toggle="modal" id='aside2-tgl-btn' data-target="#aside_2" style='float:right;'  class="hidden-lg-up mr-3 ">
							 
              <font style='color:#0cc2aa;'><i class="material-icons ">&#xe5d2;</i></font>
			  
            </a> 
								<h3> <i class="fa fa-home fa-sm"></i> Rooms <?php echo $room_btn_top; ?></h3>
						
						</div>
						 <div class="box-divider m-0"></div>
						
						<div class="box-body inner-box-overflow height-main-body " id='main-body-left' style='height: calc(100vh - 165px); '>
						  	
							
							<!----left main col body content --->
						
				<div id='parent-of-room-list' style=''>
				<span style=' position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0float:right;display:none;margin-left:47%;z-index:1000;' class='spinner' id='room-search-loading'></span>
				<div  id='list-of-rooms'>	
				<div class='row'>
<?php
include_once('conn.php');
$time_check=time()-60;
$room_query = "SELECT * FROM rooms ORDER BY (SELECT COUNT(*) FROM users WHERE (active_room=room_id) AND (last_active>$time_check) AND (online=1)) DESC, room_name ASC";
$room_data=mysqli_query($conn,$room_query);
while($row = mysqli_fetch_array($room_data)){
$time_check=time()-60;
$count_members_query = "SELECT*FROM users WHERE (active_room='$row[room_id]') AND (last_active>$time_check) AND (online=1)";
$count_members_query_x=mysqli_query($conn,$count_members_query);
$count_members=mysqli_num_rows($count_members_query_x);

$room_icon="../assets/images/room_default.png";	
if($row['room_type']=='1'){$enter_room_btn="
<a href='#' value='$row[room_id]' data-toggle='modal' data-target='#room_pass_modal' class='room_enter_btn btn btn-sm btn-outline rounded b-primary text-primary'> <i class='fa fa-lock fa-sm'></i> Enter Room</a>";}
else{$enter_room_btn="<a href='#' value='$row[room_id]' class='room_enter_btn btn btn-sm btn-outline rounded b-primary text-primary'>Enter Room</a>";}
echo"
<div class='col-xs-6 col-sm-12 col-md-6 ' style=''>
				  <div class='box text-center room-box' style='min-height:235px;border:1.0px solid #d8d8d8;border-radius:5px;box-shadow:none;background-color:#fbfbfb;'>
						<div class='box-tool'>
				        <ul class='nav'>
				          <li class='nav-item inline dropdown'>
				           <h5 style='display:inline;'><span class='label rounded primary label-md'>$count_members</span></h5>
				          <i style='color:##969696;' class='fas fa-users fa-lg'></i></li>
				        </ul>
				    </div>
				    <div class='p-a-md'>
				    	<p><img src='$room_icon' class='img-circle w-56'></p>
				    	<a href='' class='text-md block'><strong><font style='color:#7d7777 !important;'>$row[room_name]</font></strong></a>
				    	<p><small class='muted' style='color:#888888;font-size:80%;'>
						$row[room_desc]
						</small></p>
				    	$enter_room_btn
				    </div>
				    
				  </div>
				</div>
";
}

?>

</div>
</div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="room_pass_modal" tabindex="1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enter Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
  
  <form name="signin-form" id='enter_room_form' method='post'>
 <div class="md-form-group float-label">
 	<input type='hidden' id='room_id' name='room_id'>
          <input type="password" class="md-input" name='room_pass' ng-model="user.text" required>
		  <small class='text-muted' style='font-size:10px;'>* Room Password.</small>
          <label>Password</label>
        </div>
		<center><small style='display:none;' id='wrong_room_pass_msg' class='text-danger'>* Wrong Password Entered!!</small></center><br>
        <button type="submit" id='enter_room_after_pass' class="btn primary btn-block p-x-md" ><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <center><div class="loader" id='loader-spin' style='display:none;' ></div><center><span id='btn-text'>Enter Room<span></button>
     </form>
      </div>
      
    </div>
  </div>
</div>

<br>  
			  
	 		
						</div>
			<!--- Lower msg box fixed --->
 <?php include('include/lower-input-box.php'); ?>
 </div>




							
				
			
</div>		

<!---desktop-chat-box-->
<?php include('include/desktop-chat-box.php'); ?>


		              
				
				</div>

          

        
		
		
		<div id="msg-input-div-2" class='box-header ' style='position:fixed;bottom:0;z-index:100;padding:1px;background-color:#919696;width:100%;height:50px;box-shadow:0 -1px 2px rgba(0, 0, 0, 0.15), 0 -1px 0px rgba(0, 0, 0, 0.02) ;'><div class='row'>
						<div class="input-group " style='margin:3px 20px 0px 15px' >        
		<br><form class="conversation-compose" id='' >
                <div class="emoji">
                  <i class="fa fa-globe-asia" style='color:#ccc;font-size:15px;'></i> 
                </div>
                <input class="input-msg" id='room-search-input-box-phone' maxlength='200' style='height:38px;margin-left:-1px;'  name='room_search_input' placeholder="Search room.." autocomplete="off" >
                <div class="photo" style='margin-left:-1px;'>
                  
                <button id='search-room-btn-phone'  type='submit' class="send">
                    <div class="circle" style='height:35px;width:35px;background:none;'>
                <i class="fa fa-search" style='color:#0cc2aa;font-size:20px;'></i>     
                    </div>
                  </button>
				</div>
                
              </form>
		</div>
		</div>

</div>


		
		
<!-- aside-2 ---->
<?php include('include/aside-2-roompage.php'); ?>
		
<div class="modal fade" id="creat_new_room_modal" style='border-radius:0;z-index:10000 !important;' role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style='background:#0cc2aa'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Add New Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='padding:0;max-height:350px;overflow-y:auto;' id='add_new_room_form_body'>
      
	  <!--new room form-->
	  
	  </div>
      
    </div>
  </div>
</div>
 <script>
$('#creat-room-btn').click(function(){
	
	$.get('include/creat-room.php',function(output){$('#add_new_room_form_body').html(output);});
	
})

</script>
 <script>
 var myrmdat=`<?php 
	$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$active_room_id=$row['active_room'];
	echo $active_room_id;?>`;
 $( "#parent-of-room-list" ).on("click", ".room_enter_btn",function() { 
var room_id_val=$(this).attr('value');
myrmdat=room_id_val;
$(this).text('Loading...');
$.post('include/room_private_check.php',{room_id: room_id_val},function(output){if(output==1)
{   
    $('a:contains("Loading..."):last').html("<i class='fa fa-lock fa-sm'></i> Enter Room");
	$('#room_id').prop('value',room_id_val);
}
else{
	$.post('include/active_room.php',{room_id: room_id_val},function(output){if(output==1){$('#view').load('chat-room.php');
	var ws_data=JSON.stringify({"data":myrmdat,"action":"update_members"});
	conn.send(ws_data);
	}else{console.log('')}});	
}});	
});

$('#enter_room_after_pass').click(function(){

	$.post('include/active_room.php',$('#enter_room_form :input ').serializeArray(),function(output){if(output==1){
			$('body').removeClass('modal-open');
$('.modal-backdrop').remove();$('#wrong_room_pass_msg').hide();$('#view').load('chat-room.php');
	var ws_data=JSON.stringify({"data":myrmdat,"action":"update_members"});
	conn.send(ws_data);
	}else{if(output==0){$('#wrong_room_pass_msg').show() }else{console.log('error')}}console.log('')});	
});


$('#enter_room_form').submit(function(){ return false; });




</script>			 
<script>
$('#room-search-input-box-phone').keyup(function(){
	$('#room-search-loading').eq(0).show();
	$.get('include/search-room.php',{room_search_input: $('#room-search-input-box-phone').val()},function(output){
		$('#list-of-rooms').empty();$('#room-search-loading').eq(0).hide();$('#list-of-rooms').append(output);
	});
});

$('#search-room-btn-phone').click(
function(){
	event.preventDefault()
	$('#room-search-loading').eq(0).show();
	$.get('include/search-room.php',{room_search_input: $('#room-search-input-box-phone').val()},function(output){
		$('#list-of-rooms').empty();$('#room-search-loading').eq(0).hide();$('#list-of-rooms').append(output);
	});
}
);
</script>