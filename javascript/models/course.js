( function($) {
	CourseModel = Backbone.Model.extend({
		defaults : {
			uid : -1,
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
