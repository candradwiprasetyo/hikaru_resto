<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/transaction_new_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("transaction_new");

$_SESSION['menu_active'] = 3;

switch ($page) {
	case 'list':
		get_header($title);
		
		$date = format_date(date("Y-m-d"));
		if(isset($_GET['date'])){
			$date = format_date($_GET['date']);
		}
		$table_id = "";
		if(isset($_GET['table_id'])){
			$table_id = $_GET['table_id'];
			$query_history = select_history($table_id);
			
		}
		
		if($table_id == ""){
			$check_table = 0;
		}else{
			$check_table = check_table($table_id);
		}

		if(isset($_GET['mt_id'])){
			$param = $_GET['mt_id'];
		}else{
			$param = '';
		}

		$query_cat = select_cat($param);
		$query = select($param);
		$query2 = select($param);
		$query_find = select($param);
		$action = "transaction_new.php?page=save";
		

		include '../views/transaction_new/list.php';
		get_footer($query_find);
	break;

	case 'note':
		$title = ucfirst("Global Note");
		get_header($title);

		$table_id = get_isset($_GET['table_id']);	
		$wt_id = get_isset($_GET['wt_id']);	
		$menu_name = get_menu_name_widget($wt_id);
		$jumlah = get_jumlah_widget($wt_id);

		$get_note_desc = get_note_desc($wt_id);
		
		$action = "transaction_new.php?page=save_note&wt_id=$wt_id&table_id=$table_id";
		$close_button = "transaction_new.php?page=list&table_id=$table_id";

		include '../views/transaction_new/note.php';
		get_footer();
	break;
	
	

	case 'save':
		
		extract($_POST);

		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_jam = date("H:i:s");
		$i_table_id = get_isset($i_table_id);
		$i_tot_id = get_isset($i_tot_id);
		$tanggal = $i_date." ".$i_jam;
		
		$i_total_harga = get_isset($i_total_harga);
		//echo $i_date."-".$i_table_id."-".$i_tot_id."-".$tanggal;
		//echo $i_total_harga;
		
		if($i_total_harga > 0){
			
			$check_table = check_table($i_table_id);
			
			
			if($check_table > 0){
				$transaction_id = get_transaction_id_old($i_table_id);
			}else{
				$data = "'',
					'$i_table_id',
					'0',
					'$tanggal',
					'$i_tot_id',
					'".$_SESSION['user_id']."',
					'".time()."'
						";
			
			create_config("transactions_tmp", $data);
				$transaction_id = mysql_insert_id();
			}
			
			update_config("tables", "table_status_id = 2", "table_id", $i_table_id);
			delete_reserved($i_table_id);
			delete_config("transaction_tmp_details", "transaction_id = '$transaction_id'");
					
			$query = select_widget($_SESSION['user_id'], $i_table_id);
			while($row = mysql_fetch_array($query)){
				
				$jumlah = $row['jumlah'];
				
				$menu_price = get_menu_price($row['menu_id']);
				$total = $jumlah * $menu_price;
				
			
					
						$data_detail = "'',
									'$transaction_id',
									'".$row['menu_id']."',
									'".$menu_price."',
									'0',
									'".$menu_price."',
									'0',
									'".$menu_price."',
									'$jumlah',
									'$total',
									'0'
									";
						create_config("transaction_tmp_details", $data_detail);
					
				}
				
				
				
			
			if($i_tot_id == 1){
				header("Location: order.php");
			}else{
				header("Location: payment.php?table_id=0");
			}
			
			//header("Location: transaction_new.php?page=list&table_id=$i_table_id");
		}else{
			header("Location: transaction_new.php?page=list&err=1&table_id=$i_table_id");
		}
		
	break;

	case 'create_note':
	
		extract($_POST);

		$i_desc = get_isset($_POST['i_desc']);
		$i_qty = get_isset($_POST['i_qty_popmodal']);
		
		$table_id = get_isset($_GET['table_id']);
		$menu_id = get_isset($_POST['i_menu_id_popmodal']);
		
		$data = "'',
				'".$_SESSION['user_id']."',
				'$menu_id',
				'$i_qty',
				'$table_id',
				'$i_desc'
				";
		$wt_id = create_config("widget_tmp", $data);
		
		$query_note_category = mysql_query("select * from note_categories order by note_category_id");
        while($row_note_category = mysql_fetch_array($query_note_category)){

        	if(isset($_POST['i_note_'.$row_note_category['note_category_id']])){

        		//echo $_POST['i_note_'.$row_note_category['note_category_id']]."<br>";
        		$data_detail = "'',
									'$wt_id',
									'".$_POST['i_note_'.$row_note_category['note_category_id']]."'
									";
				create_config("widget_tmp_details", $data_detail);
					
				}
        	}

        			
		header("Location: transaction_new.php?page=list&table_id=$table_id");
		
	
	break;

	case 'save_note':
	
	
		//extract($_POST);

		$i_desc = get_isset($_POST['i_desc']);
		$i_qty = get_isset($_POST['i_qty']);
		$wt_id = get_isset($_GET['wt_id']);
		$table_id = get_isset($_GET['table_id']);
		
		// delete widget_tmp_details
		delete_config("widget_tmp_details", "wt_id = '$wt_id'");
		
		$query_note_category = mysql_query("select * from note_categories order by note_category_id");
        while($row_note_category = mysql_fetch_array($query_note_category)){

        	if(isset($_POST['i_note_'.$row_note_category['note_category_id']])){

        		//echo $_POST['i_note_'.$row_note_category['note_category_id']]."<br>";
        		$data_detail = "'',
									'$wt_id',
									'".$_POST['i_note_'.$row_note_category['note_category_id']]."'
									";
						create_config("widget_tmp_details", $data_detail);
					
				}
        	}

        // update desc
        $data_desc = "jumlah = '$i_qty', wt_desc = '$i_desc'
									";
        update_config2("widget_tmp", $data_desc, "wt_id=$wt_id");
					
		header("Location: transaction_new.php?page=list&table_id=$table_id");
		
	
	break;

	case 'get_menu':
		
		$keyword = $_GET['keyword'];
		
		$data['menu_id'] = select_menu($keyword);
		
		return $data;
		
		
		break;
		
	case 'delete_history':

		$id = get_isset($_GET['id']);	
		$table_id = get_isset($_GET['table_id']);	
		
		
		
		delete_history($id);

		header("Location: transaction_new.php?table_id=$table_id&did=3");

	break;
	
	case 'list_history':
		//get_header($title);
		$table_id = get_isset($_GET['table_id']);
		
		$check_table = check_table($table_id);
		if($check_table > 0){
			$query_history = select_history($table_id);
			include '../views/transaction_new/history_order.php';
		}
		//get_footer();
	break;

	case 'form_widget':

		$menu_id = $_GET['menu_id'];
		$jumlah = $_GET['jumlah'];
		$table_id = $_GET['table_id'];

		
		$get_widget = get_widget($menu_id, $table_id);

		if($jumlah == 0){

			delete_config("widget_tmp", "menu_id = '$menu_id' and user_id = '".$_SESSION['user_id']."' and table_id = '$table_id'");

		}else{

			if($get_widget==0){

				$data = "'',
						'".$_SESSION['user_id']."',
						'$menu_id',
						'$jumlah',
						'$table_id',
						''
							";
				
				create_config("widget_tmp", $data);

			}else{

				$data = "jumlah = '$jumlah'
										";
				update_config2("widget_tmp", $data, "menu_id = '$menu_id' and user_id = '".$_SESSION['user_id']."' and table_id = '$table_id'");
						

			}

		}

		include '../views/transaction_new/widget.php';
		
	break;

	case 'popmodal':
	
		$menu_id = $_GET['menu_id'];
		
		$menu_name = get_menu_name($menu_id);

		include '../views/transaction_new/popmodal.php';
		
	break;

	
	case 'delete_widget':

		$id = get_isset($_GET['id']);	
		$table_id = get_isset($_GET['table_id']);
		
		delete_config("widget_tmp", "wt_id = '$id'");
		delete_config("widget_tmp_details", "wt_id = '$id'");

		header("Location: transaction_new.php?table_id=$table_id&did=3");

	break;

	case 'delete_note':

		$id = get_isset($_GET['id']);	
		$table_id = get_isset($_GET['table_id']);
		$wt_id = get_isset($_GET['wt_id']);
		
		delete_config("widget_tmp_details", "wtd_id = '$id'");

		header("Location: transaction_new.php?page=note&table_id=$table_id&wt_id=$wt_id");

	break;

	case 'reset':

		$table_id = get_isset($_GET['table_id']);

		// hapus transaction_tmp_details
		
		$q_detail = mysql_query("select * from transactions_tmp where table_id = '$table_id' and user_id = '".$_SESSION['user_id']."'");
		while($r_detail = mysql_fetch_array($q_detail)){
			delete_config("transaction_tmp_details", "transaction_id = '".$r_detail['transaction_id']."'");
		}
		
		delete_config("transactions_tmp", "table_id = '$table_id'");

		// hapus widget_tmp_details
		$q_widget_detail = mysql_query("select * from widget_tmp where table_id = '$table_id' and user_id = '".$_SESSION['user_id']."'");
		while($r_widget_detail = mysql_fetch_array($q_widget_detail)){
			delete_config("widget_tmp_details", "wt_id = '".$r_widget_detail['wt_id']."'");
		}

		delete_config("widget_tmp", "table_id = '$table_id'");


		mysql_query("update tables set table_status_id = '1' where table_id = '$table_id'");
		

		header("Location: transaction_new.php?page=list&table_id=$table_id");
		

	break;

	case 'close':

		$table_id = get_isset($_GET['table_id']);

		$building_id = get_building_id($table_id);
		

		header("Location: order.php?bulding_id=$building_id");
		

	break;
	
}

?>