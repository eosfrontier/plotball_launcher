<?php
	require '../includes/admin_includes.php';
	include '../includes/idandgroups.php';
	if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
		
	}
echo json_encode($jgroups);

if ( !(in_array("30", $jgroups) || in_array("8", $jgroups) || in_array("7", $jgroups )) ){
	echo 'Unauthorized';
	die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Admin for the plotball">
	<title>Plotball admin</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/admin.min.css" />
</head>
<body>
	<header>
		<div class="row">
			<picture>
				<img class="logo" src="../assets/images/talon.svg" />
			</picture>
			<button id="new-plotball">
				new plotball
			</button>
		</div>
	</header>
	<main>
		<div class="row">
			<div class="tabs">
				<div class="active tab-button" data-tab="timeline-table">
					Timeline
				</div>
				<div class="tab-button" data-tab="overview-table">
					Overview
				</div>
				<div class="tab-button" data-tab="archive-table">
					Archive
				</div>
			</div>
			<div class="timeline-table tab active">
				<?php require './partials/timeline_table.php'; ?>
			</div>
			<div class="overview-table tab">
				<button id="collapse-items" class="button">Collapse items</button>
				<div class="overview-tables">
					<?php require './partials/overview_table.php'; ?>
				</div>
			</div>
			<div class="archive-table tab">
				<div class="overview-tables">
				<?php require './partials/archive_table.php'; ?>
				</div>
			</div>
		</div>
	</main>
	<div class="modal edit-plotball-modal">
		<div class="modal__window">
		</div>
	</div>
	<?php require './partials/modal_new.php'; ?>
	<script src="../assets/admin/default.js"></script>
</body>
</html>
