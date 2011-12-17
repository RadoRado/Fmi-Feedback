$(document).ready(function() {
	FMI.Feedback.Server.getCourses();
	
	$(".neutral").addClass("selected");
	$('.radio').click(function() {
		var $wrapper = $(this).parents('.radiowrapper');

		// Clear all others
		$wrapper.find('.radio').removeClass('selected');

		// Set this as selected
		$(this).addClass('selected');

		// Change the hidden field
		var val;
		if($(this).hasClass('sad')) {
			val = -1;
		} else if($(this).hasClass('neutral')) {
			val = 0;
		} else {
			val = 1;
		}

		$wrapper.find('input[type=hidden]').val(val);
	});
	var top = $('#completed').offset().top - parseFloat($('#completed').css('marginTop').replace(/auto/, 0));
	$(window).scroll(function(event) {

		// what the y position of the scroll is
		var y = $(this).scrollTop();

		if(y >= top) {
			$('#completed').addClass('fixed');
		} else {
			$('#completed').removeClass('fixed');
		}
	});
	//Hide div w/id extra
	$("#student_answer").css("display", "none");
	$("#ready_button").css("margin-top", "10px");

	// Add onclick handler to checkbox w/id checkme
	$("#checkme").click(function() {

		// If checked
		if($("#checkme").is(":checked")) {
			//show the hidden div
			$("#student_answer").show(800);
			$("#ready_button").css("margin-top", "-20px");
		} else {
			//otherwise, hide it
			$("#student_answer").hide("fast");
			$("#ready_button").css("margin-top", "10px");
		}
	});
	if($.browser.msie || $.browser.mozilla || $.browser.opera) {
		$("input.student_name").css("margin-bottom", "0px");
	} else {
		$("input.student_name").css("margin-bottom", "5px");
	}
});
