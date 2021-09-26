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

		if ( $status === '2' ) {
			return 'Double signups';
		}

		if ( $status === '3' ) {
			return 'Active';
		}

		if ( $status === '4' ) {
			return 'Finished';
		}

		if ( $status === '5' ) {
			return 'Archived';
		}
	}
}
