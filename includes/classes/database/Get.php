<?php
namespace frontier\ploball\database;

use frontier\ploball\database\Database_Connection;

class Get {

	public static function get( $sql, $args = [] ) {
		$stmt = Database_Connection::connect()->prepare( $sql );
		$stmt->execute( $args );
		return $stmt;
	}
}
