namespace("FMI.Feedback.Linker", function() {
	var _private = {
		isOpened : false,
		componentId : "",
		courseLabel : ""
	};

	return {
		open : function(config) {
			var w = null, configOption = null;
			for(configOption in config) {
				if(config.hasOwnProperty(configOption)) {
					_private[configOption] = config[configOption];
				}
			}
			
			console.log(_private);
			
			w = $("#{0}".format(_private.componentId));
			$($(w).find(".courseTitle")[0]).html(_private.courseLabel);

			$(w).dialog({
				modal : true,
				width : 450,
				title : "Връзване на преподавател с предмет"
			}).css("visibility", "visible");
		},
		close : function() {

		}
	}
});
