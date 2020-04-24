<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

$str = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:jpe?g|png|gif|mp3|mp4)#', function($arr)
{
    if(strpos($arr[0], 'http') !== 0)
    {
        $arr[0] = '' . $arr[0];
    }
    $url = parse_url($arr[0]);
if(isset($url['path'])){
    //video
	if(preg_match('#\.(mp4)$#', $url['path']))
    {
        return '
		<i class="fas fa-file-video fa-lg" aria-hidden="true" style="margin-top:5px"></i><b><font size="3"> &nbsp:video-file</b></font><br>';
    }
	
	 //Audio
	if(preg_match('#\.(mp3)$#', $url['path']))
    {
		
        return '
		<i class="fas fa-file-audio fa-lg" aria-hidden="true" style="margin-top:5px"></i><b><font size="3"> &nbsp:audio-file</b></font><br>';
    }
	
    // images
    if(preg_match('#\.(png|jpg|jpeg|gif)$#', $url['path']))
    {
        return '<i class="fas fa-file-image fa-lg" aria-hidden="true" style="margin-top:5px"></i><b><font size="3"> &nbsp:image-file</b></font><br>';
    }
    // youtube
    if(in_array($url['host'], array('www.youtube.com','m.youtube.com' ,'youtube.com'))
      && $url['path'] == '/watch'
      && isset($url['query']))
    {
         return '
		<i class="fa fa-link fa-lg" aria-hidden="true" style="margin-top:5px"></i><b><font size="3"> &nbsp:Youtube-video-link</b></font><br>';
}
}
else
    //links
	return "
		<i class='fa fa-link fa-lg' aria-hidden='true' style='margin-top:5px'></i><b><font size='3'> &nbsp:$arr[0]</b></font><br>";
		
}, $str);


//this block detects emoji codes and replace them with emojis
$need_to_replace = file($file, FILE_IGNORE_NEW_LINES);
$to_be_replaced_with = file($file_2, FILE_IGNORE_NEW_LINES);


// transform the strings into regular expressions
$expressions_need_to_replace = array_map(
    function($placeholder) {
        return '/' . $placeholder . '/';
    },
    $need_to_replace
);



$new_str = preg_replace_callback(
    $expressions_need_to_replace,
    function($match) use ($need_to_replace, $to_be_replaced_with) {
        // first find out where in  $need_to_replace  the found match is
        $index = array_search($match[0], $need_to_replace);

        // get the image from the same location in  $to_be_replaced_with
        $image = $to_be_replaced_with[$index];

        // build the image string
        return "<img style='height:20px;width:20px;' src='include/emoji/face/". $image ."'/>";
    },
    $str
);

$str=$new_str;



?>