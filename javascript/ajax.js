FMIFeedback.Server = (function() {
    return {
        getTeachers : function(courseID)
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
        },
        sendFeedback : function(dataObject) {
            $.ajax({
                dataType: 'json',
                url: FMIFeedback.basePath,
                type: 'POST',
                data : {
                    'class':'FeedbackProxy',
                    'method':'sendFeedback',
                    params : dataObject
                },
                success : function(data) {
            
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus + ' ' + errorThrown);
                }
            });
        },
        findCourseId : function(name)
        {
            console.log(name);
            if(undefined !== FMIFeedback.ajaxSuggestRespSuggests[name])
            {
                return FMIFeedback.ajaxSuggestRespSuggests[name];
            }
            return -1;
        },
        getCourses : function()
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
                    console.log(this);
                    var self = this;
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
                                console.log(self);
                                self.getTeachers(self.findCourseId(ui.item.value));
                            }
                        });
                    } else {
                        console.log("something went wrong on getCourses()");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log("There was an error : {0}".format(textStatus + ' ' + errorThrown));
                }
            });
        }
    }
})().getCourses();