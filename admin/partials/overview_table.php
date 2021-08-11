<?php

use frontier\ploball\admin\Sl;
use frontier\ploball\admin\Status;
use frontier\ploball\admin\Validations;
use frontier\ploball\admin\get\Get_All_Plotballs;

$items = Get_All_Plotballs::get_all_plotballs();

foreach ( $items as $item ) {
	?>
	<ul class="item">
		<li class="title"><?php echo $item['title']; ?></li>
		<li><?php echo gmdate( 'd-m-Y H:i', $item['start_date'] ); ?></li>
		<li><?php echo Sl::get_sl_by_id( $item['plot_owner'] ); ?></li>
		<li class="validations"><?php echo Validations::get_overview_list( $item['validations'] ); ?></li>
		<li>Status: <?php echo Status::get_status_as_text( $item['published'] ); ?></li>
	</ul>
	<?php
}
