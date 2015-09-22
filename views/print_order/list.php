<?php
/*
$outprint = "Just the test printer";
$printer = printer_open("58 Printer(1)");
printer_set_option($printer, PRINTER_MODE, "RAW");
printer_start_doc($printer, "Tes Printer");
printer_start_page($printer);
printer_write($printer, $outprint);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/
?>
<style type="text/css">
body{
	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
}
.frame{
	border:1px solid #000;
	width:10%;
	margin-left:auto;
	margin-right:auto;
	padding:10px;
}
table{
	font-size:12px;
	
}
.header{
	text-align:center;
	font-weight:bold;
	font-size:10px;
}
.header_img{

	width:164px;
	height:79px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:20px;
}
.back_to_order{
	width:10%;
	margin-left:auto;
	margin-right:auto;
	color:#fff;
	font-weight:bold;
	background:#09F;
	text-align:center;
	border-radius:10px;
	margin-top:10px;
	padding:5px;
	height:30px;
}
.back_to_order:hover{
	background:#069;
}
</style>
<body  onload=print()>
<!--<body>-->
<div class="header"><span style="font-size:16px;">Order <?= $row['table_name'] ?></span></div>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
   
    <td align="right" ><?= $row['transaction_date'] ?></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php
  $no_item = 1;
  $total_price = 0;
 
  while($row_item = mysql_fetch_array($query_item)){
  ?>
  <tr>
    <td><?= $row_item['menu_name'] ?></td>
    <td align="right"><?= $row_item['transaction_detail_qty'] ?></td>
  </tr>
  
  <?php
 $no_item++;
 $total_price = $total_price + $row_item['transaction_detail_total'];
  }
 ?>
</table>
<a href="<?= $back_button ?>" style="text-decoration:none"><div class="back_to_order"></div></a>
</body>