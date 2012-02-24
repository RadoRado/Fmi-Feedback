( function($) {
	
	console.log("fuck caching");
	BaseCollection = Backbone.Collection.extend({
		baseApiPath : document.location.origin + "/api"
	});
}(jQuery));