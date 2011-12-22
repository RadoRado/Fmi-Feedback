namespace("FMI.Feedback.Linker", function() {
	var _private = {
		componentId : "",
		courseLabel : ""
	};

	return {
		open : function(config) {
			console.log(config);
			_private.componentId = config.componentId;
			_private.courseLabel = config.courseLabel;

			var w = $("#{0}".format(_private.componentId));
			$($(w).find(".courseTitle")[0]).html(_private.courseLabel);

			console.log("Opened window");
		},
		close : function() {

		}
	}
});
