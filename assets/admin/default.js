$( "#new-plotball" ).click( function() {
	$( ".modal.new-plotball-modal" ).show();
} )

$( ".modal" ).click( function() {
	hideModal();
} ).children().click( function( e ) {
	e.stopPropagation();
} );

$( ".modal__window" ).on( "click", ".remove-validation", function() {
	$( this ).parent().remove();
} )

$( "#collapse-items" ).click( function() {
	if ( $( ".overview-table" ).hasClass( "small" ) ) {
		$( ".overview-table" ).removeClass( "small" );
		$( this ).html( "Collapse items" );
	} else {
		$( ".overview-table" ).addClass( "small" );
		$( this ).html( "Uncollapse items" );
	}
} )

$( ".tab-button" ).click( function() {
	if ( $( this ).hasClass( "active" ) ) {

	} else {
		var className = "." + $( this ).data( "tab" );
		$( ".tab-button.active" ).removeClass( "active" );
		$( ".tab.active" ).removeClass( "active" );
		$( this ).addClass( "active" );
		$( className ).addClass( "active" );
	}
} )

function hideModal() {
	$( ".modal" ).hide();
	$( ".modal.edit-plotball-modal .modal__window" ).html( "" );
	$( ".timeline-tables" ).load( document.URL + " .timeline-tables" );
	$( ".overview-tables" ).load( document.URL + " .overview-tables" );
}

$( document ).on( "click", ".overview-table .item", function( e ) {
	var dataId = $( e.originalEvent.path ).closest( ".overview-table .item" ).attr( "data-id" );
	$( ".modal.edit-plotball-modal" ).show();
	$( ".modal.edit-plotball-modal .modal__window" ).load( "partials/modal_edit.php?id=" + dataId );
} )

$( document ).on( "click", ".timeline-plotball", function( e ) {
	var dataId = $( e.originalEvent.path ).closest( ".timeline-plotball" ).attr( "data-id" );
	$( ".modal.edit-plotball-modal" ).show();
	$( ".modal.edit-plotball-modal .modal__window" ).load( "partials/modal_edit.php?id=" + dataId );
} );
