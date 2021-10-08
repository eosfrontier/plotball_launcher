<?php

require '../vendor/autoload.php';

if ( ! isset( $_SESSION ) ) {
	// session_start();
}
if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
	require 'SSO.php';
}
else {
	$jid = 736;
}