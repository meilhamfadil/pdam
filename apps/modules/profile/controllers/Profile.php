<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['username'])){
			redirect(base_url("login"));
		}
	}
	
	public function index(){
		$page = array(
			"mtoggle" => "devices",
			"breadcrumb" => array("Profil", "Kata Kunci"),
			"js" => "profile.js",
		);
		render($page);
	}

	public function update(){
		isajax();
		$p = $this->input->post("password");
		if($p[0] == md5($p[1]) && md5($p[2]) == md5($p[3])){
			$data = array("password" => md5($p[2]));
			$_SESSION['password'] = $data['password'];
			$r = db_put("t_user", $data, $_SESSION['kode_user'], "kode_user");
		} else if ($p[0] == md5($p[1]) && md5($p[2]) != md5($p[3])) {
			$r = array("status" => "failed", "message" => "New password did not match");
		} else if ($p[0] != md5($p[1]) && md5($p[2]) == md5($p[3])) {
			$r = array("status" => "failed", "message" => "Old password incorrect");
		} else {
			$r = array("status" => "failed", "message" => "Password incorrect");
		}

		jsonify($r);
	}

}