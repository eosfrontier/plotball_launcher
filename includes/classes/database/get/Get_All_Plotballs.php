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

	/**
	 * Get all viewable plotballs.
	 *
	 * @return array
	 */
	public static function get_all_active_plotballs(): array {
		$current_unix = time();
		$plotballs    = Crud::get( "SELECT * FROM plotball WHERE published = 1 or published = 2 or published = 3 or published = 4 AND UNIX_TIMESTAMP( STR_TO_DATE( CONCAT( starting_date, ' ', starting_time ), '%Y-%m-%d %H:%i' ) ) <= $current_unix ORDER BY starting_date, starting_time" );
		return $plotballs;
	}
}
