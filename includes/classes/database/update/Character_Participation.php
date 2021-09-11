<?php
namespace frontier\ploball\database\update;

use frontier\ploball\database\Crud;
use frontier\ploball\database\get\Get_All_Plotballs;

class Character_Participation {

	public static function sign_up_for_plot( $post ) {
		$plotball_id  = $post['plot_id'];
		$character_id = $post['character_id'];
		unset( $post['xf'] );
		unset( $post['plot_id'] );
		unset( $post['character_id'] );

		$plotball_characters = Get_All_Plotballs::get_plotball_by_id( $plotball_id )[0]['characters'];

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

		return Crud::update( 'plotball', $arg, $conditions );
	}
}
