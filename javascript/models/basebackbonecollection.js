( function($) {
	console.log("Constructing base collection");
	BaseCollection = Backbone.Collection.extend({
		baseApiPath : document.location.protocol + "//" + document.location.host + "/fmifeedback/api"
	});
}(jQuery));