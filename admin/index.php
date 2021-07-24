<?php
	require '../includes/admin_includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Plotball admin</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../assets/css/admin.min.css" />
</head>
<body>
	<header>
		<div class="row">
			<button id="new-plotball">
				new plotball
			</button>
		</div>
	</header>
	<main>
		<div class="row">
		</div>
	</main>
	<?php require './partials/modal_new.php'; ?>
	<script>
		$("#new-plotball").click(function(){
			$('.modal').show();
		})

		$(".modal").click(function(){
			$(".modal").hide();
		}).children().click(function(e) {
			return false;
		});

		$('.modal__window').on("click", ".remove-validation", function() {
			console.log('hoi');
			$(this).parent().remove();
		})
	</script>
</body>
</html>
