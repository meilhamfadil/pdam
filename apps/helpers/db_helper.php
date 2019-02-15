<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists("single")){
    function single($lisel = "", $liof = "", $of = ""){
        $db = get_instance()->collect->retured("row");
        return db_case($db, $lisel, $liof, $of);
    }
}

if(!function_exists("fields")){
    function fields($lisel = ""){
        $db = get_instance()->collect->retured("fields");
        return db_case($db, $lisel, "", "");
    }
}

if(!function_exists("collect")){
    function collect($lisel = "", $liof = "", $of = ""){
        $db = get_instance()->collect->retured("result");
        return db_case($db, $lisel, $liof, $of);
    }
}

if(!function_exists("db_put")){
    function db_put($table, $data, $cid, $index){
        $CI = get_instance();
        $CI->load->model("MOD");
        
        $process = array();
        if($cid != ""){
            $process = $CI->MOD->update($table, $data, array($index => $cid));
        } else {
            $process = $CI->MOD->insert($table, $data);
        }
                
        if($process->trans_status()){
            return array("status" => "Success", "message" => "Data Berhasil Disimpan");
        } else {
            return array("status" => "Failed", "message" => "Data Gagal Disimpan");
        }
    }

}

if(!function_exists("db_remove")){
    function db_remove($table, $where){
        $CI = get_instance();
        $CI->load->model("MOD");
        $delete = $CI->MOD->delete($table, $where);
        if($delete->trans_status() > 0){
            return array("status" => "Success", "message" => "Hapus Data Sukses");
        } else {
            return array("status" => "Failed", "message" => "Hapus Data Gagal");
        }
    }
}


if(!function_exists("db_case")){
    function db_case($db, $lisel, $liof, $of){
        if(is_array($lisel) && is_int($liof) && is_int($of)){
            $db->select($lisel)->limit($liof, $of);
        } else if (is_array($lisel) && is_int($liof)) {
            $db->select($lisel)->limit($liof);
        } else if (is_int($lisel) && is_int($liof)) {
            $db->limit($lisel, $liof);
        } else if(is_array($lisel) && $liof == "" && $of == ""){
            $db->select($lisel);
        } else if(is_int($lisel)){
            $db->limit($lisel);
        }
        return $db;
    }
}