<?php

use frontier\ploball\admin\get\Get_All_Plotballs;

$plotballs   = Get_All_Plotballs::get_all_plotballs();
$timestamped = [];

foreach ( $plotballs as $plotball ) {
	$timestamps[ $plotball['starting_date'] ][] = $plotball;
}

?>

<div class="timeline-tables">
	<?php
	foreach ( $timestamps as $key => $timestamp ) {
		?>
		<div class="timeline-item">
			<h3><?php echo date( 'd-m-Y', strtotime( $key ) ); ?></h3>

			<table cellspacing="0" cellpadding="0" class="timeline-table">
				<thead>
					<td>00:00</td>
					<td>01:00</td>
					<td>02:00</td>
					<td>03:00</td>
					<td>04:00</td>
					<td>05:00</td>
					<td>06:00</td>
					<td>07:00</td>
					<td>08:00</td>
					<td>09:00</td>
					<td>10:00</td>
					<td>11:00</td>
					<td>12:00</td>
					<td>13:00</td>
					<td>14:00</td>
					<td>15:00</td>
					<td>16:00</td>
					<td>17:00</td>
					<td>18:00</td>
					<td>19:00</td>
					<td>20:00</td>
					<td>21:00</td>
					<td>22:00</td>
					<td>23:00</td>
					
				</thead>
				<?php
				foreach ( $timestamp as $plotball ) {
					$time    = explode( ':', $plotball['starting_time'] );
					$minutes = ( ( ( $time[0] ) * 60 + $time[1] ) / 14.4 );
					$length  = ( $plotball['expected_runtime'] / 14.4 );
					?>
					<tr>
						<td>
							<div style="left: <?php echo $minutes; ?>%; width:<?php echo $length; ?>%" class="timeline-plotball" data-id="<?php echo $plotball['id']; ?>">
								<span><?php echo $plotball['title']; ?></span>
							</div>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php
	}
	?>
</div>
