<?php
namespace frontier\ploball\admin;

class Status {

	public static function get_status_as_text( $status ): string {
		if ( $status === '0' ) {
			return 'Draft';
		}

		if ( $status === '1' ) {
			return 'Published';
		}
	}
}
