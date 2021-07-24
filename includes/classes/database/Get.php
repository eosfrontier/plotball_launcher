<?php
namespace frontier\ploball\database;

use frontier\ploball\database\Database_Connection;

class Get {

	/**
	 * An abstract select query function.
	 *
	 * @param  mixed $sql The query.
	 * @param  mixed $args The arguments needed for the query.
	 * @return object
	 */
	public static function get( $sql, $args = [] ):object {
		$stmt = Database_Connection::connect()->prepare( $sql );
		$stmt->execute( $args );
		return $stmt;
	}
}
