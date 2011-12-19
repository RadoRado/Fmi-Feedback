namespace("FMI.Feedback.Thanks", function() {
	var _private = {};

	return {

	}
});

$(document).ready(function() {
	$("#thankYouMessage").hide();
	$(".button").click(function() {
		var payload = $(this).attr("class").replace("button ", ""), feedbackId = $("#feedbackId").val();

		$.ajax({
			type : "POST",
			url : FMI.Feedback.basePath,
			data : {
				"class" : "FollowUp",
				"method" : "count",
				"params" : {
					gamified : payload,
					feedbackId : feedbackId
				}
			},
			success : function(data) {
				$("#gamifiedEducation").hide("fast");
				$("#thankYouMessage").show("fast");
			},
			error : function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus + ' ' + errorThrown);
			}
		})
	});
});
