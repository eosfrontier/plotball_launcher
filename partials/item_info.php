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
	<button class="button participate-button">I want to participate</button>
</div>
<div class="item__signup">
	<form class="character_signup">
		<div class="item__signup__image">
			<img loading="lazy" src="https://www.eosfrontier.space/eos_douane/images/mugs/<?php echo $character_id; ?>.jpg" />
		</div>
		<div>
			<?php echo Front_Validations::show_checkboxes( $character_skills, $validations, $character_faction ); ?>
		</div>
		<div class="break"></div>
		<input class="sign_up_button button" type="submit" value="Sign up" />
		<input type="hidden" name="xf" value="add_character_to_plotball" />
		<input type="hidden" name="plot_id" value="<?php echo $_GET['id']; ?>" />
		<input type="hidden" name="character_id" value="<?php echo $character_id; ?>" />
	</form>
</div>
