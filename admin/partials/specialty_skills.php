<?php
require '../../vendor/autoload.php';

use frontier\ploball\admin\Skills;

$skills = Skills::get_all_skills_groups();

$special_skills = '';
foreach ( $skills as $skill ) {
	if ( $skill['parents'] !== 'none' ) {
		$special_skills .= '<option value="' . $skill['primaryskill_id'] . '">' . $skill['name'] . '</option>';
	}
}

echo $special_skills;
