( function($) {
	TeacherModel = Backbone.Model.extend({
		defaults : {
			uid : -1,
			name : ""
		}
	});
	TeachersByCourseCollection = Backbone.Collection.extend({
		model : TeacherModel,
		set : function(key, value) {
			this[key] = value;
		},
		url : function() {
			return "/fmifeedback/api" + "/teacherByCourse/" + this.selectedCourseId;
		}
	});
}());
