<?php

use frontier\ploball\database\update\Character_Participation;
use frontier\ploball\front\Double_Signup;

require './vendor/autoload.php';

switch ( $_POST['xf'] ) {
	case 'add_character_to_plotball':
		$result = Character_Participation::sign_up_for_plot( $_POST );
		echo $result;
		break;
	case 'sign_out_as_double':
		$result = Double_Signup::sign_me_out_as_double( $_POST );
		echo $result;
		break;
}
