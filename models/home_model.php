<?php

function get_jumlah_penjualan($date){
	$query = mysql_query("SELECT count(transaction_id) as jumlah 
							from transactions 
							WHERE  transaction_date >= '$date 00:00:00'
							AND transaction_date <= '$date 23:59:59'
							 ");
	$result = mysql_fetch_object($query);
	return $result->jumlah;
}

function get_total_omset($date){
	$query = mysql_query("SELECT sum(transaction_total) as jumlah 
							from transactions 
							WHERE  transaction_date >= '$date 00:00:00'
							AND transaction_date <= '$date 23:59:59'
							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['jumlah']) ? $result['jumlah'] : "0"; 
	return $result;
}
function get_menu_terlaris($date){
	$query = mysql_query("SELECT a.menu_id, a.menu_price, a.menu_name, jumlah
								FROM menus a
								JOIN (
								
									SELECT sum( transaction_detail_qty ) AS jumlah, menu_id
									FROM transaction_details a
									JOIN transactions b on b.transaction_id = a.transaction_id
									WHERE  b.transaction_date >= '$date 00:00:00'
									AND b.transaction_date <= '$date 23:59:59'
									GROUP BY menu_id
								) AS b ON b.menu_id = a.menu_id
								order by jumlah desc, menu_id asc
								limit 1
								
							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['menu_name']) ? $result['menu_name'] : "-"; 
	return $result;
}

?>