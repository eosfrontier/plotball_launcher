<?php

use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs   = Get_All_Plotballs::get_all_plotballs();
$timestamped = [];

foreach ( $plotballs as $plotball ) {
	$timestamps[ $plotball['starting_date'] ][] = $plotball;
}

?>

<div class="timeline-tables">
	<div class="color-explanation">
		<div class="draft">
			<span></span>Draft
		</div>
		<div class="published">
			<span></span>Published
		</div>
		<div class="doubles">
			<span></span>Double signups
		</div>
		<div class="active">
			<span></span>Active
		</div>
		<div class="finished">
			<span></span>Finished
		</div>
		<div class="archived">
			<span></span>Archived
		</div>
	</div>

	<?php
	foreach ( $timestamps as $key => $timestamp ) {
		?>
		<div class="timeline-item">
			<h3><?php echo date( 'd-m-Y', strtotime( $key ) ); ?></h3>

			<div class="scrolling">
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
						$class   = '';
						if ( $plotball['published'] === '1' ) {
							$class = ' published';
						}
						if ( $plotball['published'] === '2' ) {
							$class = ' doubles';
						}
						if ( $plotball['published'] === '3' ) {
							$class = ' active';
						}
						if ( $plotball['published'] === '4' ) {
							$class = ' finished';
						}
						if ( $plotball['published'] === '5' ) {
							$class = ' archived';
						}
						?>
						<tr>
							<td>
								<div style="left: <?php echo $minutes; ?>%; width:<?php echo $length; ?>%" class="timeline-plotball<?php echo $class; ?>" data-id="<?php echo $plotball['id']; ?>">
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
		</div>
		<?php
	}
	?>
</div>
