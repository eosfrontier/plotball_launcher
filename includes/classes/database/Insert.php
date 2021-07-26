<?php

namespace frontier\ploball\database;

use frontier\ploball\database\Database_Connection;

class Insert {

	/**
	 * Function to insert a new row into a specified table.
	 *
	 * @param  mixed $table - The specified table.
	 * @param  array $args - An array where the key is the column and the value is the value that goes into said column.
	 * @return bool
	 */
	public static function insert( $table = '', $args = [] ):bool {
		$count          = count( $args );
		$i              = 0;
		$question_marks = '';
		$columns_keys   = array_keys( $args );
		$values         = [];
		$column         = '';

		$question_marks = array_fill( 0, $count, '?' );
		$question_marks = implode( ', ', $question_marks );

		foreach ( $args as $arg ) {
			$values[] = $arg;
		}

		foreach ( $columns_keys as $columns_key ) {
			$column .= $columns_key . ', ';
		}

		$column = substr( $column, 0, -2 );

		$sql = 'INSERT INTO ' . $table . ' (' . $column . ') values (' . $question_marks . ')';

		$stmt   = Database_Connection::connect()->prepare( $sql );
		$result = $stmt->execute( $values );

		return $result;
	}
}
