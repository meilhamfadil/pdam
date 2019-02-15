<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "rules",
			"breadcrumb" => array("Aturan"),
			"libs" => array("datatable"),
			"js" => "rules.js",
			"table" => "table|No, ,Nama Perangkat,Regex,Klasifikasi,Aksi"
		);
		render($page);
	}

	public function listData(){
		isajax();
		$kolom = "a.*";
		$where = "";
		$order = "";

		$sTable = "vrules";
		$aColumns = array("no", "kode_rule", "nama_device", "regex_filter", "filter_rendering", "keterangan");
		$sIndexColumn = "kode_rule";
		$tQuery = "SELECT * FROM ("
				. "SELECT @row := @row + 1 AS no, $kolom "
				. "FROM $sTable a, (SELECT @row := 0) AS r $where $order) as tab WHERE 1=1";
		jsonify(DataTable::show($aColumns, $sIndexColumn, $sTable, $tQuery));
	}

	public function form($kode = ""){
		isajax();
		$form = array();
		$form['fields'] = fields()->t_devices();
		if($kode != ""){
			$where = "kode_device = ". intval($kode,16);
			$form['data'] = single()->t_devices($where);
		}
		block("form", $form);
	}

	public function detail(){
		isajax();
		$kode = exit_if_segment_empty(3);
		$where = "kode_rule = " . intval($kode,16);
		jsonify(single()->vrules($where));
	}

	public function save(){
		isajax();
		$cid = $this->input->post("cid");
		$data = post_serialize(array("cid"));
		jsonify(db_put("t_devices", $data, $cid, "kode_device"));
	}

	public function delete(){
		isajax();
		$where = "kode_device = " . intval($this->input->post("id"),16);
		jsonify(db_remove("t_devices", $where));
	}

}