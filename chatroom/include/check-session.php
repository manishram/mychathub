<?php
session_start();

if($_SESSION['username']!=null){echo'1';}else{echo'0';}
?>