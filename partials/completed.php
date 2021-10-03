<?php

use frontier\ploball\front\Plotball_Status;
use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs = Get_All_Plotballs::get_all_completed_plotballs();


?>

<div class="overview">
	<?php
	foreach ( $plotballs as $plotball ) {
		$id = $plotball['id'];
		?>
		<div class="item" id="item-<?php echo $id; ?>" data-id="<?php echo $id; ?>">
			<div class="item__main">
				<img alt="" class="type" src="assets/images/icons/<?php echo $plotball['type']; ?>.svg" />
				<div>
					<h2 class="title">
						<?php echo $plotball['title']; ?>
					</h2>
					Status: <?php echo Plotball_Status::get_current_status( $plotball['published'] ); ?>
				</div>
			</div>
			<div class="item__block">
			<?php
				$_GET['id'] = $id;
				require './partials/item_info.php';
			?>
			</div>
		</div>
	<?php } ?>
</div>
