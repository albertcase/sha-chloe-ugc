<?php
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/Pager.class.php');
$db = Pdb::getDb();
$rowcount = $db->getOne("SELECT count(*) as num FROM user_info");

$nowindex = 1;
if(isset($_GET['page'])){
    $nowindex = $_GET['page'];
}else if(isset($_GET["PB_Page_Select"])){
	$nowindex = $_GET["PB_Page_Select"];
}
$page = new Pager(array("nowindex" => $nowindex, "total" => $rowcount, "perpage" => 30, "style" => "page_break"));
$sql = "SELECT * FROM user_info  ORDER BY id DESC LIMIT $page->offset,30";
$rs = $db->getAll($sql,true);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="center">

<table>
<tr>
<td align='left'><?php echo $rowcount;?>条数据</td>
<td><?php echo $page->show(2);?></td>
</tr>
</table>
</div>
<form action='' method='post'>
<table border='1' width='100%'>
<tr>
<td width='50' align='center'>id</td>
<td width='50' align='center'>photo</td>
<td width='100' align='center'>name</td>
<td width='80' align='center'>function</td>
<td width='300' align='center'>location</td>
<td width='50' align='center'>email</td>
<td width='50' align='center'>createtime</td>
</tr>
<?php
	for($i = 0; $i < count($rs); $i++)
	{
?>
	   <tr>
          <td align='center'><?php echo $rs[$i]['id']; ?></td>
          <td align='center'><img height="200px" src="<?php echo $rs[$i]['photo']; ?>"></td>
          <td align='center'><?php echo $rs[$i]['name']; ?></td>
          <td align='center'><?php echo $rs[$i]['function']; ?></td>
          <td align='center'><?php echo $rs[$i]['location']; ?></td>
          <td align='center'><?php echo $rs[$i]['email']; ?></td>
          <td align='center'><?php echo $rs[$i]['createtime']; ?></td>
	   </tr>	
<?php
	    
	}
?>
</table></form>
    
