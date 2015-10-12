<div class="table_total_item" style="margin-bottom:10px; margin-top:10px; text-align:center;">

<?php

$q_t = mysql_query("select table_name from tables where table_id = '".$row['table_id']."'");
$r_t = mysql_fetch_array($q_t);
echo "No Meja : ".$r_t['table_name'];
$q_c_t = mysql_query("select b.table_name 
						from table_mergers a 
						join tables b on b.table_id = a.table_id
						where table_parent_id = '".$row['table_id']."'");


$i = 1;
$merged = "";
while($r_c_t = mysql_fetch_array($q_c_t)){
	if($i == 1){
		if($r_c_t['table_name']){ echo " ("; }
	}
	$merged .= $r_c_t['table_name'].",";
$i++;
}

echo substr($merged,0, -1);

if($i > 1){ echo ")"; }
?>
</div>
<span class="tooltip-text">
<?php
$query_res = mysql_query("select * from reserved where table_id = '".$row['table_id']."'");
$row_res = mysql_fetch_array($query_res);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td><?= $row_res['name'] ?></td>
    <td>&nbsp;</td>
    <td>Alamat</td>
    <td>:</td>
    <td><?= $row_res['address'] ?></td>
  </tr>
  <tr>
    <td>Telepon</td>
    <td>:</td>
    <td><?= $row_res['phone'] ?></td>
    <td>&nbsp;</td>
    <td>Tanggal / Jam</td>
    <td>:</td>
    <td><?= format_date($row_res['date'])." (".$row_res['hour'].")" ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<div class="row">
<div class="form-group">
<div class="col-xs-6" style="padding:0px;"><a href="transaction.php?table_id=<?= $row['table_id']?>" style="text-decoration:none;"><div class="btn_add_order">PROCESS RESERVED</div></a>
</div>

<div class="col-xs-6" style="padding:0px;">
<a href="#" onclick="javascript: cancel_reserved(<?= $row['table_id']?>)" style="text-decoration:none;"><div class="btn_merger">CANCEL RESERVED</div></a>
</div>
</div>
</div>

   
   
</span>
