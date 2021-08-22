var main_skills = "";
var spacialty_skills = "";

$.get( 'partials/main_skills.php', function( html_string ) {
	main_skills = html_string;
}, 'html' );

$.get( 'partials/specialty_skills.php', function( html_string ) {
	spacialty_skills = html_string;
}, 'html' );

function add_main_skill( e ) {
	$( '#new-plotball-form' ).submit( function( e ) {
		e.preventDefault();
	} )

	var date = + new Date() + Math.floor( Math.random() * 100 );
	var html = `
		<div class="`+ date + ` skill_row">			
			<select class="" name="main_skills_validations[`+ date + `][skill]">
				<optgroup label="Main Skills">
					` + main_skills + `
				</optgroup>
			</select>
			<select class="" name="main_skills_validations[`+ date + `][argument]">
				<option value="1">Equal or lower</option>
				<option value="2">Exact equal</option>
				<option value="3">Equal or above</option>
			</select>
			<select class="" name="main_skills_validations[`+ date + `][level]">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<button class="remove-validation">Remove row 🗑️</i>
		</div>		
	`;
	$( "#new_main_skill_button" ).before( html );
};

function add_specialty_skill() {
	$( '#new-plotball-form' ).submit( function( e ) {
		e.preventDefault();
	} )
	var date = + new Date() + Math.floor( Math.random() * 100 );
	var html = `
		<div class="`+ date + ` skill_row">
			<select class="" name="specialty_skills_validations[`+ date + `][skill]">
				<optgroup label="Specialty Skills">
					` + spacialty_skills + `
				</optgroup>
			</select>
			<select class="" name="specialty_skills_validations[`+ date + `][argument]">
				<option value="1">Equal or lower</option>
				<option value="2">Exact equal</option>
				<option value="3">Equal or above</option>
			</select>
			<select class="" name="specialty_skills_validations[`+ date + `][level]">
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
			<button class="remove-validation">Remove row</i>
		</div>
	`;
	$( "#new_specialty_skill_button" ).before( html );
};

function add_faction() {
	$( '#new-plotball-form' ).submit( function( e ) {
		e.preventDefault();
	} )
	var date = + new Date() + Math.floor( Math.random() * 100 );
	var html = `
		<div class="`+ date + ` skill_row">
			<select class="" name="faction_validations[`+ date + `][faction]">
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
	$( "#new_faction_button" ).before( html );
};



jQuery( "#new-plotball-form" ).on( 'submit', function() {
	var form_data = jQuery( '#new-plotball-form' ).serialize();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		hideModal();
	} );
} );