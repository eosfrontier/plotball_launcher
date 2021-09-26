<?php
namespace frontier\ploball\database\insert;

use frontier\ploball\database\Crud;

class Insert_Plotball {

	/**
	 * Insert a new plotbal in the database
	 *
	 * @param  mixed $post Array of data.
	 * @return bool
	 */
	public static function insert( $post ) {
		unset( $post['xf'] );

		$validations = [];

		$post['bounce'] = implode( ',', $post['bounce'] );

		if ( isset( $post['main_skills_validations'] ) ) {
			$validations['main_skills_validations'] = $post['main_skills_validations'];
			unset( $post['main_skills_validations'] );
		}

		if ( isset( $post['specialty_skills_validations'] ) ) {
			$validations['specialty_skills_validations'] = $post['specialty_skills_validations'];
			unset( $post['specialty_skills_validations'] );
		}

		if ( isset( $post['faction_validations'] ) ) {
			$validations['faction_validations'] = $post['faction_validations'];
			unset( $post['faction_validations'] );
		}

		if ( ! empty( $post['custom_validation'] ) ) {
			$validations['custom_validation'] = $post['custom_validation'];
		}
		unset( $post['custom_validation'] );

		$post['validations'] = json_encode( $validations );

		$return = Crud::insert( 'plotball', $post );

		return $return;
	}
}
