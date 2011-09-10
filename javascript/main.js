var FMIFeedback = {};
FMIFeedback.util = {}; /*holds utility methods*/

(function() {
    /* variables go here */
    FMIFeedback.basePath = "ajax/gateway.php";
    FMIFeedback.ajaxSuggestRespNamesOnly = [];
    FMIFeedback.ajaxSuggestRespSuggests = {};
    FMIFeedback.ajaxSuggestResp = [];
    FMIFeedback.imagePath = 'images/';
    
    FMIFeedback.icons = {
        neutralColor :  "icon_neutral_color.png",
        neutralGray :    "icon_neutral_gray.png",
        happyColor : "icon_happy_color.png",
        happyGray : "icon_happy_gray.png",
        sadColor : "icon_sad_color.png",
        sadGray : "icon_sad_gray.png"
    };

    /* Autoloaders go here */
    $(document).ready(function(){
        var imagePath = FMIFeedback.imagePath;
        $('.sad').not('.selected').click(function(event){
            $(restoreOthers(event.target)).parent().find('.radio[value="-1"]').attr('checked',true);
            $(this).attr('src',imagePath + FMIFeedback.icons["sadColor"]).addClass('selected');
        }).mouseover(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["sadColor"]);
        }).mouseout(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["sadGray"]);
        });
	
        $('.neutral').not('.selected').click(function(event){
            $(restoreOthers(event.target)).parent().find('.radio[value="0"]').attr('checked',true);
            $(this).attr('src',imagePath + FMIFeedback.icons["neutralColor"]).addClass('selected');
        }).mouseover(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["neutralColor"]);
        }).mouseout(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["neutralGray"]);
        });
	
        $('.happy').click(function(event){
            $(restoreOthers(event.target)).parent().find('.radio[value="1"]').attr('checked',true);
            $(this).attr('src',imagePath + FMIFeedback.icons["happyColor"]).addClass('selected');
        }).mouseover(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["happyColor"]);
        }).mouseout(function(){
            $(this).not('.selected').attr('src',imagePath + FMIFeedback.icons["happyGray"]);
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

    /* Restores default images for a set of images */
    function restoreOthers(ev)
    {
        var imagePath = FMIFeedback.imagePath;
        $(ev).parent().find('.neutral').attr('src',imagePath+'icon_neutral_gray.png').removeClass('selected');
        $(ev).parent().find('.happy').attr('src',imagePath+'icon_happy_gray.png').removeClass('selected');
        $(ev).parent().find('.sad').attr('src',imagePath+'icon_sad_gray.png').removeClass('selected');
        return ev;
    }    
})();

String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
};