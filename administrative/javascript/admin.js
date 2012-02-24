$(document).ready(function() {
	var coursesCollection = new CoursesCollection(), teachersCollection = new TeachersCollection(), courseView = new AdminCourseList({
		collection : coursesCollection
	}), teacherView = new AdminTeacherList({
		collection : teachersCollection
	});

	coursesCollection.fetch();
	teachersCollection.fetch();

	$("#linkTeacherButton").click(function() {
		var ctm = new CourseTeacherModel();
		ctm.save({
			teacherId : $("#teacherId").val(),
			courseId : $("#courseId").val()
		}, {
			success : function(model, data) {
				console.log("success");
			},
			error : function(model, data) {
				console.log(data);
			}
		});
	});
});
