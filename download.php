<?php
if(isset($_GET["img"])){ 

$filename=$_GET["img"];//获取参数
header('Content-Description: File Transfer');
header('Content-Type: application/force-download');
header("Content-Disposition: attachment; filename=" .$filename);
//注意：header函数前确保没有任何输出 
readfile(".".$filename);
exit;//结束程序 
}
?>