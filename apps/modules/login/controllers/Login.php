<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['username'])){
			redirect(base_url());
		}
	}
	
	public function index(){
		$page = array("js" => "login.js");
		render($page, "login");
	}

	public function proccess(){
		isajax();
		$data = single()->t_user(array("username" => $this->input->post("username")));
		if($data){
			$result = ($data->password != md5($this->input->post("password"))) ?
				array("status" => "failed", "message" => "Wrong password") :
				array("status" => "success", "message" => "Success Login");
		} else {
			$result = array("status" => "failed", "message" => "Username not exist");
		}

		if($result['status'] == "success"){
			foreach($data as $index => $value){
				$_SESSION[$index] = $value;
			}
		}

		return jsonify($result);
	}

}