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
			"table" => "table|No,Event,Info,Detail,User,Time,Action",
			"files" => collect()->t_devices()
		);
		render($page);
	}

	public function listData($kode_device){
		isajax();
		$kolom = "a.*";
		$where = "WHERE kode_rule is not null AND kode_device = '$kode_device'";
		$order = "";

		$sTable = "vdata";
		$aColumns = array("no","kode_data","data_value","regex_filter","filter_rendering");
		$sIndexColumn = "kode_data";
		$tQuery = "SELECT * FROM ("
				. "SELECT @row := @row + 1 AS no, $kolom "
				. "FROM $sTable a, (SELECT @row := 0) AS r $where $order) as tab WHERE 1=1";
		jsonify(DataTable::show($aColumns, $sIndexColumn, $sTable, $tQuery));
	}

	public function detail(){
		isajax();
		$kode = exit_if_segment_empty(3);
		$where = "kode_data = " . intval($kode,16);
		jsonify(single()->vdata($where));
	}

	public function logout(){
		session_destroy();
		redirect(base_url());
	}

}