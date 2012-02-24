( function($) {
	CourseTeacherModel = Backbone.Model.extend({
		defaults : {
			teacherId : -1,
			courseId : -1
		},
		url : document.location.origin + "/fmifeedback/api" + "/link/"
	})
}(jQuery));
