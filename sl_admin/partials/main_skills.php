<?php
require '../../vendor/autoload.php';

use frontier\ploball\admin\Skills;

$skills = Skills::get_all_skills_groups();

$main_skills = '';

foreach ( $skills as $skill ) {
	if ( $skill['parents'] === 'none' || $skill['parents'] === 'tele' ) {
		$main_skills .= '<option value="' . $skill['primaryskill_id'] . '">' . $skill['name'] . '</option>';
	}
}

echo $main_skills;
