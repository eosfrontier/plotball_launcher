<?php

use frontier\ploball\admin\insert\Insert_Plotball;
use frontier\ploball\admin\update\Publish_Plotball;
use frontier\ploball\admin\update\Update_Plotball;

require '../vendor/autoload.php';

switch ( $_POST['xf'] ) {
	case 'insert_plotball':
		$result = Insert_Plotball::insert( $_POST );
		echo $result;
		break;
	case 'update_plotball':
		$result = Update_Plotball::update( $_POST );
		echo $result;
		break;
	case 'publish_plotball':
		$result = Publish_Plotball::publish_plotball( $_POST['id'] );
		echo $result;
		break;
}
