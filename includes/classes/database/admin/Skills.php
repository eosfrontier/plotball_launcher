<?php
namespace frontier\ploball\database\admin;

use frontier\ploball\database\Get;

class Skills {

	public static function get_all_skills(): array {

		$skills = Get::get( 'SELECT * FROM ecc_skills_allskills' )->fetchAll();

		return $skills;
	}

	public static function get_all_skills_groups(): array {

		$skills = Get::get( 'SELECT * FROM ecc_skills_groups ORDER BY name' )->fetchAll();

		return $skills;
	}
}
