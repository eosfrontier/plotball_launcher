<?php
namespace frontier\ploball\admin;

use frontier\ploball\admin\Skills;

class Validations {

	/**
	 * Returns all validations in a neat html for the overview page.
	 *
	 * @param  string $validations the validations array json decoded.
	 * @return string
	 */
	public static function get_overview_list( string $validations ): string {
		$validations = json_decode( $validations, true );

		$list = '';

		if ( isset( $validations['main_skills_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Main Skills</strong><br />';

			foreach ( $validations['main_skills_validations'] as $main_skill ) {
				$list .= Skills::get_skill_by_id( $main_skill['skill'] ) . ' ';

				if ( $main_skill['argument'] === '1' ) {
					$list .= '<=';
				}

				if ( $main_skill['argument'] === '2' ) {
					$list .= '=';
				}

				if ( $main_skill['argument'] === '3' ) {
					$list .= '>=';
				}

				$list .= ' ' . $main_skill['level'] . '<br />';
			}
			$list .= '</p>';
		}

		if ( isset( $validations['specialty_skills_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Specialty Skills</strong><br />';

			foreach ( $validations['specialty_skills_validations'] as $special_skill ) {
				$list .= Skills::get_skill_by_id( $special_skill['skill'] ) . ' ';

				if ( $special_skill['argument'] === '1' ) {
					$list .= '<=';
				}

				if ( $special_skill['argument'] === '2' ) {
					$list .= '=';
				}

				if ( $special_skill['argument'] === '3' ) {
					$list .= '>=';
				}

				$list .= ' ' . $special_skill['level'] . '<br />';
			}
			$list .= '</p>';
		}

		if ( isset( $validations['faction_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Factions</strong><br />';

			foreach ( $validations['faction_validations'] as $faction ) {

				$list .= $faction['faction'] . '<br />';
			}
			$list .= '</p>';
		}

		if ( ! empty( $validations['custom_validation'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Custom validation</strong><br />';
			$list .= $validations['custom_validation'] . '<br />';
			$list .= '</p>';
		}


		return $list;
	}
}
