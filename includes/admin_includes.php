<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;

$access = false;

$root_dir = dirname( __DIR__, 1 );
$dotenv   = Dotenv::createImmutable( $root_dir );
$dotenv->load();

if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
	require './joomla.php';

	if ( in_array( '30', $jgroups ) || in_array( '8', $jgroups ) || in_array( '7', $jgroups ) || in_array( '36', $jgroups ) ) {
		$access = true;
	}
}
else {
	$jgroups[] = 8;
	$access    = true;
}
