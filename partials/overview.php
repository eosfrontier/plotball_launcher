<?php

use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs = Get_All_Plotballs::get_all_active_plotballs();

?>

<div class="overview">
	<?php foreach ( $plotballs as $plotball ) { ?>
		<div class="item">
			<img class="type" src="assets/images/icons/<?php echo $plotball['type']; ?>.svg" />
			<?php echo $plotball['title']; ?>
		</div>
	<?php } ?>
</div>
