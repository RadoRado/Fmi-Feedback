( function($) {
	CourseInputView = Backbone.View.extend({
		initialize : function() {
			this.collection.bind('reset', this.render, this /*context*/);
		},
		render : function() {
			
		}
	});
}());
