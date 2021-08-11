$('.overview-table .item').click(function(){
	var dataId = $(this).attr("data-id");
	$('.modal.edit-plotball-modal').show();
	$('.modal.edit-plotball-modal .modal__window').load("partials/modal_edit.php?id=" + dataId); 
})