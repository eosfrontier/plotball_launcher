<?php
namespace frontier\ploball\front;

use frontier\ploball\database\Crud;
use frontier\ploball\database\get\Get_All_Plotballs;

class Double_Signup {

	public static function get_double_signups( $id ) {
		$plotball = json_decode( Get_All_Plotballs::get_plotball_by_id( $id )[0]['signed_in'], true );

		$counts   = array_count_values( $plotball );
		$filtered = array_filter(
			$plotball,
			function ( $value ) use ( $counts ) {
				return $counts[ $value ] > 1;
			}
		);

		$array = [];

		foreach ( $filtered as $key => $item ) {
			$array[ $item ][] = $key;
		}

		return $array;
	}

	public static function sign_me_out_as_double( $post ) {
		$character_id = $post['character_id'];
		$plot_id      = $post['plot_id'];
		$plotball     = json_decode( Get_All_Plotballs::get_plotball_by_id( $plot_id )[0]['signed_in'], true );

		unset( $plotball[ $character_id ] );

		$arg['signed_in'] = json_encode( $plotball );
		$conditions['id'] = $plot_id;

		Crud::update( 'plotball', $arg, $conditions );

		$check    = new Double_Signup();
		$callback = $check->check_if_still_doubles( $plot_id );

		$return = 3;
		if ( $callback ) {
			$return = 2;
		}

		return $return;
	}

	public function check_if_still_doubles( $id ) {
		$plotball = json_decode( Get_All_Plotballs::get_plotball_by_id( $id )[0]['signed_in'], true );

		$return = count( $plotball ) !== count( array_unique( $plotball ) );

		if ( ! $return ) {
			$arg['published'] = 3;
			$conditions['id'] = $id;

			Crud::update( 'plotball', $arg, $conditions );
		}

		return $return;
	}
}
