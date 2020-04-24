 <?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}
           

include_once('conn.php');

$username=$_SESSION['username'];
$room_query = "SELECT * FROM users WHERE username='$username' ";
$room_data=mysqli_query($conn,$room_query);
$row_me = mysqli_fetch_array($room_data);
$user_id=$row_me['user_id'];
            
            $sql="SELECT*FROM personal_chats WHERE (receiver_user_id='$user_id' AND seen=0)";

$sql_query=mysqli_query($conn,$sql);
$count_msg=array();
while($row=mysqli_fetch_array($sql_query)){
array_push($count_msg,$row['sender_user_id']);
}
echo count(array_unique($count_msg));           

?>