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

	/**
	 * Get a specific skill name by id.
	 *
	 * @param  int $id the id of the skill.
	 * @return string
	 */
	public static function get_skill_by_id( int $id ): string {
		$skill = Crud::get( "SELECT name from ecc_skills_groups WHERE primaryskill_id  = $id" );
		return $skill[0]['name'];
	}
}
