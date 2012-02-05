( function($) {
	CourseInputView = Backbone.View.extend({
		initialize : function() {
			this.collection.bind('reset', this.render, this /*context*/);
		},
		render : function() {
			var data = [];
			this.collection.each(function(model) {
				data.push(model.get("name"));
			});	
		}
	});
}());
