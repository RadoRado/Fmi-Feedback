namespace("FMI.Feedback.Linker", function() {
	var _private = {
		isOpened : false,
		componentId : "",
		courseLabel : "",
		teachersInputId : ""
	};

	return {
		teacherNameToId : {}, // hash until switched to better UI framework
		open : function(config) {
			var w = null, configOption = null, readyButton = null;
			for(configOption in config) {
				if(config.hasOwnProperty(configOption)) {
					_private[configOption] = config[configOption];
				}
			}

			console.log(_private);
			w = $("#{0}".format(_private.componentId));
			$($(w).find(".courseTitle")[0]).html(_private.courseLabel);
			readyButton = $(w).find("#{0}".format(_private.readyButtonId));

			$(w).dialog({
				modal : true,
				width : 450,
				title : "Връзване на преподавател с предмет"
			}).css("visibility", "visible");

			// events
			$(w).bind("dialogclose", function(event, ui) {

			});

			$(readyButton).bind("click", function(event, ui) {
				console.log("ready button clicked");
			});

			FMI.Feedback.Server.getTeachers(-1/*all teachers*/, function(data) {
				data = data.data;
				var i = 0, len = data.length, names = [];

				for(i; i < len; i++) {
					names[i] = data[i].name;
					FMI.Feedback.Linker.teacherNameToId[data[i].name] = data[i].uid;
				}

				$("#{0}".format(_private.teachersInputId)).autocomplete({
					source : names
				});
			})
		},
		close : function() {

		}
	}
});
