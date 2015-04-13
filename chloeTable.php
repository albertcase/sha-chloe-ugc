<?php
include './config/database.php';
include_once('./config/Pdb.php');
include './config/Pager.class.php';
$db = Pdb::getDb();
$rowcount=$db->getOne("SELECT count(*) as num FROM user_info");
//$rowcount=$db->getOne("SELECT count(id) as num FROM trio_weiboMsg");

$nowindex=1;
if(isset($_GET['page'])){
   $nowindex=$_GET['page'];
}else if(isset($_GET["PB_Page_Select"])){
	$nowindex=$_GET["PB_Page_Select"];
}
$page=new Pager(array("nowindex"=>$nowindex,"total"=>$rowcount,"perpage"=>30,"style"=>"page_break"));
$sql="SELECT * FROM user_info  ORDER BY id DESC LIMIT $page->offset,30";
$rs=$db->getAll($sql,true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>Chloe</title>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="css/shCore.css">
	<link rel="stylesheet" type="text/css" href="css/demo.css">
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				"render": function ( data, type, row ) {
					return data;
				},
				"targets": 0
			},
			{ "visible": true,  "targets": [ 3 ] }
		]
	} );
} );


	</script>
</head>

<body class="dt-example">
	<div class="container">
		<section>
			
            <h1 style="margin-bottom:50px; text-align:center">Chloé Database</h1>
			<table id="example" class="display" cellspacing="0" width="100%" >
				<thead>
					<tr>
						<th>ID</th>
						<th>PHOTO</th>
						<th>DOWNLOAD</th>
						<th>NAME</th>
						<th>FUNCTION</th>
						<th>LOCATION</th>
						<th>EMAIL</th>
						<th>CREATE-AT</th>
					</tr>
				</thead>
                

				<tbody>
					<?php
					for($i=0;$i<count($rs);$i++){
					?>
					<tr>
						<td align="center"><?php echo $rs[$i]['id']; ?></td>
						<td align="center"><img height="200px" src="<?php echo $rs[$i]['photo']; ?>"></td>
						<td align="center"><a href="/download.php?img=<?php echo $rs[$i]['photo']; ?>" target="_blank">CLICK IT</a></td>szzzzz
						<td align="center"><?php echo $rs[$i]['name']; ?></td>
						<td align="center"><?php echo $rs[$i]['function']; ?></td>
						<td align="center"><?php echo $rs[$i]['location']; ?></td>
						<td align="center"><?php echo $rs[$i]['email']; ?></td>
						<td align="center"><?php echo $rs[$i]['createtime']; ?></td>
					</tr>


					<?php	    
					}
					?>

					
				</tbody>
			</table>

			
			</div>
		</section>
	</div>

	
</body>
</html>