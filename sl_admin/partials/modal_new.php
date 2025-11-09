<?php

use frontier\ploball\admin\Sl;
use frontier\ploball\admin\Skills;

$skills = Skills::get_all_skills_groups();
$sls    = Sl::get_all_sls();

$main_skills = '';

foreach ( $skills as $skill ) {
	if ( $skill['parents'] === 'none' || $skill['parents'] === 'tele' ) {
		$main_skills .= '<option value="' . $skill['primaryskill_id'] . '">' . $skill['name'] . '</option>';
	}
}

$special_skills = '';
foreach ( $skills as $skill ) {
	if ( $skill['parents'] !== 'none' ) {
		$special_skills .= '<option value="' . $skill['primaryskill_id'] . '">' . $skill['name'] . '</option>';
	}
}

$sl_list = '';
foreach ( $sls as $sl ) {
	$sl_list .= '<option value="' . $sl['id'] . '">' . $sl['name'] . '</option>';
}

?>
<div class="modal new-plotball-modal">
	<div class="modal__window">
		<form method="post" id="new-plotball-form">
			<p>
				<label for="title-plotbal" class="required">
					Title plotball
				</label><br />
				<input id="title-plotbal" name="title" type="text" required />
			</p>
			<p>
				<label for="new_form_type">
					Type
				</label><br />
				<select id="new_form_type" name="type" value="NULL">
					<option disabled selected value>Select an option</option>
					<optgroup label="Plotgedreven">
						<option value="anticlimax">Anti-Climax</option>
						<option value="climax">Climax</option>
						<option value="openended">Open ended</option>
					</optgroup>
					<optgroup label="Infodrip">
						<option value="mystery">Mystery</option>
						<option value="noir">Noir</option>
						<option value="worldbuilding">Worldbuilding</option>
					</optgroup>
					<optgroup label="Planning">
						<option value="heist-coverup">Heist/coverup</option>
						<option value="strategy">Strategy</option>
					</optgroup>
					<optgroup label="Talky">
						<option value="legal">Legal</option>
						<option value="philosophical">Philosophical</option>
						<option value="political">Political</option>
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
				<input name="starting_date" id="new_plotball_date" type="date" required>
				<input name="starting_time" id="new_plotball_time" type="time" required>
			</p>
			<p>
				<label for="expected-runtime" class="required">
					Expected runtime in minutes
				</label><br />
				<input name="expected_runtime" required min="0" id="expected-runtime" step="10" type="number" required>
			</p>
			<p>
				<label for="new_form_bounce">
					Bounce
				</label><br />
				<select id="new_form_bounce" class="bounce" name="bounce[]" required multiple value="NULL">
					<option value ="NULL" selected>N/A</option>
					<option value="buff">Buff</option>
					<option value="faciliterende">Faciliterende</option>
					<option value="factional">Factional</option>
					<option value="group">Group</option>
					<option value="healing">Healing/Reparatie</option>
					<option value="item">Item</option>
					<option value="multiplier">Multiplier</option>
					<option value="skill">Skill</option>
					<option value="skill_transfer">Skill transfer</option>
					<option value="threshold">Threshold</option>
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
				<textarea id="new_plotball_message" name="message" placeholder="Roleplay-type description that the players will see." required></textarea>
			</p>
			<p id="main_skills">
				<label>
					Main skills validation
				</label><br />
				<button id="new_main_skill_button" onClick="add_main_skill(); return false">
					New main skill validation
				</button>
			</p>
			<p id="special_skills">
				<label>
					Specialty skills validation
				</label><br />
				<button id="new_specialty_skill_button" onClick="add_specialty_skill(); return false">
					New specialty skill validation
				</button>
			</p>
			<p id="special_skills">
				<label>
					Faction validation
				</label><br />
				<button id="new_faction_button" onClick="add_faction(); return false">
					New Faction validation
				</button>
			</p>
			<p>
				<label for="new_form_custom_validation">
					Custom validation
				</label><br />
				<textarea id="new_form_custom_validation" name="custom_validation" placeholder="This field is optional"></textarea>
			</p>
			<p>
				<label for="new_form_loot">
					Loot (Visible to SL Only)
				</label><br />
				<textarea id="new_form_loot" name="loot"></textarea>
			</p>
			<p>
				<label for="new_form_flavourtext">
					Flavour text after plot
				</label><br />
				<textarea id="new_form_flavourtext" name="flavourtext"></textarea>
			</p>
			<div></div>
			<p>
				<button id="new_form_save_draft">Save draft</button>
			</p>
			<input type="hidden" name="xf" value="insert_plotball">
		</form>
		<p>
			<span class="warning">*</span> required fields.
		</p>
	</div>
</div>

<script src="../assets/admin/modal_new.js"></script>
