<?php
require '../../vendor/autoload.php';

$id = $_GET['id'];


use frontier\ploball\admin\Sl;
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
	require './modal_edit_draft.php';
}
