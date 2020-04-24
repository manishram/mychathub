<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<style>
.search-no-result{
	   overflow-wrap: break-word;
word-wrap: break-word;

-ms-word-break: break-all;
/* This is the dangerous one in WebKit, as it breaks things wherever */
word-break: break-all;
/* Instead use this non-standard one: */
word-break: break-word;

/* Adds a hyphen where the word breaks, if supported (No Blink) */
-ms-hyphens: auto;
-moz-hyphens: auto;
-webkit-hyphens: auto;
hyphens: auto;
}</style>
<?php
include_once('conn.php');

$search_keyword=htmlentities(stripslashes(trim($_GET['room_search_input'])));

$time_check=time()-60;
$room_query = "SELECT * FROM rooms WHERE (room_name LIKE '%$search_keyword%' OR room_desc LIKE '%$search_keyword%' OR wlcm_msg LIKE '%$search_keyword%') ORDER BY (SELECT COUNT(*) FROM users WHERE (active_room=room_id) AND (last_active>$time_check) AND (online=1)) DESC, room_name ASC";
$room_data=mysqli_query($conn,$room_query);
$count_results=mysqli_num_rows($room_data);
if($count_results!=0){
	echo"<div class='row'>";
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
}echo"</div>";
}else{echo"<center><font class='search-no-result' style='color:#ccc;'><i style='margin-bottom:10px;' class='fa fa-grin-beam-sweat fa-3x'></i> <br>Oops, no result found for <b>$search_keyword</b></font></center>";}
?>