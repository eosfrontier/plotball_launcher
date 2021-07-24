<?php

use frontier\ploball\database\admin\Skills;

$skills = Skills::get_all_skills_groups();

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

?>
<div class="modal">
	<div class="modal__window">
		<form method="post" id="plotball-form">
			<p>
				<label for="title-plotbal">
					Title plotball
				</label>
				<input id="title-plotbal" required name="title" type="text" />
			</p>
			<p>
				<label>
					Starting date & time
				</label>
				<input name="starting-date" type="date">
				<input name="starting-time" type="time">
			</p>
			<p>
				<label for="expected-runtime">
					Expected runtime in minutes
				</label>
				<input name="expected-runtime" required min="0" id="expected-runtime" step="10" type="number">
			</p>
			<p>
				<label for="expected-runtime">
					Plotball description for the players
				</label>
				<textarea name="message"></textarea>
			</p>
			<p id="main_skills">
				<label>
					Main skills validation
				</label>
				<button id="new_main_skill_button" onClick="add_main_skill()">
					New main skill validation
				</button>
			</p>
			<p id="special_skills">
				<label>
					Specialty skills validation
				</label>
				<button id="new_specialty_skill_button" onClick="add_specialty_skill()">
					New specialty skill validation
				</button>
			</p>
			<p id="special_skills">
				<label>
					Faction validation
				</label>
				<button id="new_faction_button" onClick="add_faction()">
					New specialty skill validation
				</button>
			</p>
			<p>
				<label>
					Type
				</label>
				<select name="type">
					<optgroup label="Plotgedreven">
						<option value="anticlima">Anti-Climax</option>
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
		</form>
	</div>
</div>

<script>
	function add_main_skill() {
		var date = + new Date();
		var html = `
			<div class="`+ date +` skill_row">
				
				<select class="" name="main_skills_validations[`+ date +`][skill]">
					<optgroup label="Main Skills">
						<?php echo $main_skills; ?>
					</optgroup>
				</select>
				<select class="" name="main_skills_validations[`+ date +`][argument]">
					<option value="1">Equal or lower</option>
					<option value="2">Exact equal</option>
					<option value="3">Equal or above</option>
				</select>
				<select class="" name="main_skills_validations[`+ date +`][level]">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<button class="remove-validation">Remove row</i>
			</div>
			
		`;		
		$("#new_main_skill_button").before(html);
	};

	function add_specialty_skill() {
		var date = + new Date();
		var html = `
			<div class="`+ date +` skill_row">
				<select class="" name="specialty_skills_validations[`+ date +`][skill]">
					<optgroup label="Specialty Skills">
						<?php echo $special_skills; ?>
					</optgroup>
				</select>
				<select class="" name="specialty_skills_validations[`+ date +`][argument]">
					<option value="1">Equal or lower</option>
					<option value="2">Exact equal</option>
					<option value="3">Equal or above</option>
				</select>
				<select class="" name="specialty_skills_validations[`+ date +`][level]">
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
				<button class="remove-validation">Remove row</i>
			</div>
		`;		
		$("#new_specialty_skill_button").before(html);
	};

	function add_faction() {
		var date = + new Date();
		var html = `
			<div class="`+ date +` skill_row">
				<select class="" name="faction_validations[`+ date +`][faction]">
					<optgroup label="Faction">
					<option value="aquila">Aquila</option>
					<option value="dugo">Dugo</option>
					<option value="ekanesh">Ekanesh</option>
					<option value="pendzal">Pendzal</option>
					<option value="sona">Sona</option>
					</optgroup>
				</select>
				<button class="remove-validation">Remove row</i>
			</div>
		`;		
		$("#new_faction_button").before(html);
	};

	
</script>
