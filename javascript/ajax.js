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
				success : callback,
				error : function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + ' ' + errorThrown);
				}
			});
		},
		findCourseId : function(name) {
			if(FMI.Feedback.ajaxSuggestRespSuggests[name] !== undefined) {
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
