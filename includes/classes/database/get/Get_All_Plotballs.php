<?php
namespace frontier\ploball\database\get;

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

	public static function get_all_active_plotballs(): array {
		$current_date = date( 'Y-m-d' );
		$current_time = date( 'H:i' );
		$plotballs    = Crud::get( "SELECT * FROM plotball WHERE published = 1 AND starting_date <= '$current_date' AND starting_time <= '$current_time' ORDER BY starting_date, starting_time" );
		return $plotballs;
	}
}
