<?php
	require './includes/includes.php';
	$random = rand( 0, 1000 );
	$logo   = 'talon';
	$class  = '';
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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<?php
	if ( $random === 666 ) {
		$class = 'comic';
		$logo  = 'talon_clown';
		?>
	<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./assets/css/font.min.css" />
	<?php } ?>
	<link rel="stylesheet" href="./assets/css/style.min.css" />
</head>
<body class="<?php echo $class; ?>">
	<header>
		<div class="row">
			<picture>
				<img class="logo" alt="" src="./assets/images/<?php echo $logo; ?>.svg" />
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
	<?php if ( $random === 666 ) { ?>
	<script>
		 var colours = ["#FF0000", "#990066", "#FF9966", "#996666", "#00FF00", "#CC9933"],
		idx;

		$(function() {
		var div = $('h1');
		var chars = div.text().split('');
		div.html('');
		for(var i=0; i<chars.length; i++) {
			idx = Math.floor(Math.random() * colours.length);
			var span = $('<span>' + chars[i] + '</span>').css("color", colours[idx]);
			div.append(span);
		}
	});
	</script>
	<?php } ?>
</body>
</html>
