<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
       
    require APPPATH . 'controllers/Rest.php';
    class Api extends Rest {

        function __construct($config = 'rest') {
            parent::__construct($config);
            $this->load->database();
            $this->cektoken();
        }

        function pelanggan_get($id = "") {
			$data = collect()->v_pelanggan(($id == '') ? null : array("kode_pelanggan" => $id));
			$this->format($data);
		}

		function pelanggan_post() {
			$config['upload_path'] = DOCPATH . 'dokumentasi';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 1000;
			$this->load->library('upload', $config);

			$foto = array();
			$no = 0;
			foreach($_FILES["images"]["name"] as $image){
				$_FILES['file']['name'] = $_FILES['images']['name'][$no];
				$_FILES['file']['type'] = $_FILES['images']['type'][$no];
				$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$no];
				$_FILES['file']['error'] = $_FILES['images']['error'][$no];
				$_FILES['file']['size'] = $_FILES['images']['size'][$no];
				$fileName = date("YmdHis") . ".jpg";
				$foto[] = $fileName;
				$config['file_name'] = $fileName;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$this->upload->data();
				} else {
					return false;
				}
				$no++;
			}
			
			$datatoupdate["kode_pergantian"] = $this->post("kode_pergantian");
			$datatoupdate["watermeter_awal"] = $this->post("watermeter_awal");
			$datatoupdate["watermeter_baru"] = $this->post("watermeter_baru");
			$datatoupdate["angka_awal"] = $this->post("angka_awal");
			$datatoupdate["angka_baru"] = $this->post("angka_baru");
			$datatoupdate["foto_awal"] = "dokumentasi/" . $foto[0];
			$datatoupdate["foto_baru"] = "dokumentasi/" . $foto[1];
			db_put("t_meter_change", $datatoupdate, $this->post("kode_pergantian"), "kode_pergantian");
			$this->format(collect()->vpergantian(array("kode_pergantian" => $this->post("kode_pergantian"))));
		}
		
		function verifikasi_post() {
			switch($this->post("verifikasi")){
				case 1 :
					$datatoupdate["verifikasi_pergantian"] = 1;
					break;
				case 2 :
					$datatoupdate["verifikasi_pemasangan"] = 1;
					break;
				case 3 :
					$datatoupdate["verifikasi_selesai"] = 1;
					break;
				default:
					break;
			}
			
			$datatoupdate["kode_pergantian"] = $this->post("kode_pergantian");
			db_put("t_meter_change", $datatoupdate, $this->post("kode_pergantian"), "kode_pergantian");
			$this->format(collect()->vpergantian(array("kode_pergantian" => $this->post("kode_pergantian"))));
		}
		
		private function format($data, $code = 200, $message = "success"){
			$this->response(array(
				'code' => $code,
				'status' => $message, 
				'data' => $data
			), $code);
		}
    }
    ?>