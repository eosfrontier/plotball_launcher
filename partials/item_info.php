<?php

require getcwd() . '/vendor/autoload.php';

use frontier\ploball\database\get\Character;
use frontier\ploball\database\get\Get_All_Plotballs;
use frontier\ploball\front\Front_Validations;

if ( ! isset( $_GET['id'] ) ) {
	return false;
}
$plotball          = Get_All_Plotballs::get_plotball_by_id( $_GET['id'] )['0'];
$character         = Character::get_active_character_by_jid( $jid );
$character_id      = $character['characterID'];
$character_faction = $character['faction'];
$character_skills  = Character::get_character_skills_by_id( $character_id );
$validations       = $plotball['validations'];
?>

<div class="item__info">
	<h3>
		Description
	</h3>
	<p class="description">
		<?php echo nl2br( $plotball['message'] ); ?>
	</p>
	<h3>
		Requirements
	</h3>
	<p>
		We require people that have these skills or are members from these Factions.
	</p>
	<div class="validations">
		<?php echo Front_Validations::show_requirements( $validations ); ?>
	</div>
</div>
<div class="item__signup">
	<?php echo Front_Validations::show_checkboxes( $character_skills, $validations, $character_faction ); ?>
</div>

