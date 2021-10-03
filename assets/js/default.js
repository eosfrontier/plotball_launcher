jQuery( ".tab-button" ).click( function() {
	if ( jQuery( this ).hasClass( "active" ) ) {

	} else {
		var className = "." + jQuery( this ).data( "tab" );
		jQuery( ".tab-button.active" ).removeClass( "active" );
		jQuery( ".tab.active" ).removeClass( "active" );
		jQuery( this ).addClass( "active" );
		jQuery( className ).addClass( "active" );
	}
} )

jQuery( ".participate-button" ).unbind().on( "click", function() {
	jQuery( this ).parent().next().slideToggle();
} )

jQuery( ".character_signup" ).unbind().on( 'submit', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).serialize();
	var object = jQuery( this.offsetParent );
	var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery( object ).attr( "id" );

	jQuery( object ).find( ".sign_up_button" ).hide();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		console.log( response );

		if ( response === "none" ) {
			jQuery( object ).find( ".signup_none" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

		if ( response === "1" ) {
			jQuery( object ).find( ".signup_1" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

		if ( response === "2" ) {
			jQuery( object ).find( ".signup_2" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

		if ( response === "3" ) {
			jQuery( object ).find( ".signup_3" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

	} );
} );

jQuery( ".item__main" ).click( function( e ) {
	jQuery( this ).parent( ".item" ).toggleClass( "active" );
} )

jQuery( document ).ready( function() {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams( queryString );
	const item = urlParams.get( 'item' )

	const tab = urlParams.get( 'tab' );

	if ( tab !== null ) {
		const tabValue = tab + "-tab";
		const className = "." + tabValue;
		jQuery( ".tab-button.active" ).removeClass( "active" );
		jQuery( ".tab.active" ).removeClass( "active" );
		jQuery( "div" ).find( '[data-tab=' + tabValue + ']' ).addClass( "active" );
		jQuery( className ).addClass( "active" );
	}

	if ( item !== null ) {
		const id = "#" + item;
		if ( jQuery( id ).length ) {
			jQuery( id ).addClass( "active" );
			jQuery( [ document.documentElement, document.body ] ).animate( {
				scrollTop: $( id ).offset().top
			}, 500 );
		}
	}
} )

jQuery( ".double_signout_form" ).unbind().on( 'submit', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).serialize();
	var object = jQuery( this.offsetParent );
	var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery( object ).attr( "id" );

	jQuery( object ).find( ".double_signout_button" ).hide();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		if ( response === "2" ) {
			jQuery( object ).find( ".signup_2" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

		if ( response === "3" ) {
			jQuery( object ).find( ".signup_3" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}

	} );
} );

jQuery( ".resolve_task_form" ).unbind().on( 'submit', function( e ) {
	e.preventDefault();
	var form_data = jQuery( this ).serialize();
	var object = jQuery( this.offsetParent );
	var url = location.protocol + '//' + location.host + location.pathname + "?item=" + jQuery( object ).attr( "id" );

	jQuery( object ).find( ".resolve_task_button" ).hide();

	$.ajax( {
		url: "xf.php",
		type: "post",
		data: form_data
	} ).done( function( response ) {
		console.log( response );
		if ( response === "1" ) {
			jQuery( object ).find( ".signup_1" ).show();
			setTimeout( function() {
				window.location.href = url;
			}, 5000 );
		}
	} );
} );
