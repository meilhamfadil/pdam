<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod extends CI_Model{

    public function table($table){
        $this->db->from($table);
        return $this;
    }

    public function find($where){
        $this->db->where($where);
        return $this;
    }

    public function group($group){
        $this->db->group_by($group);
        return $this;
    }

    public function order($order, $type = "ASC"){
        $this->db->order_by($order, $type);
        return $this;
    }

    public function select($select){
        $this->db->select($select);
        return $this;
    }

    public function limit($limit, $offset = ""){
        $this->db->limit($limit);
        if($offset != ""){
            $this->db->offset($offset);
        }
        return $this;
    }

    public function offset($offset){
        $this->db->offset($offset);
        return $this;
    }

    public function show(){
        echo"<pre>";
        echo $this->db->get_compiled_select();
        echo"</pre>";
        die();
    }

    public function insert($table, $data){
        $this->db->trans_start();
        $this->db->insert($table, $data);        
        $this->db->trans_complete();
        return $this->db;
    }

    public function update($table, $data, $where){
        $this->db->trans_start();
        $this->db->where($where)->update($table, $data);
        $this->db->trans_complete();
        return $this->db;
    }

    public function delete($table, $where){
        $this->db->trans_start();
        $this->db->where($where)->delete($table);
        $this->db->trans_complete();
        return $this->db;
    }

    public function __call($func, $param){
        $fetch = array("row", "result", "result_array", "num_rows", "list_fields");
        if($func == "fields"){ $func = "list_fields"; }
        if($func == "array"){ $func = "result_array"; }
        if($func == "count"){ $func = "num_rows"; }
        if(in_array($func, $fetch)){
            $query = $this->db->get();
            if(is_object($query)){
                return $query->$func();
            } else {
                exit(show_error($query->error()));
            }
        } else {
            exit(show_error("Error while fetching, there is no fetching " . $func));
        }
    }

}
