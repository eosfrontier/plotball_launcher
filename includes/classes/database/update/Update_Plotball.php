<?php
namespace frontier\ploball\database\update;

use frontier\ploball\database\Crud;

class Update_Plotball {

	/**
	 * Insert a new plotbal in the database
	 *
	 * @param  mixed $post Array of data.
	 * @return bool
	 */
	public static function update( $post ) {

		unset( $post['xf'] );

		$validations = [];

		$id['id'] = $post['id'];

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

		$return = Crud::update( 'plotball', $post, $id );

		return $return;
	}

	/**
	 * Set the published column to five.
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_draft( $id ):bool {

		$arg['published']  = 0;
		$arg['characters'] = '';
		$arg['signed_in']  = '';
		$conditions['id']  = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}

	/**
	 * Set the published column to one
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_publish( $id ):bool {

		$arg['published']  = 1;
		$arg['characters'] = '';
		$arg['signed_in']  = '';
		$conditions['id']  = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}

	/**
	 * Set the published column to five.
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_double( $id ):bool {

		$arg['published'] = 2;
		$conditions['id'] = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}

	/**
	 * Set the published column to five.
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_active( $id ):bool {

		$arg['published'] = 3;
		$conditions['id'] = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}

	/**
	 * Set the published column to five.
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_completed( $id ):bool {

		$arg['published'] = 4;
		$conditions['id'] = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}

	/**
	 * Set the published column to five.
	 *
	 * @param  mixed $id The id of the plotball you want to change.
	 * @return bool
	 */
	public static function move_to_archive( $id ):bool {

		$arg['published'] = 5;
		$conditions['id'] = $id;

		return Crud::update( 'plotball', $arg, $conditions );
	}
}
