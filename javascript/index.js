namespace("FMI.Feedback.UI", function() {
	return {
		updateTeachersUI : function(courseId) {
			FMI.Feedback.Server.getTeachers(courseId, function(data) {
				if(data['success']) {
					console.log(data);
					var cnt = FMI.Feedback.Util.appendToCombo("teacherbox", data, "uid", "name"), courseLabel = "", courseId = -1, modal = false, position = ["right", "top"];

					if(cnt === 0) {
						modal = true;
						position = "center";
					}
					courseLabel = $("#coursebox").val();
					courseId = $("#courseId").val();
					FMI.Feedback.Linker.open({
						componentId : "linkerWindow",
						teachersInputId : "teachersAutoComplete",
						readyButtonId : "imReadyLinking",
						teacherListId : "teacherList",
						courseLabel : courseLabel,
						courseId : courseId,
						modal : modal,
						position : position
					});
				}
			})
		}
	}
});

$(document).ready(function() {

	FMI.Feedback.Server.getCourses(function(data) {
		console.log(data);
		var self = FMI.Feedback.Server;
		if(data["success"]) {
			FMI.Feedback.ajaxSuggestResp = data["data"];
			for(var i in FMI.Feedback.ajaxSuggestResp) {
				FMI.Feedback.ajaxSuggestRespSuggests[FMI.Feedback.ajaxSuggestResp[i]["name"]] = FMI.Feedback.ajaxSuggestResp[i]["id"];
				FMI.Feedback.ajaxSuggestRespNamesOnly.push(FMI.Feedback.ajaxSuggestResp[i]["name"]);
			}
			$("#coursebox").autocomplete({
				source : FMI.Feedback.ajaxSuggestRespNamesOnly,
				select : function(event, ui) {
					$("#coursebox").trigger('change');
					var courseId = self.findCourseId(ui.item.value);
					$("#courseId").val(courseId).trigger('change');
					FMI.Feedback.UI.updateTeachersUI(courseId);
				}
			});
		}
	});
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
	/*
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
	*/
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
