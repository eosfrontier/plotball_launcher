<?php
use frontier\ploball\front\Front_Validations;

?>
<div>
	<h3><?php echo $plotball['title']; ?></h3>
	<p>
		This plotball is published at the moment.
	</p>
	<p>
		<strong>Description:</strong><br />
		<?php echo $plotball['message']; ?>
	</p>
	<p>
		<strong>Flavour text after plot:</strong><br />
		<?php echo $plotball['flavourtext']; ?>
	</p>
	<p>
		<strong>Loot (Visible to SL Only):</strong><br />
		<?php echo $plotball['loot']; ?>
	</p>
	<h3>Validations</h3>
	<div class="front-validations">
		<?php echo Front_Validations::show_requirements( $plotball['id'], true ); ?>
	</div>
</div>
<?php require './move_to_draft.php'; ?>
<?php require './move_to_archive.php'; ?>
<script src="../assets/admin/published.js"></script>
<script src="../assets/admin/update_plotball_status.js"></script>
