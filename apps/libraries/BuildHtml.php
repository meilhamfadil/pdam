<?php

class BuildHtml{

	public static function tr(){
		$tr = "<tr>";
		foreach(func_get_args() as $row){
			$tr .= "<td>$row</td>";
		}
		return $tr . "</tr>";
	}

}