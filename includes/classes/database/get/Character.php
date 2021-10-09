<?php
namespace frontier\ploball\database\get;

use frontier\ploball\database\Crud;

class Character {

	/**
	 * Get the character by Joomla id.
	 *
	 * @param  mixed $id the joomla id.
	 * @return array
	 */
	public static function get_active_character_by_jid( $id ):array {
		$character = Crud::get( "SELECT SQL_NO_CACHE * FROM ecc_characters where accountID = $id and sheet_status = 'active'" );

		return $character['0'];
	}

	/**
	 * Get the character by id.
	 *
	 * @param  mixed $id the id.
	 * @return array
	 */
	public static function get_active_character_by_id( $id ):array {
		$character = Crud::get( "SELECT SQL_NO_CACHE * FROM ecc_characters where characterID = $id" );

		return $character['0'];
	}

	/**
	 * Get the parent and level columns in an array.
	 *
	 * @param  mixed $id the character id.
	 * @return array
	 */
	public static function get_character_skills_by_id( $id ):array {
		$skills = Crud::get( "SELECT SQL_NO_CACHE skill_id FROM ecc_char_skills where charID = $id ORDER BY skill_ID" );

		$skills_list = [];

		foreach ( $skills as $skill ) {
			$skillid = $skill['skill_id'];
			$skill   = Crud::get( "SELECT SQL_NO_CACHE parent, level FROM ecc_skills_allskills where skill_id = $skillid" );
			array_push( $skills_list, $skill[0] );
		}

		return $skills_list;
	}
}
