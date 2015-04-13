<?php


header("Content-Type:text/html;charset=utf-8");
session_start(); // Starting Session

// Define $name and $password
$name=$_GET['uname'];
$password=$_GET['upassword'];

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "samesame111");

// To protect MySQL injection for Security purpose
$name = stripslashes($name);
$password = stripslashes($password);
$name = mysql_real_escape_string($name);
$password = mysql_real_escape_string($password);

// Selecting Database
$db = mysql_select_db("samesame", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from member where Password='$password' AND LoginName='$name'", $connection);
$rows = mysql_num_rows($query);

/* json */
$json ="";
$data =array(); 
class Member 
{
public $success;
}
$Member = new Member();


if ($rows == 1) {
	$_SESSION['login_user']=$name; // Initializing Session
	$Member->success = 1;
	//header("location: report.php"); // Redirecting To Other Page
} else {
	$Member->success = 0;
}


$data[]=$Member;
$json = json_encode($data);
echo "{".'"Member"'.":".$json."}";
mysql_close($connection); // Closing Connection

?>