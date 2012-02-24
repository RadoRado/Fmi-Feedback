( function($) {
	TeacherModel = Backbone.Model.extend({
		defaults : {
			uid : -1,
			name : ""
		}
	});
	
	TeachersCollection = Backbone.Collection.extend({
		model : TeacherModel,
		url : function() {
			return "api" + "/teacher/";
		}
	})
	
	TeachersByCourseCollection = Backbone.Collection.extend({
		model : TeacherModel,
		set : function(key, value) {
			this[key] = value;
		},
		url : function() {
			return "api" + "/teacherByCourse/" + this.selectedCourseId;
		}
	});
}(jQuery));
