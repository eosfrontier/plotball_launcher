<?php
namespace frontier\ploball\database\delete;

use frontier\ploball\database\Crud;
use frontier\ploball\database\get\Get_All_Plotballs;

class Remove_Characters {

	/**
	 * Remove character from sign up
	 *
	 * @param  mixed $plot_id Id of the plot.
	 * @param  mixed $character_id Id of the character.
	 * @return string Result of query.
	 */
	public static function remove_from_signup( $plot_id, $character_id ) {
		$plotball   = Get_All_Plotballs::get_plotball_by_id( $plot_id )[0];
		$characters = json_decode( $plotball['characters'], true );
		unset( $characters[ $character_id ] );
		$args = [ 'characters' => json_encode( $characters ) ];
		$id   = [ 'id' => $plot_id ];

		$result = Crud::update( 'plotball', $args, $id );

		return $result;
	}

	public static function remove_from_doubles( $plot_id, $character_id ) {
		$plotball = Get_All_Plotballs::get_plotball_by_id( $plot_id )[0];
		$doubles  = json_decode( $plotball['signed_in'], true );
		unset( $doubles[ $character_id ] );
		$args = [ 'signed_in' => json_encode( $doubles ) ];
		$id   = [ 'id' => $plot_id ];

		$result = Crud::update( 'plotball', $args, $id );

		return $result;
	}
}
