<?php

require '../vendor/autoload.php';

$access = false;

if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
	require '.joomla.php';

	if ( in_array( '30', $jgroups ) || in_array( '8', $jgroups ) || in_array( '7', $jgroups ) || in_array( '36', $jgroups ) ) {
		$access = true;
	}
}
else {
	$jgroups[] = 8;
	$access    = true;
}
