<?php

use frontier\ploball\admin\insert\Insert_Plotball;

require '../vendor/autoload.php';

switch ( $_POST['xf'] ) {
	case 'insert_plotball':
		$result = Insert_Plotball::insert( $_POST );
		echo $result;
		break;
}
