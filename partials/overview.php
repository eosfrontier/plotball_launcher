<?php

use frontier\ploball\front\Plotball_Status;
use frontier\ploball\database\get\Get_All_Plotballs;

$plotballs = Get_All_Plotballs::get_all_active_plotballs();


?>

<div class="overview">
	<?php
	foreach ( $plotballs as $plotball ) {
		$id = $plotball['id'];
		?>
		<div class="item" id="item-<?php echo $id; ?>" data-id="<?php echo $id; ?>">
			<div class="item__main">
				<img alt="" class="type" src="assets/images/icons/<?php echo $plotball['type']; ?>.svg" />
				<div>
					<h2 class="title">
						<?php echo $plotball['title']; ?>
					</h2>
					Status: <?php echo Plotball_Status::get_current_status( $plotball['published'] ); ?>
				</div>
			</div>
			<div class="item__block">
			<?php
				$_GET['id'] = $id;
				require './partials/item_info.php';
			?>
			</div>
		</div>
	<?php } ?>
</div>
<script>
	jQuery(".participate-button").unbind().on("click", function(){
		jQuery(this).parent().next().slideToggle();
	})

	jQuery( ".character_signup" ).unbind().on( 'submit', function(e) {
		e.preventDefault();
		var form_data = jQuery( this ).serialize();
		var object = jQuery( this.offsetParent );
		var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery(object).attr("id");

		jQuery( object ).find(".sign_up_button").hide();

		$.ajax( {
			url: "xf.php",
			type: "post",
			data: form_data
		} ).done( function( response ) {
			if(response === "1"){
				jQuery( object ).find(".signup_1").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}

			if(response === "2"){
				jQuery( object ).find(".signup_2").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}

			if(response === "3"){
				jQuery( object ).find(".signup_3").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}

		} );
	} );

	jQuery(".item__main").click(function(e){
		jQuery(this).parent(".item").toggleClass("active");
	})

	jQuery( document ).ready(function() {
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const item = urlParams.get('item')

		if(item !== null){
			const id = "#" + item;
			if(jQuery(id).length){
			jQuery(id).addClass("active");
				jQuery([document.documentElement, document.body]).animate({
					scrollTop: $(id).offset().top
				}, 500);
			}
		}
	})

	jQuery( ".double_signout_form" ).unbind().on( 'submit', function(e) {
		e.preventDefault();
		var form_data = jQuery( this ).serialize();
		var object = jQuery( this.offsetParent );
		var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery(object).attr("id");

		jQuery( object ).find(".double_signout_button").hide();

		$.ajax( {
			url: "xf.php",
			type: "post",
			data: form_data
		} ).done( function( response ) {
			if(response === "2"){
				jQuery( object ).find(".signup_2").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}

			if(response === "3"){
				jQuery( object ).find(".signup_3").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}

		} );
	} );

	jQuery( ".resolve_task_form" ).unbind().on( 'submit', function(e) {
		e.preventDefault();
		var form_data = jQuery( this ).serialize();
		var object = jQuery( this.offsetParent );
		var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery(object).attr("id");

		jQuery( object ).find(".resolve_task_button").hide();

		$.ajax( {
			url: "xf.php",
			type: "post",
			data: form_data
		} ).done( function( response ) {
			console.log(response);
			if(response === "1"){
				jQuery( object ).find(".signup_1").show();
				setTimeout(function(){
					window.location.href = url;
				}, 5000);
			}
		} );
	} );
</script>
