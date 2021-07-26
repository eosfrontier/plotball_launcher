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
	 * @param  string $tablename Name of the table where the row lives.
	 * @param  array  $args An array where the key is the column and the value is the value that goes into said column.
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

	/**
	 * Function to update a row.
	 *
	 * @param  string $tablename Name of the table where the row lives.
	 * @param  array  $set_values  An array where the key is the column and the value is the value that goes into said column.
	 * @param  array  $condition  An array where the key is the column and the value is the value that goes into said column that you want to use to target the row with.
	 * @return bool
	 */
	public function update( string $tablename, array $set_values, array $condition ):bool {

		$i = 0;
		foreach ( $set_values as $key => $value ) {
			$set_expression[ $i ] = $key . "='" . $value . "'";
			$i++;
		}

		$set_expression = implode( ', ', $set_expression );

		$a = 0;
		foreach ( $condition as $key => $value ) {
			$set_condition[ $a ] = $key . "='" . $value . "'";
			$a++;
		}
		$set_condition = implode( ' AND ', $set_condition );

		$stmt   = $this->conn->prepare( "UPDATE $tablename SET $set_expression WHERE $set_condition" );
		$result = $stmt->execute();
		$stmt   = null;

		return $result;
	}
}
