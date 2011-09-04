function getTeachers(courseID)
{
	$.ajax({
		dataType: 'json',
		url: FMIFeedback.basePath,
		type: 'POST',
		data: {
			'class':'TeachersProxy',
			'method':'getTeachers',
			'params': {
				'courseId':courseID
			}
		},
		success: function(data){
			if(data['success'])
			{
				$('#teacherbox').find('option').remove();
				for(var i in data['data'])
				{
					$('#teacherbox').append(
						'<option value="{0}">{1}</option>'.format
						(
							data['data'][i]['id'],
							data['data'][i]['name']
						)
					);
				}
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus + ' ' + errorThrown);
		}
	});
}

function getCourses()
{
	$.ajax({
		dataType: 'json',
		url: FMIFeedback.basePath,
		context: this,
		type: 'POST',
		cache: false,
		data: {
			'class':'CoursesProxy',
			'method':'getCourses',
			'params': {}
		},
		success: function(data){
			if(typeof(data['success']) === "string" && data['success'] == "true")
			{
                                console.log(data);
				FMIFeedback.ajaxSuggestResp = data['data'];
				for(var i in FMIFeedback.ajaxSuggestResp)
				{
					FMIFeedback.ajaxSuggestRespSuggests[FMIFeedback.ajaxSuggestResp[i]['name']] = FMIFeedback.ajaxSuggestResp[i]['id'];
					FMIFeedback.ajaxSuggestRespNamesOnly.push(FMIFeedback.ajaxSuggestResp[i]['name']);
				}
                                console.log(FMIFeedback.ajaxSuggestRespNamesOnly);
				$("#coursebox").autocomplete({source : FMIFeedback.ajaxSuggestRespNamesOnly});
			} else {
                            console.log("something went wrong on getCourses()");
                        }
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus + ' ' + errorThrown);
		}
	});
}
getCourses();