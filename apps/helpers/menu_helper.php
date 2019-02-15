<?php

if(!function_exists("getParentMenu")){
    
    function getParentMenu($role){
        return collect()->vmenu(array("status" => 1, "role" => $role, "induk" => 0), null, "urutan");
    }

}

if(!function_exists("getChildMenu")){
    
    function getChildMenu($role, $parent){
        return collect()->vmenu(array("status" => 1, "role" => $role, "induk" => $parent), null, "urutan");
    }

}