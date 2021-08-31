<?php
namespace frontier\ploball\database\update;

use frontier\ploball\database\Crud;

class Publish_Plotball {

	/**
	 * Set the published column to one
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function publish_plotball( $id ):bool {

		$arg['published'] = 1;
		$conditions['id'] = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}
}
