<?php

class Datatable{

    private $aColumns;
    private $sIndexColumn;
    private $sTable;
    private $tQuery;

    public function __construct($aColumns, $sIndexColumn, $sTable, $tQuery){
        $this->aColumns = $aColumns;
        $this->sIndexColumn = $sIndexColumn;
        $this->sTable = $sTable;
        $this->tQuery = $tQuery;
    }

    public static function show($aColumns, $sIndexColumn, $sTable, $tQuery){
        $CI = & get_instance();
        $dataTable = new Datatable($aColumns, $sIndexColumn, $sTable, $tQuery);
        return ($CI->input->post("sEcho") != "") ? $dataTable->legacy() : $dataTable->present();
    }

    public function legacy(){
        $CI = & get_instance();
        $aColumns = $this->aColumns;
        $sIndexColumn = $this->sIndexColumn;
        $sTable = $this->sTable;
        $tQuery = $this->tQuery;
        $sLimit = "";

        $xDisplayStart = $CI->input->post('iSortCol_0');
        $xDisplayLength = $CI->input->post('iSortingCols');
        if (($xDisplayStart != '') && $xDisplayLength != '-1') {
            $sLimit = ($xDisplayStart == 0) ? $xDisplayLength : (($xDisplayStart) + 10);
        }

        $xOrder = $CI->input->post('iSortCol_0');
        $xSortingCols = $CI->input->post('iSortingCols');
        if (isset($xOrder)) {
            $sOrder0 = "ORDER BY  ";
            for ($i = 0; $i < intval($xSortingCols); $i++) {
                $xSortCol = $CI->input->post('iSortCol_' . $i);
                $xSortDir = $CI->input->post('sSortDir_' . $i);
                $xSortable = $CI->input->post('bSortable_' . intval($xSortCol));
                if ($xSortable == "true") {
                    $sOrder0 .= $aColumns[intval($xSortCol)] . " " . $xSortDir . ", ";
                }
            }
            $sOrder = substr_replace($sOrder0, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        $sWhere = "";
        $xSearch = ($CI->input->get('sSearch') != "") ? $CI->input->get('sSearch') : (($CI->input->post('sSearch')) ? $CI->input->post('sSearch') : '' );
        if ($xSearch != "") {
            $sWhere0 = "AND ("; //"WHERE (";
            for ($i = 0; $i < (count($aColumns) - 1); $i++) {
                $sWhere0 .= $aColumns[$i] . " LIKE '%" . $xSearch . "%' OR ";
            }
            $sWhere = substr_replace($sWhere0, "", -3);
            $sWhere .= ')';
        }
        for ($i = 0; $i < (count($aColumns) - 1); $i++) {
            $xSearchable = ($CI->input->get('bSearchable_' . $i) != "") ? $CI->input->get('bSearchable_' . $i) : (($CI->input->post('bSearchable_' . $i)) ? $CI->input->post('bSearchable_' . $i) : '' );
            $xSearch = ($CI->input->get('sSearch_' . $i) != "") ? $CI->input->get('sSearch_' . $i) : (($CI->input->post('sSearch_' . $i)) ? $CI->input->post('sSearch_' . $i) : '' );
            if ($xSearchable == "true" && $xSearch != '') {
                if ($sWhere === "") : $sWhere = "AND ";
                else : $sWhere .= " AND ";
                endif;
                $sWhere .= "" . $aColumns[($i + 1)] . " LIKE '%" . ($xSearch) . "%' ";
            }
        }
        $nextLimit = (($sLimit - $xDisplayLength) <= 0) ? '' : ($sLimit - $xDisplayLength) . ',';
        $xLimit = $xDisplayLength;

        if ($xDisplayLength == '-1') {
            $sLimit = '';
        } else {
            $sLimit = "LIMIT $nextLimit $xLimit";
        }

        $ssQ = $tQuery . " $sWhere $sOrder $sLimit ";

        $rResult = $CI->db->query($ssQ);
        $sQuery = "SELECT COUNT(*) as aTot FROM ($tQuery) as sukuquery WHERE 1=1 $sWhere";
        $rResultFilterTotal = $CI->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->aTot;

        $sQuery = "SELECT COUNT(" . $sIndexColumn . ") as aTot FROM ($tQuery) as sukuquery WHERE 1=1 $sWhere";
        $rResultTotal = $CI->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->aTot;
        $xEcho = ($CI->input->get('sEcho') != "") ? $CI->input->get('sEcho') : (($CI->input->post('sEcho')) ? $CI->input->post('sEcho') : '' );
        $output = array(
            "sEcho" => intval($xEcho),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        $resultx = $rResult->result_array();
        foreach ($resultx as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }
        return $output;
    }

    public function present(){
        $CI = & get_instance();
        $aColumns = $this->aColumns;
        $sIndexColumn = $this->sIndexColumn;
        $sTable = $this->sTable;
        $tQuery = $this->tQuery;
        $sLimit = "";

        $xDisplayStart = $CI->input->post('start');
        $xDisplayLength = $CI->input->post('length');
        if (($xDisplayStart != '') && $xDisplayLength != '-1') {
            $sLimit = ($xDisplayStart == 0) ? $xDisplayLength : (($xDisplayStart) + 10);
        }

        $xOrder = $CI->input->post('order')[0]['column'];
        $xSortingCols = $CI->input->post('order');
        if (isset($xOrder)) {
            $sOrder0 = "ORDER BY  ";
            for ($i = 0; $i < intval($xSortingCols); $i++) {
                $xSortCol = $CI->input->post('order')[$i]['column'];
                $xSortDir = $CI->input->post('order')[$i]['dir'];
                $xSortable = $CI->input->post('columns')[intval($xSortCol)]['orderable'];
                if ($xSortable == "true") {
                    $sOrder0 .= $aColumns[intval($xSortCol)] . " " . $xSortDir . ", ";
                }
            }
            $sOrder = substr_replace($sOrder0, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        $sWhere = "";
        $xSearch = ($CI->input->get('search')['value'] != "") ? $CI->input->get('search')['value'] : (($CI->input->post('search')['value']) ? $CI->input->post('search')['value'] : '' );
        if ($xSearch != "") {
            $sWhere0 = "AND ("; //"WHERE (";
            for ($i = 0; $i < (count($aColumns) - 1); $i++) {
                $sWhere0 .= $aColumns[$i] . " LIKE '%" . $xSearch . "%' OR ";
            }
            $sWhere = substr_replace($sWhere0, "", -3);
            $sWhere .= ')';
        }
        for ($i = 0; $i < (count($aColumns) - 1); $i++) {
            $xSearchable = ($CI->input->get('columns')[$i]["searchable"] != "") ? $CI->input->get('columns')[$i]["searchable"] : (($CI->input->post('columns')[$i]["searchable"]) ? $CI->input->post('columns')[$i]["searchable"] : '' );
            $xSearch = ($CI->input->get('columns')[$i]["search"]["value"] != "") ? $CI->input->get('columns')[$i]["search"]["value"]: (($CI->input->post('columns')[$i]["search"]["value"]) ? $CI->input->post('columns')[$i]["search"]["value"] : '' );
            if ($xSearchable == "true" && $xSearch != '') {
                if ($sWhere === "") : $sWhere = "AND ";
                else : $sWhere .= " AND ";
                endif;
                $sWhere .= "" . $aColumns[($i + 1)] . " LIKE '%" . ($xSearch) . "%' ";
            }
        }
        $nextLimit = (($sLimit - $xDisplayLength) <= 0) ? '' : ($sLimit - $xDisplayLength) . ',';
        $xLimit = $xDisplayLength;

        if ($xDisplayLength == '-1') {
            $sLimit = '';
        } else {
            $sLimit = "LIMIT $nextLimit $xLimit";
        }
        
        $ssQ = $tQuery . " $sWhere $sOrder $sLimit ";

        $rResult = $CI->db->query($ssQ);
        $sQuery = "SELECT COUNT(*) as aTot FROM ($tQuery) as sukuquery WHERE 1=1 $sWhere";
        $rResultFilterTotal = $CI->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->aTot;

        $sQuery = "SELECT COUNT(" . $sIndexColumn . ") as aTot FROM ($tQuery) as sukuquery WHERE 1=1 $sWhere";
        $rResultTotal = $CI->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->aTot;
        $xEcho = $CI->input->get('draw');
        $output = array(
            "draw" => intval($xEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );

        $resultx = $rResult->result_array();
        foreach ($resultx as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['data'][] = $row;
        }
        return $output;
    }
}