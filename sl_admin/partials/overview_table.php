<?php

use frontier\ploball\admin\Sl;
use frontier\ploball\admin\Status;
use frontier\ploball\admin\Validations;
use frontier\ploball\database\get\Get_All_Plotballs;

$items = Get_All_Plotballs::get_all_plotballs();

foreach ( $items as $item ) {
	if ( $item['published'] !== '5' ) {
		?>
	<ul class="item" data-id="<?php echo $item['id']; ?>">
		<li style="pointer-events: none;" class="title"><?php echo $item['title']; ?></li>
		<li style="pointer-events: none;"><?php echo date( 'd-m-Y', strtotime( $item['starting_date'] ) ) . ' - ' . $item['starting_time']; ?></li>
		<li style="pointer-events: none;"><?php echo Sl::get_sl_by_id( $item['plot_owner'] ); ?></li>
		<li style="pointer-events: none;" class="validations"><?php echo Validations::get_overview_list( $item['validations'] ); ?></li>
		<li style="pointer-events: none;">Status: <?php echo Status::get_status_as_text( $item['published'] ); ?></li>
	</ul>
		<?php
	}
}
