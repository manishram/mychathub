<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


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
<a href='#' value='$row[room_id]' data-toggle='modal' data-target='#room_pass_modal' class='room_enter_btn'>$row[room_name]</a>  <i style='color:#fcc100;font-size:12px;' class='fa fa-lock fa-sm'></i>";}
else{$enter_room_btn="<a href='#' value='$row[room_id]' class='room_enter_btn'>$row[room_name]</a>";}
if($row['room_type']=='1'){$locked_room="";}else{$locked_room="";}
echo"
<li class='list-item' style='position:initial !important; '>
			                <a class='list-left'>
			                	<span class='w-40 avatar'>
				                  <img src='../assets/images/room_default.png' alt='...'>
				                 
				                </span>
			                </a>
			                <div class='list-body'>
			                  <div>
							  
$enter_room_btn 
 <a data-toggle='modal' data-target='#'  style='float:right'><h5 style='display:inline;'><span class='label rounded primary label-md'>$count_members</span></h5></i></a>
 </div>
			                </div>
			              </li>
";
}

?>

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
$('body').removeClass('modal-open');
$('.modal-backdrop').remove();$('#wrong_room_pass_msg').hide();$('#view').load('chat-room.php');
	}else{if(output==0){$('#wrong_room_pass_msg').show() }else{console.log('error')}}console.log('')});	
});


$('#enter_room_form').submit(function(){ return false; });


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
	}else{console.log('')}});	
}});	
});

</script>