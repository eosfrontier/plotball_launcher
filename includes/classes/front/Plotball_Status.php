<?php
namespace frontier\ploball\front;

use frontier\ploball\database\Crud;
use frontier\ploball\database\get\Get_All_Plotballs;

class Plotball_Status {

	/**
	 * Get text version of status back.
	 *
	 * @param  mixed $status The current status in number.
	 * @return string The text of the status.
	 */
	public static function get_current_status( $status ) {
		switch ( $status ) {
			case 1:
				return 'Sign up';
			case 2:
				return 'Resolve sign up';
			case 3:
				return 'Resolve task';
			case 4:
				return 'Task completed';
			default:
				return 'Status unknown';
		}

		return $status;
	}

	/**
	 * Check if the current user can complete a task.
	 *
	 * @param  array $signed_in_array Array of signed in characters.
	 * @param  int   $character_id The id of the current character.
	 * @return bool If the character can complete the task of not.
	 */
	public static function can_complete_task( $signed_in_array, $character_id ) {
		$return = true;
		$exist  = 1;

		if ( ! array_key_exists( $character_id, $signed_in_array ) ) {
			$return = false;
		}

		if ( ! isset( $signed_in_array['completed'] ) ) {
			$exist = 0;
		}

		if ( $exist === 1 && in_array( $character_id, $signed_in_array['completed'] ) ) {
			$return = false;
		}

		return $return;
	}

	/**
	 * Let's a player complete a task.
	 *
	 * @param  array $post Array with plot id and character id.
	 * @return int Result of function.
	 */
	public static function complete_task( $post ) {
		$character_id = $post['character_id'];
		$plot_id      = $post['plot_id'];
		$signed_in    = json_decode( Get_All_Plotballs::get_plotball_by_id( $plot_id )[0]['signed_in'], true );

		if ( isset( $signed_in['completed'] ) ) {
			array_push( $signed_in['completed'], $character_id );
		}
		else {
			$signed_in['completed'][] = $character_id;
		}

		$signed_in = json_encode( $signed_in );

		$arg['signed_in'] = $signed_in;
		$conditions['id'] = $plot_id;

		$result = Crud::update( 'plotball', $arg, $conditions );

		$plotball_status = new Plotball_Status();
		$plotball_status->resolve_plotball( $plot_id );

		return $result;
	}

	/**
	 * Sets the plotball to resolved if it is so far.
	 *
	 * @param  mixed $id The id of the plotball.
	 * @return void
	 */
	public static function resolve_plotball( $id ) {
		$signed_in = json_decode( Get_All_Plotballs::get_plotball_by_id( $id )[0]['signed_in'], true );
		if ( isset( $signed_in['completed'] ) ) {
			$completed = $signed_in['completed'];
			unset( $signed_in['completed'] );

			$characters = [];
			foreach ( $signed_in as $key => $character ) {
				array_push( $characters, $key );
			}

			if ( count( $completed ) === count( $characters ) ) {
				$arg['published'] = 4;
				$conditions['id'] = $id;

				Crud::update( 'plotball', $arg, $conditions );
			}
		}
	}
}
