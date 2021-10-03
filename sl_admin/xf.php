<?php

use frontier\ploball\front\Plotball_Status;
use frontier\ploball\database\delete\Delete_Plotball;
use frontier\ploball\database\insert\Insert_Plotball;
use frontier\ploball\database\update\Update_Plotball;
use frontier\ploball\database\delete\Remove_Characters;

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
	case 'move_to_draft':
		$result = Update_Plotball::move_to_draft( $_POST['id'] );
		echo $result;
		break;
	case 'move_to_publish':
		$result = Update_Plotball::move_to_publish( $_POST['id'] );
		echo $result;
		break;
	case 'move_to_double':
		$result = Update_Plotball::move_to_double( $_POST['id'] );
		echo $result;
		break;
	case 'move_to_active':
		$result = Update_Plotball::move_to_active( $_POST['id'] );
		echo $result;
		break;
	case 'move_to_completed':
		$result = Update_Plotball::move_to_completed( $_POST['id'] );
		echo $result;
		break;
	case 'move_to_archive':
		$result = Update_Plotball::move_to_archive( $_POST['id'] );
		echo $result;
		break;
	case 'delete_plotball':
		$result = Delete_Plotball::delete_ploball( $_POST['id'] );
		echo $result;
		break;
	case 'remove_character_from_validation':
		$result = Remove_Characters::remove_from_signup( $_POST['plot_id'], $_POST['character_id'] );
		echo $result;
		break;
	case 'remove_character_from_doubles':
		$result = Remove_Characters::remove_from_doubles( $_POST['plot_id'], $_POST['character_id'] );
		echo $result;
		break;
	case 'finish_task':
		$result = Plotball_Status::complete_task( $_POST['character_id'], $_POST['plot_id'] );
		echo $result;
		break;
}
