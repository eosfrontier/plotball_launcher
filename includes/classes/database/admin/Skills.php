<?php
namespace frontier\ploball\database\admin;

use frontier\ploball\database\Get;

class Skills {

	/**
	 * Returns all skills from database.
	 *
	 * @return array
	 */
	public static function get_all_skills(): array {

		$skills = Get::get( 'SELECT * FROM ecc_skills_allskills' )->fetchAll();

		return $skills;
	}

	/**
	 * Return all skill groups from database.
	 *
	 * @return array
	 */
	public static function get_all_skills_groups(): array {

		$skills = Get::get( 'SELECT * FROM ecc_skills_groups ORDER BY name' )->fetchAll();

		return $skills;
	}
}
