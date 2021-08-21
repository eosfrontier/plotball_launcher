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
			$list .= '<strong>Main Skills</strong>';

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
			$list .= '<strong>Specialty Skills</strong>';

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
			$list .= '<strong>Factions</strong>';

			foreach ( $validations['faction_validations'] as $faction ) {

				$list .= $faction['faction'] . '<br />';
			}
			$list .= '</p>';
		}

		if ( ! empty( $validations['custom_validation'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Custom validation</strong>';
			$list .= $validations['custom_validation'] . '<br />';
			$list .= '</p>';
		}


		return $list;
	}

	public static function list_main_skills( $list ) {
		$validations = json_decode( $list, true )['main_skills_validations'];

		$html = '';

		foreach ( $validations as $key => $validation ) {
			$html .= '<div class="' . $key . ' skill_row">';
			$html .= '<select class="" name="main_skills_validations[' . $key . '][skill]"><optgroup label="Main Skills">';
			$html .= self::main_skills_select( $validation['skill'] );
			$html .= '</optgroup></select>';
			$html .= '<select class="" name="main_skills_validations[' . $key . '][argument]">';
			$html .= self::arguments( $key, $validation['argument'] );
			$html .= '</select>';
			$html .= '<select class="" name="main_skills_validations[' . $key . '][level]">';
			$html .= self::lowerlevel( $key, $validation['level'] );
			$html .= '</select>';
			$html .= '<button class="remove-validation">Remove row 🗑️</button>';
			$html .= '</div>';
		}

		return $html;
	}

	public static function list_specialty_skills( $list ) {
		$validations = json_decode( $list, true )['specialty_skills_validations'];

		$html = '';

		foreach ( $validations as $key => $validation ) {
			$html .= '<div class="' . $key . ' skill_row">';
			$html .= '<select class="" name="specialty_skills_validations[' . $key . '][skill]"><optgroup label="Main Skills">';
			$html .= self::specialty_skills_select( $validation['skill'] );
			$html .= '</optgroup></select>';
			$html .= '<select class="" name="specialty_skills_validations[' . $key . '][argument]">';
			$html .= self::arguments( $validation['argument'] );
			$html .= '</select>';
			$html .= '<select class="" name="specialty_skills_validations[' . $key . '][level]">';
			$html .= self::higherlevel( $validation['level'] );
			$html .= '</select>';
			$html .= '<button class="remove-validation">Remove row 🗑️</button>';
			$html .= '</div>';
		}

		return $html;
	}

	public static function list_faction( $list ): string {
		$validations = json_decode( $list, true )['faction_validations'];
		$html        = '';
		foreach ( $validations as $key => $validation ) {
			$selected = '';
			$html    .= '<div class="' . $key . ' skill_row">';
			$html    .= '<select class="" name="faction_validations[' . $key . '][faction]">';
			$html    .= '<optgroup label="Faction">';

			if ( $validation['faction'] === 'aquila' ) {
				$selected = ' selected';
			}
			$html    .= '<option value="aquila"' . $selected . '>Aquila</option>';
			$selected = '';

			if ( $validation['faction'] === 'dugo' ) {
				$selected = ' selected';
			}
			$html    .= '<option value="dugo"' . $selected . '>Dugo</option>';
			$selected = '';

			if ( $validation['faction'] === 'ekanesh' ) {
				$selected = ' selected';
			}
			$html    .= '<option value="ekanesh"' . $selected . '>Ekanesh</option>';
			$selected = '';

			if ( $validation['faction'] === 'pendzal' ) {
				$selected = ' selected';
			}
			$html    .= '<option value="pendzal"' . $selected . '>Pendzal</option>';
			$selected = '';

			if ( $validation['faction'] === 'sona' ) {
				$selected = ' selected';
			}
			$html    .= '<option value="sona"' . $selected . '>Sona</option>';
			$selected = '';

			$html .= '</select>';
			$html .= '</optgroup>';
			$html .= '<button class="remove-validation">Remove row 🗑️</button>';
			$html .= '</div>';
		}

		return $html;
	}

	private static function main_skills_select( $selected ): string {
		$skills = Skills::get_all_skills_groups();

		$main_skills = '';

		foreach ( $skills as $skill ) {
			if ( $skill['parents'] === 'none' || $skill['parents'] === 'tele' ) {
				$selected_value = '';

				if ( $skill['primaryskill_id'] === $selected ) {
					$selected_value = ' selected';
				}

				$main_skills .= '<option value="' . $skill['primaryskill_id'] . '"' . $selected_value . '>' . $skill['name'] . '</option>';
			}
		}

		return $main_skills;
	}

	private static function specialty_skills_select( $selected ): string {
		$skills = Skills::get_all_skills_groups();

		$special_skills = '';

		foreach ( $skills as $skill ) {
			if ( $skill['parents'] !== 'none' ) {
				$selected_value = '';

				if ( $skill['primaryskill_id'] === $selected ) {
					$selected_value = ' selected';
				}

				$special_skills .= '<option value="' . $skill['primaryskill_id'] . '"' . $selected_value . '>' . $skill['name'] . '</option>';
			}
		}

		return $special_skills;
	}

	private static function arguments( $argument ): string {
		$selected = '';

		if ( $argument === '1' ) {
			$selected = ' selected';
		}
		$arguments = '<option value="1"' . $selected . '>Equal or lower</option>';
		$selected  = '';

		if ( $argument === '2' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="2"' . $selected . '>Exact equal</option>';
		$selected   = '';

		if ( $argument === '3' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="3"' . $selected . '>Equal or above</option>';
		$selected   = '';

		return $arguments;
	}

	private static function lowerlevel( $level ): string {
		$selected = '';

		if ( $level === '1' ) {
			$selected = ' selected';
		}
		$arguments = '<option value="1"' . $selected . '>1</option>';
		$selected  = '';

		if ( $level === '2' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="2"' . $selected . '>2</option>';
		$selected   = '';

		if ( $level === '3' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="3"' . $selected . '>3</option>';
		$selected   = '';

		if ( $level === '4' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="4"' . $selected . '>4</option>';
		$selected   = '';

		if ( $level === '5' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="5"' . $selected . '>5</option>';
		$selected   = '';

		return $arguments;
	}

	private static function higherlevel( $level ): string {
		$selected = '';

		if ( $level === '6' ) {
			$selected = ' selected';
		}
		$arguments = '<option value="6"' . $selected . '>6</option>';
		$selected  = '';

		if ( $level === '7' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="7"' . $selected . '>7</option>';
		$selected   = '';

		if ( $level === '8' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="8"' . $selected . '>8</option>';
		$selected   = '';

		if ( $level === '9' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="9"' . $selected . '>9</option>';
		$selected   = '';

		if ( $level === '10' ) {
			$selected = ' selected';
		}
		$arguments .= '<option value="10"' . $selected . '>10</option>';
		$selected   = '';

		return $arguments;
	}
}
