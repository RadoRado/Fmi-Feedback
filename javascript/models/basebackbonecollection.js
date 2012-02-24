( function($) {
	BaseCollection = Backbone.Collection.extend({
		baseApiPath : document.location.origin + "/fmifeedback/api"
	});
}(jQuery));