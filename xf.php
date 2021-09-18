<?php

use frontier\ploball\database\update\Character_Participation;

require './vendor/autoload.php';

switch ( $_POST['xf'] ) {
	case 'add_character_to_plotball':
		$result = Character_Participation::sign_up_for_plot( $_POST );
		echo $result;
		break;
}
