<?php
include_once('include/conn.php');
$time_check=time()-120;
$sql_guest="SELECT*FROM users WHERE (user_rank=0) AND ((last_active<$time_check) OR (online=0)) ";
$sql_guest_query=mysqli_query($conn,$sql_guest);
while($row_guest = mysqli_fetch_array($sql_guest_query))
{
	$guest_username=$row_guest['username'];
	if($guest_username[0]!='(')
	{
		$random=rand(10,100);
$new_guest_username="(GUEST-$row_guest[username]_$random$row_guest[account_created])";

$update_guest="UPDATE users set username= '$new_guest_username' WHERE username='$row_guest[username]'";
mysqli_query($conn,$update_guest);

	}
	

}
?>
