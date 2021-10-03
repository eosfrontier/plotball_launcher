jQuery( ".update_plotball_status" ).on( 'submit', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).serialize();
	var answer = window.confirm( "Change status of plotball?" );
	if ( answer === true ) {
		$.ajax( {
			url: "xf.php",
			type: "post",
			data: form_data
		} ).done( function( response ) {
			if ( response === "1" ) {
				hideModal();
			}
		} );
	}
} );
