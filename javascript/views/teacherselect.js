( function($) {
	TeacherSelectView = Backbone.View.extend({
		initialize : function() {
			this.options.sharedCourse.bind("change", this.fetchTeachers, this);
		},
		fetchTeachers : function() {
			var teachersByCourse = new TeachersByCourseCollection();
			teachersByCourse.set("selectedCourseId", this.options.sharedCourse.get("uid"));
			this.collection = teachersByCourse;
			this.collection.bind("reset", this.render, this);
			teachersByCourse.fetch();
		},
		render : function() {
			console.log("rendering");
			$("#teacherbox").html("");

			this.collection.each(function(model) {
				$("#teacherbox").append("<option value='{0}'>{1}</option>".format(model.get("uid"), model.get("name")));
			});
		}
	})
}(jQuery));
