<?php

namespace frontier\ploball\database;

use frontier\ploball\database\Database_Connection;

class Crud {

	/**
	 * Function to insert a new row into a specified table.
	 *
	 * @param  string $table - The specified table.
	 * @param  array  $args - An array where the key is the column and the value is the value that goes into said column.
	 * @return bool
	 */
	public static function insert( string $table = '', array $args = [] ) :bool {
		$count          = count( $args );
		$question_marks = '';
		$values         = [];
		$column         = '';

		$question_marks = array_fill( 0, $count, '?' );
		$question_marks = implode( ', ', $question_marks );

		foreach ( $args as $columns_key => $arg ) {
			$values[] = $arg;
			$column  .= $columns_key . ', ';
		}

		$column = substr( $column, 0, -2 );

		$sql = 'INSERT INTO ' . $table . ' (' . $column . ') values (' . $question_marks . ')';

		$stmt   = Database_Connection::connect()->prepare( $sql );
		$result = $stmt->execute( $values );
		$stmt   = null;

		return $result;
	}

	/**
	 * An abstract select query function.
	 *
	 * @param  string $sql The query.
	 * @param  array  $args The arguments needed for the query.
	 * @return array
	 */
	public static function get( $sql, array $args = [] ) :array {
		$stmt = Database_Connection::connect()->prepare( $sql );
		$stmt->execute( $args );
		$result = $stmt->fetchAll();
		$stmt   = null;

		return $result;
	}

	/**
	 * Function to delete table rows.
	 *
	 * @param  string $tablename
	 * @param  array  $args
	 * @return bool
	 */
	public function delete( $tablename, array $args = [] ) :bool {
		$i = 0;
		foreach ( $args as $key => $value ) {
			$expression[ $i ] = $key . "='" . $value . "'";
		}

		$expression = implode( ' AND ', $expression );
		$stmt       = $this->conn->prepare( "DELETE FROM $tablename WHERE $expression" );
		$result     = $stmt->execute();
		$stmt       = null;

		return $result;
	}
}
