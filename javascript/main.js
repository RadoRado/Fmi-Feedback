var FMIFeedback = {};
FMIFeedback.util = {}; /*holds utility methods*/

(function() {
    /* variables go here */
    FMIFeedback.basePath = "ajax/gateway.php";
    FMIFeedback.ajaxSuggestRespNamesOnly = [];
    FMIFeedback.ajaxSuggestRespSuggests = {};
    FMIFeedback.ajaxSuggestResp = [];
    
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
        return true;
    };

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
    });
})();