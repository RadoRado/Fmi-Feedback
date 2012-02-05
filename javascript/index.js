$(document).ready(function() {
	if($.browser.msie) {
		alert("You are using Internet Explorer and there are some HTML 5 things that does not work here. For full experience, use another browser");
	}

	var courseInputView = null, teacherSelectView = null, coursesCollection = null, sharedCourseModel = null;
	coursesCollection = new CoursesCollection();
	sharedCourseModel = new CourseModel(); /*used for communicating between views*/

	courseInputView = new CourseInputView({
		collection : coursesCollection,
		sharedCourse : sharedCourseModel
	});
	teacherSelectView = new TeacherSelectView({
		sharedCourse : sharedCourseModel
	});

	sharedCourseModel.bind("change", function() {
		console.log("something changed");
	});
	coursesCollection.fetch();

	$(".radio").qtip({
		content : {
			attr : "alt"
		},
		position : {
			my : "bottom center",
			at : "top center"
		}
	});

	$(".radio").click(function() {
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
	function show_hide_answer() {
		if($("#checkme").is(":checked")) {
			//show the hidden div
			$("#student_answer").show();
			$("#ready_button").css("margin-top", "-20px");
		} else {
			//otherwise, hide it
			$("#student_answer").hide();
			$("#ready_button").css("margin-top", "10px");
		}
	}

	//Hide div w/id extra
	show_hide_answer();

	// Add onclick handler to checkbox w/id checkme
	$("#checkme").click(function() {
		show_hide_answer();
	});
	if($.browser.msie || $.browser.mozilla || $.browser.opera) {
		$("input.student_name").css("margin-bottom", "0px");
	} else {
		$("input.student_name").css("margin-bottom", "5px");
	}

});
