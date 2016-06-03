$(document).ready(function() {
	
	/*===== Accordion =====*/	
	function toggleChevron(e) {
		$(e.target)
			.prev('.panel-heading')
			.find("i.indicator")
			.toggleClass('fa-angle-down fa-angle-up');
	}
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);
	$('#accordion2').on('hidden.bs.collapse', toggleChevron);
	$('#accordion2').on('shown.bs.collapse', toggleChevron);
	
	/*===== Material =====*/
	$(function () {
		$.material.init();
	});
	
	/*===== Material Form =====*/
	/*$(function(){
		$('.material').materialForm();
	});*/
	
	/*===== Add more =====*/
	$(".add").click(function(){
		$(this).parent().find(".more").fadeIn('slow');
	});
	
});