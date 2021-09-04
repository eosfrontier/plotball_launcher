<?php
require '../../vendor/autoload.php';

$id = $_GET['id'];


use frontier\ploball\admin\Sl;
use frontier\ploball\admin\Validations;
use frontier\ploball\database\get\Get_All_Plotballs;

$plotball = Get_All_Plotballs::get_plotball_by_id( $id )[0];

$bounce = explode( ',', $plotball['bounce'] );

$sls = Sl::get_all_sls();

$sl_list = '';
foreach ( $sls as $sl ) {
	$selected = '';
	if ( $sl['id'] === $plotball['plot_owner'] ) {
		$selected = ' selected';
	}
	$sl_list .= '<option value="' . $sl['id'] . '"' . $selected . '>' . $sl['name'] . '</option>';
}

?>
<form method="post" id="update-plotball-form">
	<p>
		<label for="title-plotbal" class="required">
			Title plotball
		</label><br />
		<input id="title-plotbal" name="title" type="text" value="<?php echo $plotball['title']; ?>" required />
	</p>
	<p>
		<label for="new_form_type" class="required">
			Type
		</label><br />
		<select id="new_form_type" required name="type">
			<option disabled selected value>Select an option</option>
			<optgroup label="Plotgedreven">
				<option 
				<?php
				if ( $plotball['type'] === 'anticlimax' ) {
					echo 'selected';}
				?>
				value="anticlimax">Anti-Climax</option>
				<option 
				<?php
				if ( $plotball['type'] === 'climax' ) {
					echo 'selected';}
				?>
				value="climax">Climax</option>
				<option 
				<?php
				if ( $plotball['type'] === 'openended' ) {
					echo 'selected';}
				?>
				value="openended">Open ended</option>
			</optgroup>
			<optgroup label="Infodrip">
				<option 
				<?php
				if ( $plotball['type'] === 'mystery' ) {
					echo 'selected';}
				?>
				value="mystery">Mystery</option>
				<option 
				<?php
				if ( $plotball['type'] === 'noir' ) {
					echo 'selected';}
				?>
				value="noir">Noir</option>
				<option 
				<?php
				if ( $plotball['type'] === 'worldbuilding' ) {
					echo 'selected';}
				?>
				value="worldbuilding">Worldbuilding</option>
			</optgroup>
			<optgroup label="Planning">
				<option 
				<?php
				if ( $plotball['type'] === 'heist-coverup' ) {
					echo 'selected';}
				?>
				value="heist-coverup">Heist/coverup</option>
				<option 
				<?php
				if ( $plotball['type'] === 'strategy' ) {
					echo 'selected';}
				?>
				value="strategy">Strategy</option>
			</optgroup>
			<optgroup label="Talky">
				<option 
				<?php
				if ( $plotball['type'] === 'legal' ) {
					echo 'selected';}
				?>
				value="legal">Legal</option>
				<option 
				<?php
				if ( $plotball['type'] === 'philosophical' ) {
					echo 'selected';}
				?>
				value="philosophical">Philosophical</option>
				<option 
				<?php
				if ( $plotball['type'] === 'political' ) {
					echo 'selected';}
				?>
				value="political">Political</option>
			</optgroup>
		</select>
	</p>
	<p>
		<label for="new_plotball_date" class="required">
			Starting date
		</label><br />
		<label for="new_plotball_time" class="required">
			Starting time
		</label><br />
		<input name="starting_date" id="new_plotball_date" type="date" value="<?php echo $plotball['starting_date']; ?>" required>
		<input name="starting_time" id="new_plotball_time" type="time" value="<?php echo $plotball['starting_time']; ?>" required>
	</p>
	<p>
		<label for="expected-runtime" class="required">
			Expected runtime in minutes
		</label><br />
		<input name="expected_runtime" required min="0" id="expected-runtime" step="10" type="number" required  value="<?php echo $plotball['expected_runtime']; ?>">
	</p>
	<p>
		<label for="new_form_bounce" class="required">
			Bounce
		</label><br />
		<select id="new_form_bounce" name="bounce[]" class="bounce" required multiple>
			<option value="buff"
			<?php
			if ( in_array( 'buff', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Buff</option>
			<option value="faciliterende"
			<?php
			if ( in_array( 'faciliterende', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Faciliterende</option>
			<option value="factional"
			<?php
			if ( in_array( 'factional', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Factional</option>
			<option value="group"
			<?php
			if ( in_array( 'group', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Group</option>
			<option value="healing"
			<?php
			if ( in_array( 'healing', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Healing/Reparatie</option>
			<option value="item"
			<?php
			if ( in_array( 'item', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Item</option>
			<option value="multiplier"
			<?php
			if ( in_array( 'multiplier', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Multiplier</option>
			<option value="skill"
			<?php
			if ( in_array( 'skill', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Skill</option>
			<option value="skill_transfer"
			<?php
			if ( in_array( 'skill_transfer', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Skill transfer</option>
			<option value="threshold"
			<?php
			if ( in_array( 'threshold', $bounce, true ) ) {
				echo ' selected';}
			?>
			>Threshold</option>
		</select>
	</p>
	<p>
		<label for="new_form_plot_owner" class="required">
			Plot owner
		</label><br />
		<select id="new_form_plot_owner" name="plot_owner">
			<?php echo $sl_list; ?>
		</select>
	</p>
	<p>
		<label for="new_plotball_message" class="required">
			Plotball description for the players
		</label><br />
		<textarea id="new_plotball_message" name="message" placeholder="Roleplay-type description that the players will see." required><?php echo $plotball['message']; ?></textarea>
	</p>
	<div id="main_skills">
		<label>
			Main skills validation
		</label><br />

		<?php echo Validations::list_main_skills( $plotball['validations'] ); ?>

		<button id="new_main_skill_button" onClick="add_main_skill(); return false">
			New main skill validation
		</button>
	</div>
	<div id="special_skills">
		<label>
			Specialty skills validation
		</label><br />
		<?php echo Validations::list_specialty_skills( $plotball['validations'] ); ?>
		<button id="new_specialty_skill_button" onClick="add_specialty_skill(); return false">
			New specialty skill validation
		</button>
	</div>
	<div id="special_skills">
		<label>
			Faction validation
		</label><br />
		<?php echo Validations::list_faction( $plotball['validations'] ); ?>
		<button id="new_faction_button" onClick="add_faction(); return false">
			New Faction validation
		</button>
	</div>
	<p>
		<label for="new_form_custom_validation">
			Custom validation
		</label><br />
		<textarea id="new_form_custom_validation" name="custom_validation" placeholder="This field is optional">
<?php
if ( ! empty( json_decode( $plotball['validations'], true )['custom_validation'] ) ) {
	echo json_decode( $plotball['validations'], true )['custom_validation'];}
?>
</textarea>
	</p>
	<p>
		<label for="new_form_loot">
			Loot
		</label><br />
		<textarea id="new_form_loot" name="loot"><?php echo $plotball['loot']; ?></textarea>
	</p>
	<p>
		<label for="new_form_flavourtext">
			Flavour text after plot
		</label><br />
		<textarea id="new_form_flavourtext" name="flavourtext"><?php echo $plotball['flavourtext']; ?></textarea>
	</p>
	<div></div>
	<p>
		<button id="update_draft_button">Update draft</button>
		<button id="publish_plotball_button">Publish plotball</button>
	</p>
	<input type="hidden" name="xf" value="update_plotball">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
</form>
<p>
	<span class="warning">*</span> required fields.
</p>

<script>
jQuery("#update_draft_button").on('click', function (e) {
	e.preventDefault();
	var form_data = jQuery('#update-plotball-form').serialize();
	$.ajax({
		url: "xf.php",
		type: "post",
		data: form_data
	}).done(function (response) {
		if(response == 1){
			hideModal();
		}
	});
});

jQuery("#publish_plotball_button").on('click', function (e) {
	e.preventDefault();
	var form_data = {id: $( 'input[name="id"]' ).val(), xf: 'publish_plotball'};
	$.ajax({
		url: "xf.php",
		type: "post",
		data: form_data
	}).done(function (response) {
		if(response == 1){
			hideModal();
		}
	})
});
</script>
