var FMIFeedback = {};
FMIFeedback.util = {}; /*holds utility methods*/

(function() {
    /* variables go here */
    FMIFeedback.basePath = "ajax/gateway.php";
    FMIFeedback.ajaxSuggestRespNamesOnly = [];
    FMIFeedback.ajaxSuggestRespSuggests = {};
    FMIFeedback.ajaxSuggestResp = [];

    /* Autoloaders go here */
    $(document).ready(function(){
        $('.radio').click(function(){
        	var $wrapper = $(this).parents('.radiowrapper');

			// Clear all others
			$wrapper.find('.radio').removeClass('selected');
			
			// Set this as selected
			$(this).addClass('selected');
			
			// Change the hidden field
			var val;
			if ( $(this).hasClass('sad') )
				val = -1;
			else if ( $(this).hasClass('neutral') )
				val = 0;
			else
				val = 1;
				
			$wrapper.find('input[type=hidden]').val(val);
        });
	
        $('#anonymous').click(function(){
            if($(this).is(':checked'))
            {
                $('#info').fadeIn('slow');
            }
            else
            {
                $('#info').fadeOut('slow');
            }
        });
        
        /*sending logic*/
        $("#sendButton").click(function() {
            // validation later
            var courseId = findCourseId($("#coursebox").val());
            var teacherId = $("#teacherbox").val();
            var positiveText = $("#positive").val();
            var negativeText = $("#negative").val();
           
            var name = "";
            var subjectId = -1;
           
            // questions later
            if($("#anonymous").is(":checked")) {
                name = $("#name").val();
                subjectId = $("#subjects").val();
               
            }
           
            var sendObject = {
                courseId : courseId, 
                teacherId : teacherId,
                positiveFeedback : positiveText,
                negativeFeedback : negativeText,
                dudesName : name,
                subjectId : subjectId
            };
           
            sendFeedback(sendObject);
        });
	
    });
})();

String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
};