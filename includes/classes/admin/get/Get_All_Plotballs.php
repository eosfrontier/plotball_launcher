<?php
namespace frontier\ploball\admin\get;

use frontier\ploball\database\Crud;

class Get_All_Plotballs {

	public static function get_all_plotballs() {
		$plotballs = Crud::get( 'SELECT * FROM plotball' );

		return $plotballs;
	}
}
