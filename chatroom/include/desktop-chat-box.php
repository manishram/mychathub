<style>
@media only screen and (max-width: 575px) {
#chat_box_{
		width:100% !important;
		
}}
@media only screen and (min-width: 575px) {
#chat_box_{
		width:380px !important;
		
}}

</style>
<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<div class="modal inactive" style='z-index:1000;' id="chat_2" data-backdrop="false">
  <div id="chat_box_" style='margin-top:60px;' class="right w-xxl white dk">
  <?php include('personal-chat.php'); ?>
  </div>
</div>