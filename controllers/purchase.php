<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/purchase_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Pembelian");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		$query = select();
		$add_button = "purchase.php?page=form";

		include '../views/purchase/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "purchase.php?page=list";
		$query_supplier = select_supplier();
		$query_unit = select_unit();

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			$row->purchase_date = format_date($row->purchase_date);
		
			$action = "purchase.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->purchase_name = false;
			$row->purchase_date = format_date(date("Y-m-d"));
			$row->unit_id = false;
			$row->purchase_price = false;
			$row->purchase_qty = false;
			$row->purchase_total = false;
			$row->supplier_id = false;
			
			$action = "purchase.php?page=save";
		}

		include '../views/purchase/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);
		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_satuan = get_isset($i_satuan);
		$i_harga = get_isset($i_harga);
		$i_qty = get_isset($i_qty);
		$i_total = get_isset($i_total);
		$i_supplier = get_isset($i_supplier);
		
		$data = "'',
					'$i_date', 
					'$i_name',
					'$i_satuan', 
					'$i_qty',
					'$i_harga',
					'$i_total',
					'$i_supplier'
			";
			
			//echo $data;

			create($data);
		
			header("Location: purchase.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_satuan = get_isset($i_satuan);
		$i_harga = get_isset($i_harga);
		$i_qty = get_isset($i_qty);
		$i_total = get_isset($i_total);
		$i_supplier = get_isset($i_supplier);
		
					$data = " purchase_date = '$i_date', 
					purchase_name = '$i_name',
					unit_id = '$i_satuan', 
					purchase_qty = '$i_qty',
					purchase_price = '$i_harga',
					purchase_total = '$i_total',
					supplier_id = '$i_supplier'

					";
			
			update($data, $id);
			
			header('Location: purchase.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: purchase.php?page=list&did=3');

	break;
}

?>