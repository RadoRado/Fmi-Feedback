( function($) {
	CourseModel = Backbone.Model.extend({
		defaults : {
			id : -1,
			name : ""
		}
	});
	CoursesCollection = Backbone.Collection.extend({
		model : TeacherModel,
		url : function() {
			return "/fmifeedback/api" + "/course";
		}
	});
}(jQuery));
