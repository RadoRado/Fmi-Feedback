namespace("FMI.Feedback.Server", function() {
	return {
		getTeachers : function(courseID) {
			$.ajax({
				dataType : 'json',
				url : FMI.Feedback.basePath,
				type : 'POST',
				data : {
					'class' : 'TeachersProxy',
					'method' : 'getTeachers',
					'params' : {
						'courseId' : courseID
					}
				},
				success : function(data) {
					if(data['success']) {
						var cnt = FMI.Feedback.Util.appendToCombo("teacherbox", data, "id", "name"), courseLabel = "";

						if(cnt === 0) {
							courseLabel = $("#coursebox").val();
							FMI.Feedback.Linker.open({
								componentId : "linkerWindow",
								teachersInputId : "teachersAutoComplete",
								readyButtonId : "imReadyLinking",
								courseLabel : courseLabel
							});
						}
					}
				},
				error : function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus + ' ' + errorThrown);
				}
			});
		},
		findCourseId : function(name) {
			console.log(name);
			if(undefined !== FMI.Feedback.ajaxSuggestRespSuggests[name]) {
				return FMI.Feedback.ajaxSuggestRespSuggests[name];
			}
			return -1;
		},
		getCourses : function() {
			$.ajax({
				dataType : 'json',
				url : FMI.Feedback.basePath,
				context : this,
				type : 'POST',
				cache : false,
				data : {
					'class' : 'CoursesProxy',
					'method' : 'getCourses',
					'params' : {}
				},
				success : function(data) {
					console.log(this);
					var self = this;
					if( typeof (data['success']) === "string" && data['success'] == "true") {
						FMI.Feedback.ajaxSuggestResp = data['data'];
						for(var i in FMI.Feedback.ajaxSuggestResp) {
							FMI.Feedback.ajaxSuggestRespSuggests[FMI.Feedback.ajaxSuggestResp[i]['name']] = FMI.Feedback.ajaxSuggestResp[i]['id'];
							FMI.Feedback.ajaxSuggestRespNamesOnly.push(FMI.Feedback.ajaxSuggestResp[i]['name']);
						}
						$("#coursebox").autocomplete({
							source : FMI.Feedback.ajaxSuggestRespNamesOnly,
							select : function(event, ui) {
								$("#coursebox").trigger('change');
								var courseId = self.findCourseId(ui.item.value);
								console.log(courseId);
								$("#courseId").val(courseId).trigger('change');
								self.getTeachers(courseId);
							}
						});
					} else {
						console.log("something went wrong on getCourses()");
					}
				},
				error : function(jqXHR, textStatus, errorThrown) {
					console.log("There was an error : {0}".format(textStatus + ' ' + errorThrown));
				}
			});
		}
	}
});
