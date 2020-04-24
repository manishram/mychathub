<?php
if(!isset($_GET['last_msg_id']) || $_GET['last_msg_id']==''){}
else{
session_start();
include('../conn.php');

$x = "SELECT * FROM users WHERE username='$_SESSION[username]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);


if(isset($_SESSION['last_msg_id'])){$last_msg_id= $_SESSION['last_msg_id'];
$sql="SELECT*FROM room_chat WHERE room_id='$z[active_room]' AND id>$last_msg_id ";
}else{
$sql="SELECT*FROM room_chat WHERE room_id='$z[active_room]'";
}
$sql_query=mysqli_query($conn,$sql);

while($c = mysqli_fetch_array($sql_query)){
		$time_ago=date('m/d/Y H:i:s', $c['msg_time']);
	$x = "SELECT * FROM users WHERE user_id='$c[user_id]'";
$y=mysqli_query($conn,$x);
$z = mysqli_fetch_array($y);



$str = $c['msg'];

$str = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(:bow:)|(?:jpe?g|png|gif)#', function($arr)
{
    if(strpos($arr[0], 'http') !== 0)
    {
        $arr[0] = '' . $arr[0];
    }
    $url = parse_url($arr[0]);

    // images
    if(preg_match('#\.(png|jpg|gif)$#', $url['path']))
    {
        return '<img style=height:150px; src="'. $arr[0] . '" /><br>';
    }
	//emoji
	if(preg_match('(:bow:)', $url['path']))
    {
		$x=str_replace(":","",$arr[0]);
        return sprintf('<img style=height:20px; src="../assets/emoji/smiley/%1$s.gif"/><br>', $x);
    }
    // youtube  
    if(in_array($url['host'], array('www.youtube.com', 'm.youtube.com','youtube.com'))
      && $url['path'] == '/watch'
      && isset($url['query']))
    {
        parse_str($url['query'], $query);
        return sprintf('<iframe class="embedded-video" style=height:170px;width:275px;  src="https://www.youtube.com/embed/%s" allowfullscreen></iframe><br>', $query['v']);
    }
    //links
    return sprintf('<a style=color:#0cc2aa; href="%1$s">%1$s</a>', $arr[0]);
}, $str);
if($z['username']==$_SESSION['username']){$right_border='4px solid #0cc2aa';}else{$leftt_border='';}
echo
"
<div class='msg_div_box' style='border-left:$right_border;'>
<li class='list-item '>
			                <a data-toggle='modal' data-target='#profile_2 ' value='$z[user_id]' class='list-left user-profile-trigger-class'>
			                	<span class='w-40 avatar'>
				                  <img src='../assets/images/a2.jpg' alt='...'>
				                  <i class='on b-white bottom'></i>
				                </span>
			                </a>
	<div class='list-body'>
			                  <div>
							  
 <a data-toggle='modal' data-target='#profile_2 ' style='color:#0cc2aa;font-weight:bold;'>$z[username]</a>
 <small class='text-muted' style='font-size:10px;float:right;'>$time_ago</small> </div>
			                  <small class=''>$str</small>
			                </div></li>			                
				              </div>
";
}
$a = "SELECT * FROM room_chat WHERE room_id='$z[active_room]' ORDER BY id DESC LIMIT 1";
$b=mysqli_query($conn,$a);
$n= mysqli_fetch_array($b);
if($n['id']==null){$_SESSION['last_msg_id']=0;}else{$_SESSION['last_msg_id']=$n['id'];}
}

?>