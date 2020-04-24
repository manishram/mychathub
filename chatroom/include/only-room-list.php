<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<div class='row'>
<?php
include_once('conn.php');
$room_query = "SELECT * FROM rooms";
$room_data=mysqli_query($conn,$room_query);
while($row = mysqli_fetch_array($room_data)){

$count_members_query = "SELECT*FROM users WHERE (active_room='$row[room_id]')";
$count_members_query_x=mysqli_query($conn,$count_members_query);
$count_members=mysqli_num_rows($count_members_query_x);

$room_icon="../assets/images/room_default.png";	
if($row['room_type']=='1'){$enter_room_btn="
<a href='#' value='$row[room_id]' data-toggle='modal' data-target='#room_pass_modal' class='room_enter_btn btn btn-sm btn-outline rounded b-primary text-primary'> <i class='fa fa-lock fa-sm'></i> Enter Room</a>";}
else{$enter_room_btn="<a href='#' value='$row[room_id]' class='room_enter_btn btn btn-sm btn-outline rounded b-primary text-primary'>Enter Room</a>";}
echo"
<div class='col-xs-6 col-sm-12 col-md-6 ' style=''>
				  <div class='box text-center room-box' style='min-height:235px;border:0.5px solid #d8d8d8;border-radius:5px;box-shadow:none;background-color:#fbfbfb;'>
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
<script>
var myrmdat=`<?php 
	$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$active_room_id=$row['active_room'];
	echo $active_room_id;?>`;
$('#enter_room_after_pass').click(function(){

	$.post('include/active_room.php',$('#enter_room_form :input ').serializeArray(),function(output){if(output==1){
			$('#room_pass_modal').modal('hide');$('body').removeClass('modal-open');
$('.modal-backdrop').remove();$('#wrong_room_pass_msg').hide();$('#view').load('chat-room.php');
	}else{if(output==0){$('#wrong_room_pass_msg').show() }else{console.log('error')}}console.log(output)});	
});

$('.room_enter_btn').click( function(){
	var room_id_val=$(this).attr('value');
$.post('include/room_private_check.php',{room_id: room_id_val},function(output){if(output==1)
{
	$('#room_id').prop('value',room_id_val);
	
}
else{
	$.post('include/active_room.php',{room_id: room_id_val},function(output){if(output==1){$('#view').load('chat-room.php');
	var ws_data=JSON.stringify({"data":myrmdat,"action":"update_members"});
	conn.send(ws_data);
	}else{console.log(output)}});	
}});	
});


</script>			 