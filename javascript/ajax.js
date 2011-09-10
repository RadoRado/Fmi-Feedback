FMIFeedback.util.appendToCombo = function(componentId /*string*/, data /*object*/, valueKey/*string*/, textKey/*string*/) {
    if(typeof(componentId) !== "string" || typeof(data) !== "object" || typeof(valueKey) !== "string" || typeof(textKey) !== "string") {
        return false;
    }
    
    $("#{0}".format(componentId)).find("option").remove();
    for(var i in data["data"]) {
        $("#{0}".format(componentId)).append(
            '<option value="{0}">{1}</option>'.format
            (
                data['data'][i][valueKey],
                data['data'][i][textKey]
                )
            );
    }
}

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
                if(FMIFeedback.util.appendToCombo("teacherbox", data, "id", "name") == false) {
                    console.log("error");
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ' ' + errorThrown);
        }
    });
}

function findCourseId(name)
{
    console.log(name);
    if(undefined !== FMIFeedback.ajaxSuggestRespSuggests[name])
    {
        return FMIFeedback.ajaxSuggestRespSuggests[name];
    }
    return -1;
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
                FMIFeedback.ajaxSuggestResp = data['data'];
                for(var i in FMIFeedback.ajaxSuggestResp)
                {
                    FMIFeedback.ajaxSuggestRespSuggests[FMIFeedback.ajaxSuggestResp[i]['name']] = FMIFeedback.ajaxSuggestResp[i]['id'];
                    FMIFeedback.ajaxSuggestRespNamesOnly.push(FMIFeedback.ajaxSuggestResp[i]['name']);
                }
                $("#coursebox").autocomplete({
                    source : FMIFeedback.ajaxSuggestRespNamesOnly,
                    select : function(event, ui) {
                        getTeachers(findCourseId(ui.item.value));
                    }
                });
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