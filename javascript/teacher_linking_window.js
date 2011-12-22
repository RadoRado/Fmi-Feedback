namespace("FMI.Feedback.Linker", function(){
	var _private = {
		componentId : ""
	};
	
	return {
		open : function(config) {
			_private.componentId = config.componentId;
			console.log("Opened window");
		},
		close : function() {
			
		}
	}
});
