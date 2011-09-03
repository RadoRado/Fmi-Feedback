function getTeachers(variable)
{
	$.ajax({
		dataType: 'json',
		url: basePath,
		type: 'POST',
		data: {
			'class':'TeachersProxy',
			'method':'getTeachers',
			'params': {
				'courseId':variable
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
			alert(textStatus + ' ' + errorThrown);
		}
	});
}

function getCourses()
{
	$.ajax({
		dataType: 'json',
		url: basePath,
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
				ajaxSuggestResp = data['data'];
				for(var i in ajaxSuggestResp)
				{
					ajaxSuggestRespSuggests[ajaxSuggestResp[i]['name']] = ajaxSuggestResp[i]['id'];
					ajaxSuggestRespNamesOnly.push(ajaxSuggestResp[i]['name']);
				}
                                console.log(ajaxSuggestRespNamesOnly);
				$("#coursebox").autocomplete({source : ajaxSuggestRespNamesOnly});
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