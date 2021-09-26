<?php

require './vendor/autoload.php';

use Dotenv\Dotenv;

$root_dir = dirname( __DIR__, 1 );
$dotenv   = Dotenv::createImmutable( $root_dir );
$dotenv->load();

if ( ! isset( $_SESSION ) ) {
	// session_start();
}

if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
	require_once 'SSO.php';
}
else {
	$jid = 736;
}
