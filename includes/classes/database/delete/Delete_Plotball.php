<?php
namespace frontier\ploball\database\delete;

use frontier\ploball\database\Crud;

class Delete_Plotball {

	public static function delete_ploball( $post ) {
		$table = 'plotball';
		$args  = [ 'id' => $post ];

		$result = Crud::delete( $table, $args );

		return $result;
	}
}
