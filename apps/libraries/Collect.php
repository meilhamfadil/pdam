<?php

class Collect{

    private $CI;
    private $MOD;
    private $RETURN;
    private $QUERY;
    private $SELECT = "*";
    private $LIMIT = "";
    private $OFFSET = "";
    private $RULE = array("where", "group", "order");

    function __construct(){
        $this->CI = & get_instance();
        $this->CI->load->model("MOD");
        $this->MOD = $this->CI->MOD;
    }

    public function retured($r){
        $this->RETURN = $r;
        return $this;
    }

    public function select($select){
        $this->SELECT = $select;
        return $this;
    }

    public function limit($limit, $offset = ""){
        $this->LIMIT = $limit;
        if($offset != ""){
            $this->OFFSET = $offset;
        }
        return $this;
    }

    public function offset($offset){
        $this->OFFSET = $offset;
        return $this;
    }

    public function __call($func, $params){
        $this->QUERY = $this->MOD->table($func);
        for($i = 0; $i < count($params); $i++){
            $filter = $params[$i];
            $rule = $this->RULE[$i];
            $this->$rule($filter);
        }
        $this->QUERY->select($this->SELECT);
        if($this->LIMIT != ""){
            $this->QUERY->limit($this->LIMIT);
        }
        if($this->OFFSET != ""){
            $this->QUERY->offset($this->OFFSET);
        }
        $r = $this->RETURN;
        $ret = $this->QUERY->$r();
        $this->OFFSET = "";
        $this->LIMIT = "";
        $this->SELECT("*");
        return $ret;
    }

    private function where($filter){
        if($filter != NULL){
            $this->QUERY->find($filter);
        }
    }

    private function group($filter){
        if($filter != NULL){
            $this->QUERY->group($filter);
        }
    }

    private function order($filter){
        if($filter != NULL){
            if(preg_match("/\s/", $filter)){
                $f = explode(" ", $filter);
                $this->QUERY->order($f[0], $f[1]);
            } else {
                $this->QUERY->order($filter);
            }
        }
    }

}