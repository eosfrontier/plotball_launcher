<?php
namespace frontier\ploball\admin;

use frontier\ploball\database\Crud;

class Skills {

	/**
	 * Returns all skills from database.
	 *
	 * @return array
	 */
	public static function get_all_skills(): array {

		$skills = Crud::get( 'SELECT * FROM ecc_skills_allskills' );

		return $skills;
	}

	/**
	 * Return all skill groups from database.
	 *
	 * @return array
	 */
	public static function get_all_skills_groups(): array {

		$skills = Crud::get( 'SELECT * FROM ecc_skills_groups ORDER BY name' );

		return $skills;
	}
}
