<?php
session_start();
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/rand.php');
$_POST=$_REQUEST;
$db=Pdb::getDb();
if(isset($_POST['model'])){
	switch ($_POST['model']) {
		case 'finish':
			$tag=false;
			$photo=isset($_POST['photo'])?$_POST['photo']:$tag=true;
			$name=isset($_POST['name'])?$_POST['name']:$tag=true;
			$function=isset($_POST['function'])?$_POST['function']:$tag=true;
			$location=isset($_POST['location'])?$_POST['location']:$tag=true;
			$email=isset($_POST['email'])?$_POST['email']:$tag=true;
			if($tag){
				print json_encode(array("code"=>2,"msg"=>"请填写必填项"));
				exit;
			}
			$dataString=$photo;
	        //处理图片
	        $dataAry=explode("base64,", $dataString);
	        $jpg = str_replace(' ', '+', $dataAry[1]);//得到post过来的二进制原始数据 
	        $jpg = base64_decode($jpg);
	        if(empty($jpg))  
	        {  
	            print json_encode(array("code"=>3,"msg"=>"请上传图片")); 
	            exit();  
	        }  
	        $filename=date("YmdHis").rand(10,99).'.jpg';
	        $file = fopen("./upload/img/".$filename,"w");//打开文件准备写入  
	        fwrite($file,$jpg);//写入  
	        fclose($file);//关闭  
	          
	        $imageSourceUrl = "/upload/img/".$filename;  
	          
	        //图片是否存在  
	        if(!file_exists($imageSourceUrl))  
	        {  
	            print 'createFail';  
	            exit();  
	        } 
			$sql="insert into  user_info set photo=".$db->quote($imageSourceUrl).",name=".$db->quote($name).",funciton=".$db->quote($funciton).",location=".$db->quote($location).",email=".$db->quote($email);
			$db->execute($sql);
			print json_encode(array("code"=>1,"msg"=>"提交成功"));
			exit;
			break;
		case 'test':
			
			break;
		default:
			# code...
			print json_encode(array("code"=>9999,"msg"=>"No Model"));
			exit;
			break;
	}
}		
print "error";
exit;
