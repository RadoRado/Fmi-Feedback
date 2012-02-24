( function($) {
	AdminCourseList = Backbone.View.extend({
		initialize : function() {
			this.collection.bind('reset', this.render, this /*context*/);
		},
		render : function() {
			var data = [], namesHash = {}, courseName = "";
			this.collection.each(function(model) {
				courseName = model.get("name");
				data.push(courseName);
				namesHash[courseName] = model.get("uid");
			});

			$("#coursebox").autocomplete({
				source : data,
				select : function(event, ui) {
					var courseId = namesHash[ui.item.value];
					$("#courseId").val(courseId);
				}
			});
		}
	});
}(jQuery));
