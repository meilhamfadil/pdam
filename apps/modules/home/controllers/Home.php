<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "home",
			"breadcrumb" => array("Dashboard"),
			"libs" => array("datatable"),
			"js" => "home.js",
			"table" => "table|No,Nama,Alamat,Telepon,"
		);
		render($page);
	}

	public function listData(){
		isajax();
		$kolom = "a.*, CONCAT(a.nama_depan,' ',a.nama_belakang) as nama_lengkap";
		$where = "";
		$order = "";

		$sTable = "t_pelanggan";
		$aColumns = array("no","kode_pelanggan", "nama_lengkap","alamat","telepon","kode_pelanggan");
		$sIndexColumn = "kode_pelanggan";
		$tQuery = "SELECT * FROM ("
				. "SELECT @row := @row + 1 AS no, $kolom "
				. "FROM $sTable a, (SELECT @row := 0) AS r $where $order) as tab WHERE 1=1";
		jsonify(DataTable::show($aColumns, $sIndexColumn, $sTable, $tQuery));
	}

	public function detail(){
		isajax();
		$kode = exit_if_segment_empty(3);
		$where = "kode_pelanggan = " . intval($kode,16);
		jsonify(single()->t_pelanggan($where));
	}

	public function logout(){
		session_destroy();
		redirect(base_url());
	}

}