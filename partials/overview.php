<?php

use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs = Get_All_Plotballs::get_all_active_plotballs();

?>

<div class="overview">
	<?php foreach ( $plotballs as $plotball ) { ?>
		<div class="item">
			<?php echo $plotball['title']; ?>
		</div>
	<?php } ?>
</div>
