<?php

function select(){
	$query = mysql_query("select a.* , b.supplier_name,c.unit_name
							from purchases a
							join suppliers b on b.supplier_id = a.supplier_id
							join units c on c.unit_id = a.unit_id
							order by purchase_id");
	return $query;
}

function select_supplier(){
	$query = mysql_query("select * from suppliers order by supplier_id ");
	return $query;
}

function select_unit(){
	$query = mysql_query("select * from units");
	return $query;
}
function read_id($id){
	$query = mysql_query("select a.*,b.supplier_name,c.unit_name
			from purchases a
			join suppliers b on b.supplier_id = a.supplier_id
			join units c on c.unit_id = a.unit_id
			where purchase_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into purchases values(".$data.")");
}

function update($data, $id){
	mysql_query("update purchases set ".$data." where purchase_id = '$id'");
}

function delete($id){
	mysql_query("delete from purchases where purchase_id = '$id'");
}
?>