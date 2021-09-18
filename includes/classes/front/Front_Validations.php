<?php
namespace frontier\ploball\front;

use frontier\ploball\admin\Skills;
use frontier\ploball\database\get\Character;

class Front_Validations {

	/**
	 * Generate the html of the validations.
	 *
	 * @param  mixed $validations json array of the validations.
	 * @param  mixed $character_validations json array of the character validations.
	 * @return string
	 */
	public static function show_requirements( $validations, $character_validations ):string {
		$validations = json_decode( $validations, true );

		if ( ! empty( $character_validations ) ) {
			$character_validations = json_decode( $character_validations, true );
		}
		else {
			$character_validations = [];
		}

		$list = '';

		if ( isset( $validations['main_skills_validations'] ) ) {
			$i     = 0;
			$list .= '<div>';
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
				$html           = '';
				$has_characters = 0;

				if ( ! empty( $character_validations ) ) {
					foreach ( $character_validations as $key => $character_validation ) {

						$check = explode( '_', $character_validation );
						if ( $check[0] === 'main' && $check[1] === strval( $i ) ) {
							$has_characters = 1;

							$info  = new Front_Validations();
							$html .= $info->show_character_info( $key );
						}
					}

					if ( $has_characters === 1 ) {
						$list .= $html . '<br />';
					}
				}
				$i++;
			}

				$list .= '</div>';
		}


		if ( isset( $validations['specialty_skills_validations'] ) ) {
			$i     = 0;
			$list .= '<div>';
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
				$html           = '';
				$has_characters = 0;

				if ( ! empty( $character_validations ) ) {
					foreach ( $character_validations as $key => $character_validation ) {

						$check = explode( '_', $character_validation );
						if ( $check[0] === 'specialty' && $check[1] === strval( $i ) ) {
							$has_characters = 1;

							$info  = new Front_Validations();
							$html .= $info->show_character_info( $key );
						}
					}

					if ( $has_characters === 1 ) {
						$list .= $html . '<br />';
					}
				}
				$i++;
			}
			$list .= '</div>';
		}

		if ( isset( $validations['faction_validations'] ) ) {
			$i     = 0;
			$list .= '<div>';
			$list .= '<strong>Factions</strong>';

			foreach ( $validations['faction_validations'] as $faction ) {

				$list          .= ucfirst( $faction['faction'] ) . '<br />';
				$html           = '';
				$has_characters = 0;

				if ( ! empty( $character_validations ) ) {
					foreach ( $character_validations as $key => $character_validation ) {

						$check = explode( '_', $character_validation );
						if ( $check[0] === 'faction' && $check[1] === strval( $i ) ) {
							$has_characters = 1;

							$info  = new Front_Validations();
							$html .= $info->show_character_info( $key );
						}
					}

					if ( $has_characters === 1 ) {
						$list .= $html . '<br />';
					}
				}
				$i++;
			}
			$list .= '</div>';
		}

		if ( ! empty( $validations['custom_validation'] ) ) {
			$i                  = 0;
			$list              .= '<div>';
			$list              .= '<strong>Custom requirements</strong>';
			$list              .= $validations['custom_validation'] . '<br />';
			$html               = '';
				$has_characters = 0;

			if ( ! empty( $character_validations ) ) {
				foreach ( $character_validations as $key => $character_validation ) {

					$check = explode( '_', $character_validation );
					if ( $check[0] === 'custom' && $check[1] === strval( $i ) ) {
						$has_characters = 1;

						$info  = new Front_Validations();
						$html .= $info->show_character_info( $key );
					}
				}

				if ( $has_characters === 1 ) {
					$list .= $html . '<br />';
				}
			}
				$i++;
			$list .= '</div>';
		}

		return $list;
	}

	/**
	 * Character that has signed up for a validation.
	 *
	 * @param  mixed $id Id of the character.
	 * @return string Generated html.
	 */
	public function show_character_info( $id ) {
		$character = Character::get_active_character_by_id( $id )['character_name'];

		$html = "<span tabindex='0' class='small-image'>
					<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$id.jpg' />
					<div class='hover-info'>
						<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$id.jpg' />
						<span>$character</span>
					</div>
				</span>";

		return $html;
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

		$html = '';

		if ( isset( $validations['main_skills_validations'] ) ) {
			$i = 0;
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
			$i = 0;

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
					$html            .= $front_validation->generate_checkbox_skill( $val_skill['skill'], $val_skill['argument'], $val_skill['level'], $i, 'specialty' );
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

					$html .= "<input type='radio' id='$random' name='character' value='faction_$i' />";
					$html .= "<label for='$random'>$factionname</label>";
				}

				$i++;
			}
		}

		if ( isset( $validations['custom_validation'] ) ) {
			$random = rand( 0, 100000 );

			$html .= "<input type='radio' id='$random' name='character' value='custom_0' />";
			$html .= "<label for='$random'>Custom requirement</label>";
		}

		return $html;
	}

	/**
	 * Generate radio list to check for validations.
	 *
	 * @param  mixed $skill_id The skill id.
	 * @param  mixed $argument Equal to and such.
	 * @param  mixed $level Level of the skill.
	 * @param  mixed $array_number Position in the validation array.
	 * @param  mixed $type Type of validation.
	 * @return string
	 */
	public function generate_checkbox_skill( $skill_id, $argument, $level, $array_number, $type ): string {
		$random    = rand( 0, 100000 );
		$skillname = Skills::get_skill_by_id( $skill_id );

		$value = $type . '_' . $array_number;

		$html  = '';
		$html .= "<input type='radio' id='$random' name='character' value='$value' />";
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
