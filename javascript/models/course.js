( function($) {
	CourseModel = Backbone.Model.extend({
		defaults : {
			uid : -1,
			name : ""
		}
	});
	CoursesCollection = BaseCollection.extend({
		model : CourseModel,
		url : function() {
			return this.baseApiPath + "/course";
		}
	});
}(jQuery));
