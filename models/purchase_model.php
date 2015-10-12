<?php

function select($where){
	$query = mysql_query("select a.* , b.supplier_name,c.unit_name, d.item_name, e.branch_name
							from purchases a
							join suppliers b on b.supplier_id = a.supplier_id
							join items d on d.item_id = a.item_id
							join units c on c.unit_id = d.unit_id
							join branches e on e.branch_id = a.branch_id
							$where
							order by purchase_id");
	return $query;
}

function select_supplier(){
	$query = mysql_query("select * from suppliers order by supplier_id ");
	return $query;
}

function select_item(){
	$query = mysql_query("select * from items order by item_id");
	return $query;
}

function select_branch(){
	$query = mysql_query("select * from branches order by branch_id");
	return $query;
}

function read_id($id){
	$query = mysql_query("select a.*,b.supplier_name,c.unit_name, d.stock_name
			from purchases a
			join suppliers b on b.supplier_id = a.supplier_id
			join stocks d on d.stock_id = a.stock_id
			join units c on c.unit_id = d.unit_id
			where purchase_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into purchases values(".$data.")");
}

function add_stock($item_id, $branch_id, $qty){
	$query = mysql_query("select count(item_stock_id) as result from item_stocks where item_id = '$item_id' and branch_id = '$branch_id'");
	$result = mysql_fetch_array($query);
	
	if($result['result'] > 0){
		mysql_query("update item_stocks set item_stock_qty = item_stock_qty + $qty where item_id = $item_id and branch_id = '$branch_id'");
	}else{
		mysql_query("insert into item_stocks values('', '$item_id', '$qty', '$branch_id')");
	}
}



function update($data, $id){
	mysql_query("update purchases set ".$data." where purchase_id = '$id'");
}

function delete($id){
	mysql_query("delete from purchases where purchase_id = '$id'");
}
?>