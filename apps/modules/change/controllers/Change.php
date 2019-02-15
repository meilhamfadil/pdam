<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "change",
			"breadcrumb" => array("Pergantian Watermeter"),
			"libs" => array("datatable"),
			"js" => "pergantian.js",
			"table" => "table|No,,Nama Pelanggan,Alamat,Angka Awal,Angka Akhir,V1,V2,V3,"
		);
		render($page);
	}

	public function listData(){
		isajax();
		$kolom = "a.*";
		$where = "";
		$order = "";

		$sTable = "vpergantian";
		$aColumns = array("no","kode_pergantian","nama_pelanggan","alamat","angka_awal","angka_baru","verifikasi_pergantian","verifikasi_pemasangan","verifikasi_selesai","kode_pergantian");
		$sIndexColumn = "kode_pergantian";
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
		$where = "kode_pergantian = " . intval($kode,16);
		$detail["data"] = (Array) single()->vpergantian($where);
		block("detail", $detail);
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