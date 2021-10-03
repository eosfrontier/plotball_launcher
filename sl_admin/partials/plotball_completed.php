<?php
use frontier\ploball\database\get\Character;
use frontier\ploball\front\Front_Validations;

?>
<div>
	<h2><?php echo $plotball['title']; ?></h2>
	<p>
		This plotball is completed at the moment.
	</p>
	<p>
		<strong>Description:</strong><br />
		<?php echo $plotball['message']; ?>
	</p>
	<p>
		<strong>Flavour text after plot:</strong><br />
		<?php echo $plotball['flavourtext']; ?>
	</p>
	<p>
		<strong>Loot:</strong><br />
		<?php echo $plotball['loot']; ?>
	</p>
	<h3>Validations</h3>
	<div class="front-validations">
		<?php echo Front_Validations::show_requirements( $plotball['id'] ); ?>
	</div>
	<h3>Current team</h3>
	<?php
	$plot_id = $plotball['id'];
	foreach ( $team as $key => $team_member ) {
		if ( $key !== 'completed' ) {
			$name     = Character::get_active_character_by_id( $key )['character_name'];
			$finished = '';
			$finish   = 0;
			if ( isset( $team['completed'] ) && in_array( $key, $team['completed'] ) ) {
				$finished = '<br />has completed their task.';
				$finish   = 1;
			}
			$html = "<span tabindex='0' class='small-image'>
			<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
			<div class='hover-info'>
				<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$key.jpg' />
				<span>$name</span>$finished";
			if ( $finish === 0 ) {
				$html .= "<form class='resolve_task_form'>
				<input name='plot_id' type='hidden' value='$plot_id' />
				<input name='character_id' type='hidden' value='$key' />
				<input name='xf' type='hidden' value='finish_task' />
				<div class='resolve_task button'>Resolve task</div>
			</form>";
			}
			$html .= '</div>
			</span>';
			echo $html;
		}
	}

	?>
</div>
<?php require './move_to_published.php'; ?>
<?php require './move_to_active.php'; ?>
<?php require './move_to_archive.php'; ?>
<script src="../assets/admin/published.js"></script>
<script src="../assets/admin/update_plotball_status.js"></script>
