<?php

use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs = Get_All_Plotballs::get_all_active_plotballs();


?>

<div class="overview">
	<?php
	foreach ( $plotballs as $plotball ) {
		$id = $plotball['id'];
		?>
		<div class="item" data-id="<?php echo $id; ?>">
			<span class="flourish flourish__left-top"></span>
			<span class="flourish flourish__left-bottom"></span>
			<span class="flourish flourish__right-top"></span>
			<span class="flourish flourish__right-bottom"></span>
			<div class="item__main">
				<img class="type" src="assets/images/icons/<?php echo $plotball['type']; ?>.svg" />
				<h2 class="title">
					<?php echo $plotball['title']; ?>
				</h2>
			</div>
			<?php
				$_GET['id'] = $id;
				require './partials/item_info.php';
			?>
		</div>
	<?php } ?>
</div>
