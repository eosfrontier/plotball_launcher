<?php
namespace frontier\ploball\database\admin;

use frontier\ploball\database\Get;
class Sl {

	/**
	 * Returns all Sl's with name and id. Because Silvester wanted a more descriptive comment.
	 *
	 * @return array
	 */
	public static function get_all_sls():array {

		$user_ids = Get::get( 'SELECT * FROM jml_user_usergroup_map WHERE group_id = 30' )->fetchAll();
		$id_array = '';

		foreach ( $user_ids as $user_id ) {
			$id_array .= $user_id['user_id'] . ',';
		}

		$id_array = substr( $id_array, 0, -1 );
		$sls      = Get::get( 'SELECT id, name FROM jml_users WHERE id IN (' . $id_array . ')' )->fetchAll();

		return $sls;
	}
}
