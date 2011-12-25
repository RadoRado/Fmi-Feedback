namespace("FMI.Feedback.Server", function() {
	return {
		getTeachers : function(courseID, callback) {
			$.ajax({
				dataType : 'json',
				url : FMI.Feedback.basePath,
				type : 'POST',
				data : {
					'class' : 'TeachersProxy',
					'method' : 'getTeachers',
					'params' : {
						'courseId' : courseID
					}
				},
				success : function(data) {
					//callback(data);
					if(data['success']) {
						console.log(data);
						var cnt = FMI.Feedback.Util.appendToCombo("teacherbox", data, "uid", "name"), courseLabel = "";

						if(cnt === 0) {
							courseLabel = $("#coursebox").val();
							FMI.Feedback.Linker.open({
								componentId : "linkerWindow",
								teachersInputId : "teachersAutoComplete",
								readyButtonId : "imReadyLinking",
								courseLabel : courseLabel
							});
						}
					}
				},
				error : function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + ' ' + errorThrown);
				}
			});
		},
		findCourseId : function(name) {
			console.log(name);
			if(undefined !== FMI.Feedback.ajaxSuggestRespSuggests[name]) {
				return FMI.Feedback.ajaxSuggestRespSuggests[name];
			}
			return -1;
		},
		getCourses : function(callback) {
			$.ajax({
				dataType : 'json',
				url : FMI.Feedback.basePath,
				context : this,
				type : 'POST',
				cache : false,
				data : {
					'class' : 'CoursesProxy',
					'method' : 'getCourses',
					'params' : {}
				},
				success : callback,
				error : function(jqXHR, textStatus, errorThrown) {
					console.log("There was an error : {0}".format(textStatus + ' ' + errorThrown));
				}
			});
		}
	}
});
