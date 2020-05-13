<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && $_POST['name']!="" && $_POST['email']!="" && $_POST['subject']!="" && $_POST['$

$from = "contact@mychathub.in";
$to = "admin@mychathub.in";
$name = htmlentities(stripslashes(trim($_POST['name'])));
$email = htmlentities(stripslashes(trim($_POST['email'])));
$subject = htmlentities(stripslashes(trim($_POST['subject'])));
$user_message = htmlentities(stripslashes(trim($_POST['message'])));

$client=$_SERVER['REMOTE_ADDR'];
$more_info=$_SERVER['HTTP_USER_AGENT'];

$headers = 'From: MyChatHub Users <"$email">' . PHP_EOL .
    'Reply-To: MyChatHub Users <"$email">' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message="
<html>
<body>
<b>This message is received by user from contact form in landing page of MyChatHub.in</b><br>
<b>User Name: </b><font>$name</font><br>
<b>User email: </b><font>$email</font><br>
<b>User Subject: </b><font>$subject</font><br>
<b>User message: </b><font>$user_message</font><br>
<b>User IP: </b><font>$client</font><br>
<b>Other Info: </b><font>$more_info</font>
</body>
</html>
";

mail($to, $subject, $message, $headers);






echo "1";
	
}else{echo "0";}


?>