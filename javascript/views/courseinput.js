( function($) {
	CourseInputView = Backbone.View.extend({
		initialize : function() {
			this.collection.bind('reset', this.render, this /*context*/);
		},
		render : function() {
			var data = [];
			this.collection.each(function(model) {
				data.push({
					id : model.get("id"),
					name : model.get("name")
				})
			});
			var localDataSouce = new kendo.data.DataSource({
				data : data
			});
			$("#coursebox").kendoComboBox({
				index : 0,
				dataTextField : "name",
				dataValueField : "id",
				dataSource : localDataSouce,
				height : 500,
				filter : "contains",
				change : function() {
					console.log($(this).value());
				}
			});
			$("#coursebox").closest(".k-widget").css("width", 215);
			$("#coursebox").closest(".k-widget").css("height", 42);
		}
	});
}(jQuery));
