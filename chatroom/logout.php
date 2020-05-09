<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
include_once('include/conn.php');

$sql= "UPDATE users SET online=0 WHERE username='$_SESSION[username]'";
if(mysqli_query($conn,$sql)){}

        if(isset($_SESSION['username'])&&(!isset($_COOKIE['cookie_username']) && !isset($_COOKIE['cookie_session_id']))){
        unset($_SESSION['username']);
        session_destroy();
        }

        if(isset($_COOKIE['cookie_username'])&& isset($_COOKIE['cookie_session_id']))
        {
$original_url='https://'.$_SERVER['HTTP_HOST']; //try with all urls above

    $pieces = parse_url($original_url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
       $host = '.'.$regs['domain'];
}
if(isset($host)){}
else{$host='localhost';}

                setcookie('cookie_username', $_COOKIE['cookie_username'], time() - (86400 * 7), "/",$host);
				unset($_COOKIE['cookie_username']);
				
                setcookie('cookie_session_id', $_COOKIE['cookie_session_id'], time() - (86400 * 7), "/",$host);
				unset($_COOKIE['cookie_session_id']);

                unset($_SESSION['username']);
                session_destroy();
}
                session_destroy();
                header("Location: signin.php");

?>
