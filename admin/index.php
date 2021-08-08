<?php
	require '../includes/admin_includes.php';
	date_default_timezone_set( 'Europe/Amsterdam' );
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Admin for the plotball">
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
			<div class="overview-table">
				<button id="collapse-items" class="button">Collapse items</button>
				<?php require './partials/overview_table.php'; ?>
			</div>
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
			e.stopPropagation();
		});

		$('.modal__window').on("click", ".remove-validation", function() {
			$(this).parent().remove();
		})

		$("#collapse-items").click(function(){
			if($(".overview-table").hasClass('small')){
				$(".overview-table").removeClass("small");
				$(this).html('Collapse items');
			}else{
				$(".overview-table").addClass("small");
				$(this).html('Uncollapse items');
			}
		})
	</script>
</body>
</html>
