<?php

require getcwd() . '/vendor/autoload.php';

use frontier\ploball\front\Double_Signup;
use frontier\ploball\front\Plotball_Status;
use frontier\ploball\database\get\Character;
use frontier\ploball\front\Front_Validations;
use frontier\ploball\database\get\Get_All_Plotballs;

if ( ! isset( $_GET['id'] ) ) {
	return false;
}
$plotball              = Get_All_Plotballs::get_plotball_by_id( $_GET['id'] )['0'];
$character             = Character::get_active_character_by_jid( $jid );
$character_id          = $character['characterID'];
$character_faction     = $character['faction'];
$character_skills      = Character::get_character_skills_by_id( $character_id );
$validations           = $plotball['validations'];
$character_validations = $plotball['characters'];
$status                = $plotball['published'];
$plot_id               = $_GET['id'];
if ( $status === '3' || $status === '4' ) {
	$team = json_decode( $plotball['signed_in'], true );
}
?>

<div class="item__info">
	<h3>
		Description
	</h3>
	<p class="description">
		<?php echo nl2br( $plotball['message'] ); ?>
	</p>
</div>
<div class="item__info">
	<h3>
		Requirements
	</h3>
	<p>
		We require people that have these skills or are members from these Factions.
	</p>
	<div class="validations">
		<?php echo Front_Validations::show_requirements( $plotball['id'] ); ?>
	</div>
	<?php if ( $plotball['published'] === '1' ) { ?>
	<button class="button participate-button">I want to participate</button>
	<?php } ?>
</div>
<div class="item__signup">
	<form class="character_signup">
		<div class="item__signup__image">
			<img loading="lazy" alt="" src="https://www.eosfrontier.space/eos_douane/images/mugs/<?php echo $character_id; ?>.jpg" />
		</div>
		<div class="checkbox_holder">
			<?php echo Front_Validations::show_checkboxes( $character_skills, $validations, $character_faction ); ?>
		</div>
		<div class="break"></div>
		<input class="sign_up_button button" type="submit" value="Sign up" />
		<input type="hidden" name="xf" value="add_character_to_plotball" />
		<input type="hidden" name="plot_id" value="<?php echo $plot_id; ?>" />
		<input type="hidden" name="character_id" value="<?php echo $character_id; ?>" />
	</form>
	<div class="signup_info signup_1">
		Sign up succesful. Page will reload in 5 seconds.
	</div>
	<div class="signup_info signup_2">
		All requirements are filled. But there are double. Page will reload in 5 seconds.
	</div>
	<div class="signup_info signup_3">
		All requirements are filled. Page will reload in 5 seconds.
	</div>
	<div class="signup_info signup_none">
		You have withdrawn from the task. Page will reload in 5 seconds.
	</div>
</div>
<?php if ( $status === '2' ) { ?>
	<div class="item__double">
		<h3>Resolve multiple signups</h3>

		<?php
		$doubles = Double_Signup::get_double_signups( $plotball['id'] );
		$problem = 0;
		foreach ( $doubles as $characters ) {
			echo '<div class="double_signups"><div>These people have signed up for the same thing. They need to choose who participates and who doesn\'t.</div>';
			foreach ( $characters as $signed_in_character ) {
				if ( $signed_in_character === intval( $character_id ) ) {
					$problem = 1;
				}
				$name = Character::get_active_character_by_id( $signed_in_character )['character_name'];
				echo "<span tabindex='0' class='small-image'>
				<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$signed_in_character.jpg' />
				<div class='hover-info'>
					<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$signed_in_character.jpg' />
					<span>$name</span>
				</div>
			</span>";
			}
			echo '</div>';
		}

		if ( $problem === 1 ) {
			?>
			<form class="double_signout_form">
				It seems that you're signed up with someone for the same thing. Do you want to sign out so that the other can participate? <br />
				<input type="hidden" name="character_id" value="<?php echo $character_id; ?>" />
				<input type="hidden" name="plot_id" value="<?php echo $plot_id; ?>" />
				<input type="hidden" name="xf" value="sign_out_as_double" />
				<input class="double_signout_button button" type="submit" value="Sign out" />
			</form>
			<div class="signup_info signup_2">
				There are still double signups. Page will reload in 5 seconds.
			</div>
			<div class="signup_info signup_3">
				All requirements are filled. Page will reload in 5 seconds.
			</div>
			<?php
		}
		?>
	</div>
<?php } ?>
<?php if ( $status === '3' ) { ?>
	<div class="item__double">
		<h3>Current team</h3>
		<?php
		$active = [];
		foreach ( $team as $key => $team_member ) {
			if ( $key !== 'completed' ) {
				$name     = Character::get_active_character_by_id( $key )['character_name'];
				$finished = '';
				if ( isset( $team['completed'] ) && in_array( $key, $team['completed'] ) ) {
					$finished = '<br />has completed their task.';
				}
				echo "<span tabindex='0' class='small-image'>
			<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
			<div class='hover-info'>
				<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
				<span>$name</span>$finished
			</div>
		</span>";
			}
		}

		if ( Plotball_Status::can_complete_task( $team, $character_id ) ) {
			?>
		<form class="resolve_task_form">
			<input type="hidden" name="character_id" value="<?php echo $character_id; ?>" />
			<input type="hidden" name="plot_id" value="<?php echo $plot_id; ?>" />
			<input type="hidden" name="xf" value="resolve_task" />
			<input class="resolve_task_button button" type="submit" value="Resolve my task" />
		</form>
		<div class="signup_info signup_1">
			Thank you for completing your task. Page will reload in 5 seconds.
		</div>
			<?php
		}
		?>
	</div>
<?php } ?>
<?php if ( $status === '4' ) { ?>
	<div class="item__double">
		<h3>Current team</h3>
		<?php
		$active = [];
		foreach ( $team as $key => $team_member ) {
			if ( $key !== 'completed' ) {
				$name     = Character::get_active_character_by_id( $key )['character_name'];
				$finished = '';
				if ( isset( $team['completed'] ) && in_array( $key, $team['completed'] ) ) {
					$finished = '<br />has completed their task.';
				}
				echo "<span tabindex='0' class='small-image'>
			<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
			<div class='hover-info'>
				<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
				<span>$name</span>$finished
			</div>
		</span>";
			}
		}

		?>
	</div>
	<?php
}
if ( ! empty( $plotball['flavourtext'] && $status === '4' ) ) {
	?>
	<div class="item__double">
		<h3>Task finished</h3>
	<?php echo $plotball['flavourtext']; ?>
	</div>
<?php } ?>
