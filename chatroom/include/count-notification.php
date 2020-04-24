 <?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}
           

include_once('conn.php');

$username=$_SESSION['username'];
$room_query = "SELECT * FROM users WHERE username='$username' ";
$room_data=mysqli_query($conn,$room_query);
$row_me = mysqli_fetch_array($room_data);
$user_id=$row_me['user_id'];
            

$friend_req = "SELECT*FROM friends WHERE (user_id_2='$row_me[user_id]') AND (accept=0)";
$friend_req_query_x=mysqli_query($conn,$friend_req);
$count_req=mysqli_num_rows($friend_req_query_x);

//add more notication counters here.....
$count_room_notications=0;
$count_notifications=0;

$total_notifications=$count_req+$count_room_notications+$count_notifications;         

echo $total_notifications;
?>