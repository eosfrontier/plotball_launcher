<?php
namespace frontier\ploball\front;

use frontier\ploball\admin\Skills;

class Front_Validations {

	/**
	 * Generate the html of the validations.
	 *
	 * @param  mixed $validations json array of the validations.
	 * @return string
	 */
	public static function show_requirements( $validations ):string {
		$validations = json_decode( $validations, true );

		$list = '';

		if ( isset( $validations['main_skills_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Main Skills</strong>';

			foreach ( $validations['main_skills_validations'] as $main_skill ) {
				$list .= Skills::get_skill_by_id( $main_skill['skill'] ) . ' ';

				if ( $main_skill['argument'] === '1' ) {
					$list .= 'equal or lower to';
				}

				if ( $main_skill['argument'] === '2' ) {
					$list .= 'equal to';
				}

				if ( $main_skill['argument'] === '3' ) {
					$list .= 'equal or higher to';
				}

				if ( $main_skill['level'] === '1' ) {
					$list .= ' aspirant<sup>1</sup><br />';
				}

				if ( $main_skill['level'] === '2' ) {
					$list .= ' apprentice<sup>2</sup><br />';
				}

				if ( $main_skill['level'] === '3' ) {
					$list .= ' adept<sup>3</sup><br />';
				}

				if ( $main_skill['level'] === '4' ) {
					$list .= ' experienced<sup>4</sup><br />';
				}

				if ( $main_skill['level'] === '5' ) {
					$list .= ' advanced<sup>5</sup><br />';
				}
			}
			$list .= '</p>';
		}

		if ( isset( $validations['specialty_skills_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Specialty Skills</strong>';

			foreach ( $validations['specialty_skills_validations'] as $special_skill ) {
				$list .= Skills::get_skill_by_id( $special_skill['skill'] ) . ' ';

				if ( $special_skill['argument'] === '1' ) {
					$list .= 'equal or lower to';
				}

				if ( $special_skill['argument'] === '2' ) {
					$list .= 'equal to';
				}

				if ( $special_skill['argument'] === '3' ) {
					$list .= 'equal or higher to';
				}

				if ( $special_skill['level'] === '6' ) {
					$list .= ' specialist<sup>6</sup><br />';
				}

				if ( $special_skill['level'] === '7' ) {
					$list .= ' distinguished<sup>7</sup><br />';
				}

				if ( $special_skill['level'] === '8' ) {
					$list .= ' expert<sup>8</sup><br />';
				}

				if ( $special_skill['level'] === '9' ) {
					$list .= ' renowned<sup>9</sup><br />';
				}

				if ( $special_skill['level'] === '10' ) {
					$list .= ' authority<sup>10</sup><br />';
				}
			}
			$list .= '</p>';
		}

		if ( isset( $validations['faction_validations'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Factions</strong>';

			foreach ( $validations['faction_validations'] as $faction ) {

				$list .= ucfirst( $faction['faction'] ) . '<br />';
			}
			$list .= '</p>';
		}

		if ( ! empty( $validations['custom_validation'] ) ) {
			$list .= '<p>';
			$list .= '<strong>Custom requirements</strong>';
			$list .= $validations['custom_validation'] . '<br />';
			$list .= '</p>';
		}


		return $list;
	}

	/**
	 * Generate the html to show which they can check.
	 *
	 * @param  mixed $skills the array with the skills of the character.
	 * @param  mixed $validations  json array of the validations.
	 * @param  mixed $faction faction of the character.
	 * @return string
	 */
	public static function show_checkboxes( $skills, $validations, $faction ): string {
		$validations = json_decode( $validations, true );

		$i = 0;

		$html = '';

		if ( isset( $validations['main_skills_validations'] ) ) {
			foreach ( $validations['main_skills_validations'] as $val_skill ) {
				$has_skill = 0;


				foreach ( $skills as $skill ) {
					if ( $skill['parent'] === $val_skill['skill'] ) {
						if ( $val_skill['argument'] === '1' ) {
							if ( $skill['level'] <= $val_skill['level'] ) {
								$has_skill = 1;
							}
						}

						if ( $val_skill['argument'] === '2' ) {
							if ( $skill['level'] === $val_skill['level'] ) {
								$has_skill = 1;
							}
						}

						if ( $val_skill['argument'] === '3' ) {
							if ( $skill['level'] >= $val_skill['level'] ) {
								$has_skill = 1;
							}
						}
					}
				}

				if ( $has_skill === 1 ) {
					$front_validation = new Front_Validations();
					$html            .= $front_validation->generate_checkbox_skill( $val_skill['skill'], $val_skill['argument'], $val_skill['level'], $i, 'main' );
				}

				$i++;
			}
		}

		if ( isset( $validations['specialty_skills_validations'] ) ) {
			foreach ( $validations['specialty_skills_validations'] as $val_skill ) {
				$has_skill = 0;


				foreach ( $skills as $skill ) {
					if ( $skill['parent'] === $val_skill['skill'] ) {
						if ( $val_skill['argument'] === '1' ) {
							if ( $skill['level'] <= $val_skill['level'] ) {
								$has_skill = 1;
							}
						}

						if ( $val_skill['argument'] === '2' ) {
							if ( $skill['level'] === $val_skill['level'] ) {
								$has_skill = 1;
							}
						}

						if ( $val_skill['argument'] === '3' ) {
							if ( $skill['level'] >= $val_skill['level'] ) {
								$has_skill = 1;
							}
						}
					}
				}

				if ( $has_skill === 1 ) {
					$front_validation = new Front_Validations();
					$html            .= $front_validation->generate_checkbox_skill( $val_skill['skill'], $val_skill['argument'], $val_skill['level'], $i, 'main' );
				}

				$i++;
			}
		}

		if ( isset( $validations['faction_validations'] ) ) {
			$i = 0;

			foreach ( $validations['faction_validations'] as $valfaction ) {

				$factionname = ucfirst( $valfaction['faction'] );

				if ( $faction === $valfaction['faction'] ) {
					$random = rand( 0, 100000 );

					$html .= "<input type='checkbox' id='$random' name='character[faction][$i]' />";
					$html .= "<label for='$random'>$factionname</label>";
				}

				$i++;
			}
		}

		if ( isset( $validations['custom_validation'] ) ) {
			$random = rand( 0, 100000 );

			$html .= "<input type='checkbox' id='$random' name='character[custom]' />";
			$html .= "<label for='$random'>Custom requirement</label>";
		}

		return $html;
	}

	public function generate_checkbox_skill( $skill_id, $argument, $level, $array_number, $type ): string {
		$random    = rand( 0, 100000 );
		$skillname = Skills::get_skill_by_id( $skill_id );

		$html  = '';
		$html .= "<input type='checkbox' id='$random' name='character[$type][$array_number]' />";
		$html .= "<label for='$random'>$skillname ";

		if ( $argument === '1' ) {
			$html .= 'equal or lower to';
		}

		if ( $argument === '2' ) {
			$html .= 'equal to';
		}

		if ( $argument === '3' ) {
			$html .= 'equal or higher to';
		}


		if ( $level === '1' ) {
			$html .= ' aspirant<sup>1</sup><br />';
		}

		if ( $level === '2' ) {
			$html .= ' apprentice<sup>2</sup><br />';
		}

		if ( $level === '3' ) {
			$html .= ' adept<sup>3</sup><br />';
		}

		if ( $level === '4' ) {
			$html .= ' experienced<sup>4</sup><br />';
		}

		if ( $level === '5' ) {
			$html .= ' advanced<sup>5</sup><br />';
		}

		if ( $level === '6' ) {
			$html .= ' specialist<sup>6</sup><br />';
		}

		if ( $level === '7' ) {
			$html .= ' distinguished<sup>7</sup><br />';
		}

		if ( $level === '8' ) {
			$html .= ' expert<sup>8</sup><br />';
		}

		if ( $level === '9' ) {
			$html .= ' renowned<sup>9</sup><br />';
		}

		if ( $level === '10' ) {
			$html .= ' authority<sup>10</sup><br />';
		}

		$html .= '</label>';


		return $html;
	}
}
