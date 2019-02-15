<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watermeter extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "pelanggan",
			"breadcrumb" => array("Watermeter"),
			"libs" => array("datatable"),
			"js" => "watermeter.js",
			"table" => "table|ID,,Nickname,Name,"
		);
		render($page);
	}

	public function listData(){
		isajax();
		$kolom = "a.*";
		$where = "";
		$order = "";

		$sTable = "t_watermeter";
		$aColumns = array("kode_watermeter","kode_watermeter","nickname","name");
		$sIndexColumn = "kode_watermeter";
		$tQuery = "SELECT * FROM ("
				. "SELECT @row := @row + 1 AS no, $kolom "
				. "FROM $sTable a, (SELECT @row := 0) AS r $where $order) as tab WHERE 1=1";
		jsonify(DataTable::show($aColumns, $sIndexColumn, $sTable, $tQuery));
	}

	public function form($kode = ""){
		isajax();
		$form = array();
		$form['fields'] = fields()->t_watermeter();
		
		if($kode != ""){
			$where = "kode_watermeter = " . intval($kode,16);
			$form['data'] = single()->t_watermeter($where);
		}
		block("form", $form);
	}

	public function detail(){
		isajax();
		$kode = exit_if_segment_empty(3);
		$where = "kode_watermeter = " . intval($kode,16);
		jsonify(single()->t_watermeter($where));
	}

	public function save(){
		isajax();
		$cid = $this->input->post("cid");
		$data = post_serialize(array("cid"));
		jsonify(db_put("t_watermeter", $data, $cid, "kode_watermeter"));
	}

	public function delete(){
		isajax();
		$where = "kode_watermeter = " . intval($this->input->post("id"),16);
		jsonify(db_remove("t_watermeter", $where));
	}

}