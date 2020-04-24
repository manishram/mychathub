<script>
var styles1='<style>::-webkit-scrollbar-track {background: #314151 !important; } ::-webkit-scrollbar-thumb{background: #0cc2aa !important;}::-webkit-scrollbar-thumb:hover {background: #888888 !important;}</style>';
var styles2='<style>::-webkit-scrollbar-track{background: #f3f3f3; }::-webkit-scrollbar-thumb{background: #ccc; }::-webkit-scrollbar-thumb:hover{background: #888888;}</style>';

var i=0
$("#settings").click(function(){
$( ".white" ).toggleClass( "dark" ); 
$( "body" ).toggleClass( "dark-body-bg" ); 
$( "#msg-input-div" ).toggleClass( "dark-body-bg" ); 
$( ".room-box" ).toggleClass( "room-box-dark" );

if(i%2==0)
{$(styles1).appendTo('head');i=i+1}
else
{$('style').remove();i=i+1}


});



</script>