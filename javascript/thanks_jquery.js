$(document).ready(function() {
	$("#thankYouMessage").hide();

	var answered = $("#hasStudentAnswered").val();
	if(answered === "yes") {
		$("#gamifiedEducation").hide();
		$("#thankYouMessage").show();
	} else {
		$(".button").click(function() {
			var payload = $(this).attr("class").replace("button ", ""), feedbackId = $("#feedbackId").val(), studentId = $("#studentId").val();
			if(studentId === "") {
				studentId = -1;
			}
			$.ajax({
				type : "POST",
				url : "/fmifeedback/api/followup/",
				data : {
					"gamified" : payload,
					"feedbackId" : feedbackId,
					"studentId" : studentId
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
	}
});
