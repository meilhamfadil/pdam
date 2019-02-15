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

		function pelanggan_put() {
			$datatoupdate["kode_pergantian"] = $this->post("kode_pergantian");
			$datatoupdate["watermeter_awal"] = $this->post("kode_pergantian");
			$datatoupdate["watermeter_baru"] = $this->post("kode_pergantian");
			$datatoupdate["angka_awal"] = $this->post("kode_pergantian");
			$datatoupdate["angka_baru"] = $this->post("kode_pergantian");
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
		
        function pelanggan_post($table = '') {
            $insert = $this->db->insert($table, $this->post());
            $id = $this->db->insert_id();
            if ($insert) {
                $response = array(
                    'data' => $this->post(),
                    'table' => $table,
                    'id' => $id,
                    'status' => 'success'
                    );
				$this->format($data);
            } else {
                $this->format(null, 502, "failed");
            }
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