<?php

$dirname = "face/";
$images = glob($dirname."*.png");

foreach($images as $image) {
    echo "<img style='width:20px;height:20px;' src=".$image." /><br />";
}


?>