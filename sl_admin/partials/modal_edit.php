<?php
require '../../vendor/autoload.php';

$id = $_GET['id'];


use frontier\ploball\admin\Sl;
use frontier\ploball\front\Double_Signup;
use frontier\ploball\database\get\Get_All_Plotballs;

$plotball = Get_All_Plotballs::get_plotball_by_id( $id )[0];

$bounce = explode( ',', $plotball['bounce'] );

$sls = Sl::get_all_sls();

$sl_list = '';
foreach ( $sls as $sl ) {
	$selected = '';
	if ( $sl['id'] === $plotball['plot_owner'] ) {
		$selected = ' selected';
	}
	$sl_list .= '<option value="' . $sl['id'] . '"' . $selected . '>' . $sl['name'] . '</option>';
}

if ( $plotball['published'] === '0' ) {
	require './plotball_draft.php';
}

if ( $plotball['published'] === '1' ) {
	require './plotball_published.php';
}

if ( $plotball['published'] === '2' ) {
	$doubles = Double_Signup::get_double_signups( $plotball['id'] );
	require './plotball_doubles.php';
}

if ( $plotball['published'] === '3' ) {
	$team = json_decode( $plotball['signed_in'], true );
	require './plotball_active.php';
}

if ( $plotball['published'] === '4' ) {
	$team = json_decode( $plotball['signed_in'], true );
	require './plotball_completed.php';
}

if ( $plotball['published'] === '5' ) {
	$team = json_decode( $plotball['signed_in'], true );
	require './plotball_archived.php';
}
