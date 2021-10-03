jQuery( ".remove_character_from_validation" ).on( 'click', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).parent().serialize();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		if ( response === "1" ) {
			hideModal();
		}
	} );
} );

jQuery( ".remove_character_from_double" ).on( 'click', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).parent().serialize();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		if ( response === "1" ) {
			hideModal();
		}
	} );
} );

jQuery( ".resolve_task" ).on( 'click', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).parent().serialize();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		if ( response === "1" ) {
			hideModal();
		}
	} );
} );
