<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists("assets")){
    function assets($url){
        $base = get_instance()->config->item("assets");
        return base_url($base . "/" . $url);
    }
}

if(!function_exists("linkrel")){
    function linkrel($url, $vendors = false){
        $base = get_instance()->config->item(($vendors) ? "vendors" : "assets");
        return '<link rel="stylesheet" href="' . base_url($base . "/" . $url) . '">';
    }
}

if(!function_exists("script")){
    function script($url, $vendors = false){
        $base = get_instance()->config->item(($vendors) ? "vendors" : "assets");
        return '<script src="' . base_url($base . "/" . $url) . '"></script>';
    }
}

if(!function_exists("publik")){
    function publik(){
        $base = get_instance()->config->item("file");
        return base_url($base . "/" . $url);
    }
}

if(!function_exists("render")){
    function render($page, $template = "default"){
        get_instance()->load->view("template/" . $template, $page);
    }
}

if(!function_exists("block")){
    function block($page, $data){
        get_instance()->load->view($page, $data);
    }
}

if(!function_exists("widget")){
    function widget($widget, $data){
        get_instance()->load->view("widgets/" . $widget, $data);
    }
}

if(!function_exists("post_serialize")){
    function post_serialize($unset = array(), $implode = array()){
        $data = array();
        foreach(get_instance()->input->post() as $header => $value){
            if(in_array($header,$unset)){
                // 
            } else if(is_array($value)){
                foreach($implode as $imp){
                    if(substr($imp,1) == $header){
                        $data[$header] = implode(substr($imp,0,1), $value);
                    }
                }
            } else if(preg_match("(tgl|date|tanggal)", $header, $matches, PREG_OFFSET_CAPTURE)){
                $date = strtotime($value);
                $format = date("Y-m-d", $date);
                $data[$header] = $format;
            } else{
                $data[$header] = $value;
            }
        }
        return $data;
    }
}

if(!function_exists("libs")){
    function libs($libs, $type){
        $libraries = json_decode(APPLIB);
        if(is_array($libs)){
            foreach($libs as $lib){
                foreach($libraries->$lib as $l){
                    if(preg_match("/css$/", $l) ){
                        if($type == "css"){
                            echo linkrel($l, TRUE);
                        }
                    } else {
                        if($type == "js"){
                            echo script($l, TRUE);
                        }
                    }
                }
            }
        } else {
            foreach($libraries->$libs as $lib){
                if(preg_match("/css$/", $lib)){
                    if($type == "css"){
                        echo linkrel($lib, TRUE);
                    }
                } else {
                    if($type == "js"){
                        echo script($lib, TRUE);
                    }
                }
            }
        }
    }
}

if(!function_exists("isajax")){
    function isajax(){
        if(!IS_AJAX){
            show_404();
        }
    }
}

if(!function_exists("exit_if_segment_empty")){
    function exit_if_segment_empty($segment){
        $ci = get_instance();
        if($ci->uri->segment($segment) == ""){
            show_404();
        }
        return $ci->uri->segment($segment);
    }
}

if(!function_exists("jsonify")){
    function jsonify($data){
        echo json_encode($data);
    }
}