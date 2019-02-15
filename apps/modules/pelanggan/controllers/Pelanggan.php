<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "pelanggan",
			"breadcrumb" => array("Pelanggan"),
			"libs" => array("datatable"),
			"js" => "pelanggan.js",
			"table" => "table|No,,KTP,Nama,Alamat,Telepon,"
		);
		render($page);
	}

	public function listData(){
		isajax();
		$kolom = "a.*, CONCAT(a.nama_depan,' ',a.nama_belakang) as nama_lengkap";
		$where = "";
		$order = "";

		$sTable = "t_pelanggan";
		$aColumns = array("no","kode_pelanggan","ktp","nama_lengkap","alamat","telepon","kode_pelanggan");
		$sIndexColumn = "kode_pelanggan";
		$tQuery = "SELECT * FROM ("
				. "SELECT @row := @row + 1 AS no, $kolom "
				. "FROM $sTable a, (SELECT @row := 0) AS r $where $order) as tab WHERE 1=1";
		jsonify(DataTable::show($aColumns, $sIndexColumn, $sTable, $tQuery));
	}

	public function form($kode = ""){
		isajax();
		$form = array();
		$form['fields'] = fields()->t_pelanggan();
		
		if($kode != ""){
			$where = "kode_pelanggan = " . intval($kode,16);
			$form['data'] = single()->t_pelanggan($where);
		}
		block("form", $form);
	}

	public function detail(){
		isajax();
		$kode = exit_if_segment_empty(3);
		$where = "kode_pelanggan = " . intval($kode,16);
		jsonify(single()->t_pelanggan($where));
	}

	public function save(){
		isajax();
		$cid = $this->input->post("cid");
		$data = post_serialize(array("cid"));
		jsonify(db_put("t_pelanggan", $data, $cid, "kode_pelanggan"));
	}

	public function delete(){
		isajax();
		$where = "kode_pelanggan = " . intval($this->input->post("id"),16);
		jsonify(db_remove("t_pelanggan", $where));
	}

}