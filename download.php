<?php
if(isset($_GET['img'])){
	$filename = $_GET['img'];//图片地址,可以绝对地址也可以相对地址
	header("Content-Type: application/force-download");
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	$img = file_get_contents($filename); 
	echo $img;
}
?>