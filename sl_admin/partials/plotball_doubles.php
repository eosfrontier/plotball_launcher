<?php
use frontier\ploball\database\get\Character;
use frontier\ploball\front\Front_Validations;

?>
<div>
	<h2><?php echo $plotball['title']; ?></h2>
	<p>
		This plotball is has double signups at the moment.
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
		<strong>Loot (Visible to SL Only):</strong><br />
		<?php echo $plotball['loot']; ?>
	</p>
	<h3>Validations</h3>
	<div class="front-validations">
		<?php echo Front_Validations::show_requirements( $plotball['id'] ); ?>
	</div>
	<h3>Double Signups</h3>
	<?php
	$plot_id = $plotball['id'];
	foreach ( $doubles as $characters ) {
		echo '<div class="double_signups"><div>These people have signed up for the same thing.</div>';
		foreach ( $characters as $signed_in_character ) {
			$name = Character::get_active_character_by_id( $signed_in_character )['character_name'];
			echo "<span tabindex='0' class='small-image'>
			<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$signed_in_character.jpg' />
			<div class='hover-info'>
				<img loading='lazy' alt='' src='https://www.eosfrontier.space/eos_douane/images/mugs/$signed_in_character.jpg' />
				<span>$name</span>
				<form class='remove_character_from_double_form'>
					<input name='plot_id' type='hidden' value='$plot_id' />
					<input name='character_id' type='hidden' value='$signed_in_character' />
					<input name='xf' type='hidden' value='remove_character_from_doubles' />
					<div class='remove_character_from_double button'>Remove character</div>
				</form>
			</div>
		</span>";
		}
		echo '</div>';
	}
	?>
</div>
<?php require './move_to_published.php'; ?>
<?php require './move_to_active.php'; ?>
<?php require './move_to_archive.php'; ?>
<script src="../assets/admin/published.js"></script>
<script src="../assets/admin/update_plotball_status.js"></script>
