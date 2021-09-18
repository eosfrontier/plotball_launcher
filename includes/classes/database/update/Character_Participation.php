<?php
namespace frontier\ploball\database\update;

use frontier\ploball\database\Crud;
use frontier\ploball\database\get\Get_All_Plotballs;

class Character_Participation {

	/**
	 * Signes you up for a specific plotball and validation.
	 *
	 * @param  mixed $post Id of the plotball.
	 * @return int The different plotball statusses.
	 */
	public static function sign_up_for_plot( $post ) {
		$plotball_id         = $post['plot_id'];
		$character_id        = $post['character_id'];
		$plotball            = Get_All_Plotballs::get_plotball_by_id( $plotball_id )[0];
		$plotball_characters = $plotball['characters'];
		$plotball_published  = $plotball['published'];
		unset( $post['xf'] );
		unset( $post['plot_id'] );
		unset( $post['character_id'] );

		if ( empty( $plotball_characters ) ) {
			$plotball_characters                  = [];
			$plotball_characters[ $character_id ] = $post['character'];
		}
		else {
			$plotball_characters                  = json_decode( $plotball_characters, true );
			$plotball_characters[ $character_id ] = $post['character'];
		}

		$plotball_characters = json_encode( $plotball_characters );

		$arg['characters'] = $plotball_characters;
		$conditions['id']  = $plotball_id;

		if ( $plotball_published === '1' ) {
			Crud::update( 'plotball', $arg, $conditions );
			$plotball_validations = new Character_Participation();
			$plotball_validations->check_if_validations_are_filled( $plotball_id );
			return 1;
		}

		if ( $plotball_published === '2' ) {
			return 2;
		}

		if ( $plotball_published === '3' ) {
			return 3;
		}
	}

	/**
	 * Function that checks if the plotball is filled and set correct status.
	 *
	 * @param  mixed $id Id of the plotball you wanna check.
	 * @return void
	 */
	public function check_if_validations_are_filled( $id ) {
		$plotball = Get_All_Plotballs::get_plotball_by_id( $id )[0];

		$validations = json_decode( $plotball['validations'], true );
		$characters  = json_decode( $plotball['characters'], true );
		$filled      = 1;
		$double      = 0;

		if ( isset( $validations['main_skills_validations'] ) ) {
			$count = count( $validations['main_skills_validations'] );
			$i     = 0;
			while ( $i < $count ) {
				$check = 'main_' . $i;

				$checked_array = array_keys( $characters, $check );

				if ( empty( $checked_array ) ) {
					$filled = 0;
				}

				if ( count( $checked_array ) > 1 ) {
					$double = 1;
				}

				$i++;
			}
		}

		if ( isset( $validations['specialty_skills_validations'] ) ) {
			$count = count( $validations['specialty_skills_validations'] );
			$i     = 0;
			while ( $i < $count ) {
				$check = 'specialty_' . $i;

				$checked_array = array_keys( $characters, $check );

				if ( empty( $checked_array ) ) {
					$filled = 0;
				}

				if ( count( $checked_array ) > 1 ) {
					$double = 1;
				}

				$i++;
			}
		}

		if ( isset( $validations['faction_validations'] ) ) {
			$count = count( $validations['faction_validations'] );
			$i     = 0;
			while ( $i < $count ) {
				$check = 'faction_' . $i;

				$checked_array = array_keys( $characters, $check );

				if ( empty( $checked_array ) ) {
					$filled = 0;
				}

				if ( count( $checked_array ) > 1 ) {
					$double = 1;
				}

				$i++;
			}
		}

		if ( isset( $validations['custon_validations'] ) ) {
			$count = count( $validations['custon_validations'] );
			$i     = 0;
			while ( $i < $count ) {
				$check = 'custom_' . $i;

				$checked_array = array_keys( $characters, $check );

				if ( empty( $checked_array ) ) {
					$filled = 0;
				}

				if ( count( $checked_array ) > 1 ) {
					$double = 1;
				}

				$i++;
			}
		}

		if ( $filled === 1 ) {
			$arg['published'] = 3;

			if ( $double !== 0 ) {
				$arg['published'] = 2;
			}

			$conditions['id'] = $id;
			Crud::update( 'plotball', $arg, $conditions );
		}
	}
}
