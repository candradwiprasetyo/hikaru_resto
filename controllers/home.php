<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/home_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Home");

switch ($page) {
	case 'list':
		get_header($title);

		$jumlah_penjualan = get_jumlah_penjualan(date("Y-m-d"));
		$total_omset = number_format(get_total_omset(date("Y-m-d")), "0", ".", ".");
		$date_now = format_date(date("Y-m-d"));
		$menu_terlaris = get_menu_terlaris(date("Y-m-d"));

		include '../views/layout/home.php';
		get_footer();
	break;
	
}

?>