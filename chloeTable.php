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
$page = new Pager(array("nowindex" => $nowindex, "total" => $rowcount, "perpage" => 5, "style" => "page_break"));
$sql = "SELECT * FROM user_info  ORDER BY id DESC LIMIT $page->offset,5";
$rs = $db->getAll($sql,true);
?>
<html><head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

  <title>Chloe</title>
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/shCore.css">
  <link rel="stylesheet" type="text/css" href="css/demo.css">
  <script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
</head>

<body class="dt-example">
  <div class="container">
    <section>
      
              <h1 style="margin-bottom:50px; text-align:center">Chloé Database</h1>
        <center><?php echo $page->show(5);?></center> 
      <!-- <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
      <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="example"></label></div> -->
      <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
        <thead>
          <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="PHOTO: activate to sort column descending" style="width: 199px;">PHOTO</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="DOWNLOAD: activate to sort column ascending" style="width: 93px;">DOWNLOAD</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="NAME: activate to sort column ascending" style="width: 47px;">NAME</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="FUNCTION: activate to sort column ascending" style="width: 81px;">FUNCTION</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="LOCATION: activate to sort column ascending" style="width: 82px;">LOCATION</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="EMAIL: activate to sort column ascending" style="width: 96px;">EMAIL</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CREATE-AT: activate to sort column ascending" style="width: 130px;">CREATE-AT</th></tr>
        </thead>

        <tbody>
                    
          <?php
          for($i=0;$i<count($rs);$i++){
          ?>
          <tr  role="row" class="<?php if($i%2==0) echo 'even'; else echo 'odd';?>">
            <td align="center"><img height="150px" src="<?php echo $rs[$i]['photo']; ?>"></td>
            <td align="center"><a href="/download.php?img=<?php echo $rs[$i]['photo']; ?>" target="_blank">CLICK IT</a></td>
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
      <!--<div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div>
      <div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous">Previous</a><span><a class="paginate_button current" aria-controls="example" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="example" data-dt-idx="2" tabindex="0" id="example_next">Next</a></div>
      </div>-->     
    </section>
  </div>

  

</body></html>