$("#new-plotball").click(function(){
	$('.modal.new-plotball-modal').show();
})

$(".modal").click(function(){
	$(this).hide();
	$(".modal.edit-plotball-modal .modal__window").html('');
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