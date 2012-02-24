$(document).ready(function() {
	var coursesCollection = new CoursesCollection(), teachersCollection = new TeachersCollection(), courseView = new AdminCourseList({
		collection : coursesCollection
	}), teacherView = new AdminTeacherList({
		collection : teachersCollection
	});

	coursesCollection.fetch();
	teachersCollection.fetch();

	$("#linkTeacherButton").click(function() {
		var ctm = new CourseTeacherModel({
			teacherId : $("#teacherId").val(),
			courseId : $("#courseId").val()
		});
		console.log(ctm);
		console.log(ctm.url);
	});
});
