jQuery(".update_plotball_status").on('submit', function (e) {
	e.preventDefault();
	var form_data = jQuery(this).serialize();
	// 1. Parse the string
	var params = new URLSearchParams(form_data);
	// 2. Get the specific value
	var xfValue = params.get('xf');
	console.log(xfValue);
	switch (xfValue) {
		case "delete_plotball":
			var answer = window.confirm("Are you sure you want to delete this plotball?");
			break;
		case "move_to_archive":
			var answer = window.confirm("Are you sure you want to archive this plotball?");
			break;
		case "move_to_completed":
			var answer = window.confirm("Are you sure you want to mark this plotball as completed?");
			break;
		case "move_to_active":
			var answer = window.confirm("Are you sure you want to mark this plotball as active?");
			break;
		case "move_to_published":
			var answer = window.confirm("Are you sure you want to mark this plotball as published?");
			break;
		case "move_to_draft":
			var answer = window.confirm("Are you sure you want to mark this plotball as draft?");
			break;
		default:
			var answer = false;
	}
	if (answer === true) {
		$.ajax({
			url: "xf.php",
			type: "post",
			data: form_data
		}).done(function (response) {
			if (response === "1") {
				hideModal();
			}
		});
	}
});
