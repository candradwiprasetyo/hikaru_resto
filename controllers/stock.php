<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/stock_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Item Stock");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		if($_SESSION['user_type_id']==1 || $_SESSION['user_type_id']==2){
			$where_branch = "";
		}else{
			$where_branch = " where branch_id = '".$_SESSION['branch_id']."' ";
		}
		
		$query = select();
		$q_branch = select_branch($where_branch);
		$q_branch2 = select_branch($where_branch);
		
		$add_button = "stock.php?page=form";

		include '../views/stock/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "stock.php?page=list";
		
		$query_unit = select_unit();
		

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			
			$action = "stock.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->item_name = false;
			$row->unit_id = false;
			
			
			$action = "stock.php?page=save";
		}

		include '../views/stock/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);
		$i_unit_id = get_isset($i_unit_id);
		
		
		$data = "'',
					'$i_name',
					'$i_unit_id'
			";
			
			//echo $data;

			create($data);
		
			header("Location: stock.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);
		
		$id = get_isset($_GET['id']);
		
		$i_name = get_isset($i_name);
		$i_unit_id = get_isset($i_unit_id);
		
	
		
					$data = "
					item_name = '$i_name',
					unit_id = '$i_unit_id'

					";
			
			update($data, $id);
			
			header('Location: stock.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);	

		delete($id);

		header('Location: stock.php?page=list&did=3');

	break;
}

?>