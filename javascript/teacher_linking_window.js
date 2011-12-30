namespace("FMI.Feedback.Linker", function() {
	var _private = {
		isOpened : false,
		componentId : "",
		courseLabel : "",
		courseId : -1,
		teachersInputId : "",
		readyButtonId : "",
		teacherListId : ""
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
				var ids = [], el = null;
				el = $("#{0}".format(_private.teacherListId));
				$(el).children().each(function(index, item) {
					ids.push($(item).children("input[type=hidden]").val());
				})
				
				FMI.Feedback.Server.linkTeachers(_private.courseId, ids, function(data) {
					console.log("Linking is done, here is the data : ", data);
				});
			});

			FMI.Feedback.Server.getTeachers(-1/*all teachers*/, function(data) {
				data = data.data;
				var i = 0, len = data.length, names = [];

				for(i; i < len; i++) {
					names[i] = data[i].name;
					FMI.Feedback.Linker.teacherNameToId[data[i].name] = data[i].uid;
				}

				$("#{0}".format(_private.teachersInputId)).autocomplete({
					source : names,
					select : function(event, ui) {
						var tId = FMI.Feedback.Linker.teacherNameToId[ui.item.value], element = "";
						console.log(tId);
						if( typeof (tId) === "undefined") {
							console.log("Error when selecting teacher for linking");
							return false;
						}
						element = "<div><input type='hidden' value='{0}' />{1} | <a href='#' class='removeLinkedTeacher'>Махни</a><br /></div>";
						element = element.format(tId, ui.item.value);
						$("#{0}".format(_private.teacherListId)).append(element);
						ui.item.value = "";

						// maybe not the best solution
						$(".removeLinkedTeacher").click(function(event) {
							event.preventDefault();
							$(this).parent().remove();
						});
					}
				});
			})
		},
		close : function() {

		}
	}
});
