<?php

class Calling{

    public static function indoDate($date){
        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $e = explode("-", $date);

        if($e[1] == "00"){
            return "-";
        } else {
            return $e[2] . " " . $bulan[floor($e[1])] . " " . $e[0];
        }
    }

    public static function listBulan($ke = ""){
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return ($ke == "") ? $bulan : (($ke > 12 || $ke < 1) ? "<kbd class='btn btn-sm btn-danger'>List Bulan :: Wrong Index</kbd>" : $bulan[$ke-1]);
    }

    public static function listBulanArray(){
        $bulan = [
            array("value" => "01", "display" => "Januari"),
            array("value" => "02", "display" => "Februari"),
            array("value" => "03", "display" => "Maret"),
            array("value" => "04", "display" => "April"),
            array("value" => "05", "display" => "Mei"),
            array("value" => "06", "display" => "Juni"),
            array("value" => "07", "display" => "Juli"),
            array("value" => "08", "display" => "Agustus"),
            array("value" => "09", "display" => "September"),
            array("value" => "10", "display" => "Oktober"),
            array("value" => "11", "display" => "November"),
            array("value" => "12", "display" => "Desember")
        ];
        return (object) $bulan;
    }

    public static function listHari($ke = ""){
        $hari = ["Senis", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        return ($ke == "") ? $hari : (($ke > 7 || $ke < 1) ? "<kbd class='btn btn-sm btn-danger'>List Hari :: Wrong Index</kbd>" : $hari[$ke-1]);
    }

    public static function year($from, $until){
        $data = array();
        for($a = $from; $a <= $until; $a++){
            $data[] = $a;
        }
        return $data;
    }

}