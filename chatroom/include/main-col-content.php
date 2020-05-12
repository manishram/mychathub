<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>

<style>
.msg_div_box{
    border-bottom:0.5px solid #eaeaea;
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
}
.msg_div_box:nth-child(odd){
    background:#f5f5f5;
}
@media (max-width: 575px) {
#main_chat_content
{

overflow-x:hidden;
}
}
</style>

<div id='main_chat_content' class=''>
<?php
if(!isset($_SESSION['username'])){session_start();}
include_once('conn.php');

function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return 'Just now';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);


$h= "SELECT * FROM room_chat WHERE room_id='$z[active_room]'";
$i=mysqli_query($conn,$h);
$count_rows=(mysqli_num_rows($i)-20);
if($count_rows>=0){$row_limit=$count_rows;}else{$row_limit=0;}
$a = "SELECT * FROM room_chat WHERE room_id='$z[active_room]' LIMIT $row_limit,20";
$b=mysqli_query($conn,$a);
$i=0;
while($c = mysqli_fetch_array($b))
{
	
    $str = $c['msg'];
	$file="include/emoji/emoji_1.txt";
    $file_2="include/emoji/emoji_2.txt";
include('include/content_parser.php');

	$time_ago=date('Y-m-d\TH:i:sO', $c['msg_time']);
	
	$x = "SELECT * FROM users WHERE user_id='$c[user_id]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);
if($z['username']==$_SESSION['username']){
	$left_border='4px solid #0cc2aa';
	$my_post_bg='#e1f3f1';
	$my_post_border_bottom='#bdf0ea';
	$delete_post="<small  msgid=$c[id]  title='Delete' data-toggle='modal' data-target='#delete_my_post_modal' class='text-muted delete_my_msg' style='cursor:pointer;font-size:10px;float:right;'>  <i class='fas fa-trash-alt'> </i></small>";
	$report_post='';
	}
	else
	{
		$left_border='';
		$my_post_bg='';
		$my_post_border_bottom='0.5px solid $my_post_border_bottom';
	    $delete_post='';
		$report_post=" <small msgid=$c[id] title='Report' class='text-muted' style='cursor:pointer;font-size:10px;float:right;'><i class='fas fa-flag'>  </i></small>";
		}
		 if($z['profile_pic']==""){$profile_pic="user_default.jpg";}else{$profile_pic="thumbnails/thumb_x_sm_$z[profile_pic]";}
		 $time_check=time()-120;
	
	if((intval($z['last_active'])>$time_check)) {$active_status="on";}else{$active_status="busy";} //active status of users
echo
"
<div class='msg_div_box' style='border-left:$left_border;background:$my_post_bg;border-bottom:0.5px solid $my_post_border_bottom;'>
<li class='list-item '>
			                <a data-toggle='modal'  data-target='#profile_2 ' value='$z[user_id]' class='list-left user-profile-trigger-class'>
			                	<span class='avatar' style='height:40px;width:40px;'>
				                  <img style='height:40px;width:40px;' class='profile-pic' src='../chatroom/upload/profile_pic/$profile_pic' alt='$z[username]'>
				                  <i class='$active_status b-white bottom'></i>
				                </span>
			                </a>
	<div class='list-body'>
			                  <div>
							  
 <a data-toggle='modal' data-target='#profile_2 ' value='$z[user_id]' style='color:#0cc2aa;font-weight:bold;' class='user-profile-trigger-class'>$z[username]</a>
 <small class='text-muted' style='font-size:10px;float:right;'> <time class='timeago' datetime='$time_ago'></time></small> </div>
			                  <small class=' '>$str</small>
							  $report_post  $delete_post
			                </div></li>			                
		</div>		              
";	
}
$a = "SELECT * FROM room_chat WHERE room_id='$z[active_room]' ORDER BY id DESC LIMIT 1";
$b=mysqli_query($conn,$a);
$n= mysqli_fetch_array($b);
if(!isset($n['id'])){$_SESSION['last_msg_id']=0;}else{$_SESSION['last_msg_id']=$n['id'];}

?>
</div>


<input type='hidden' name='last_msg_id' id='last_msg_id' value='<?php echo $_SESSION['last_msg_id']?>'>
<script>

$('#main-body-left').animate({scrollTop: $('#main-body-left').get(0).scrollHeight}, 0); 


var check=function()
{
     var x = Math.floor((Math.random() * 1000000));
var last_id = $('#last_msg_id').val();	
$.get('include/check-room-chat-updated.php',{last_msg_id: last_id, random: x}, 
function(output){
	if(output!=0 && output.length==1)
{
$.get('include/new-main-chat.php',{last_msg_id: last_id}, function(outputx){$('#main_chat_content').append(outputx);
$('#main-body-left').animate({scrollTop: $('#main-body-left').get(0).scrollHeight}, 0); 
//successfully appended room message data
});	
}
else{
	$.get('include/check-room-chat-updated.php',{last_msg_id: last_id, random: x}, 
function(output){
	if(output!=0 && output.length==1){
check();}
});
	//failed to append room message data
	return;
} 

});
}


</script>
<script>
jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});

$('.delete_my_msg').click(function(){
$('#id_of_msg_to_dlt').val($(this).attr("msgid"));	
});


</script> 	