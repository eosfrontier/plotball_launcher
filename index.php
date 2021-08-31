<?php
	require './includes/includes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Talon - the tool for getting stuff done.">
	<title>Talon</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="./assets/css/style.min.css" />
</head>
<body>
	<header>
		<div class="row">
			<picture>
				<img class="logo" alt="" src="./assets/images/talon.svg" />
			</picture>
			<h1>
				Talon
			</h1>
		</div>
	</header>
	<main>
		<div>
			<div class="row">
				<?php require './partials/overview.php'; ?>
			</div>
		</div>
	</main>
</body>
</html>
