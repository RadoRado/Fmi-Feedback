( function($) {
	TeacherModel = Backbone.Model.extend({
		defaults : {
			uid : -1,
			name : ""
		}
	});
	TeachersCollection = BaseCollection.extend({
		model : TeacherModel,
		url : function() {
			return this.baseApiPath + "/teacher/";
		}
	})
	TeachersByCourseCollection = BaseCollection.extend({
		model : TeacherModel,
		set : function(key, value) {
			this[key] = value;
		},
		url : function() {
			return this.baseApiPath + "/teacherByCourse/" + this.selectedCourseId;
		}
	});
}(jQuery));
