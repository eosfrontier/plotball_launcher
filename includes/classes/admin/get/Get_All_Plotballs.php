<?php
namespace frontier\ploball\admin\get;

use frontier\ploball\database\Crud;

class Get_All_Plotballs {

	/**
	 * Get all plotballs.
	 *
	 * @return array
	 */
	public static function get_all_plotballs(): array {
		$plotballs = Crud::get( 'SELECT * FROM plotball ORDER BY starting_date, starting_time' );

		return $plotballs;
	}

	/**
	 * Get a plotball by id.
	 *
	 * @param  int $id the id of the plotball you wanna get.
	 * @return array
	 */
	public static function get_plotball_by_id( int $id ): array {
		$plotballs = Crud::get( "SELECT * FROM plotball WHERE id = $id" );

		return $plotballs;
	}
}
