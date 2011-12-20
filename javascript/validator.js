(function ($)
{
	$.fn.FormValidator = function(ErrorElement, Fields)
	{
		//$(this).die("submit", FormValidity).live("submit", FormValidity);
		
		//$(this).find("input, textarea, select").die("change", Validity).live("change", Validity);
		//$(this).find("input, textarea, select").die("focus", DefaultsFocus).live("focus", DefaultsFocus);
		//$(this).find("input, textarea, select").die("blur", DefaultsBlur).live("blur", DefaultsBlur);
		var form = $(this);
		
		var FormValidity = function(all){
			var ret = true;
			var allValid = true;
			var hasFields = false;
			
			$.each(Fields, function()
			{
				var options = $.extend({}, $.fn.FormValidator.defaults, this);
				var valid = true;
				var num = 0;
				var touched = false;
				
				if ( form.has('[name=' + options.name.replace('[]', '\[\]') + ']').length <= 0 )
					return true;
					
				hasFields = true;
				
				form.find('[name=' + options.name.replace('[]', '\[\]') + ']').each(function(){				
					if ( ( all == undefined || all == false ) && $(this).data("touched") != true )
						return true;
					else
						touched = true;
					
					valid = Validate( $(this), options, ErrorElement, false);
	                
					if ( valid )
						num += 1;
					else if ( valid != undefined )
					{
						ret = false;
						allValid = false;
					}
				});	            
			});
			
			if ( hasFields && allValid )
			{
				hideError(ErrorElement);
				form.trigger('validated-form-valid.validator', [form, ErrorElement]);
			}
			else if ( all )
			{
				form.trigger('validated-form-invalid.validator', [form, ErrorElement]);
				form.trigger('validated-has-invalid.validator', [form, ErrorElement]);
			}
			else
				form.trigger('validated-has-invalid.validator', [form, ErrorElement]);
			
			return ret;
		};
		
		$(this).submit(function(){
			$(this).find("input, textarea, select").data("touched", true);
			
			return FormValidity(true);
		});
		
		$(this).find("input, textarea, select").change(function(){
			$(this).data("touched", true);
			
			return FormValidity();
		});
		
		$.each(Fields, function()
		{
			var options = $.extend({}, $.fn.FormValidator.defaults, this);
			
			if ( options.defaultText != '' )
			{
				form.find('[name=' + options.name.replace('[]', '\[\]') + ']').focus(function(){
					
					if ( $(this).val() == options.defaultText )
					{
						$(this).val('');
						$(this).data("defaulted", false);
					}
					
				});
				form.find('[name=' + options.name.replace('[]', '\[\]') + ']').blur(function(){
						
					if ( $(this).val() == '' )
					{
						$(this).val(options.defaultText);
						$(this).data("defaulted", true);
					}
					
				});
			}
		});
		
		$.each(Fields, function()
		{
			var options = $.extend({}, $.fn.FormValidator.defaults, this);
			var elm = $("[name=" + options.name + "]");

			if ( elm.val() == '' )
			{
				elm.val(options.defaultText);
				elm.data("defaulted", true);
			}
		});
		
	function Validate(elm, options, ErrorElement, hideError)
	{
		if ( elm.data("defaulted") == true && elm.val() == options.defaultText )
		{
			elm.val('');
			elm.data("defaulted", false);
		}
		
		if ( options.equalsTo.length > 0 )
		{
			if ( elm.val() != $("[name=" + options.equalsTo + "]").val() )
			{
				return setValid(elm, options, ErrorElement, false, true);
			}
		}
				
		if ( elm.val().length == 0 && ( options.required == false || ( options.dependson !== false && !$("[name=" + options.dependson + "]").is(':isfilled') ) ) )
		{
			setValid(elm, options, ErrorElement, true, true, true, hideError);
			return undefined;
		}
		else if ( elm.val().match(options.regex) )
		{
			return setValid(elm, options, ErrorElement, true, true, false, hideError);
		}
		else
		{
			return setValid(elm, options, ErrorElement, false, true);
		}
	}
	
	function setValid(element, options, ErrorElement, valid, showErrors, clearClass, hideErrorB)
	{
		if ( hideErrorB == undefined )
	 		hideErrorB = true;
		
		if ( valid )
		{
			element.trigger('validated-valid.validator', [form, element, options, ErrorElement]);
			
			if ( clearClass )
			{
				element.removeClass(options.errorClass);
				element.removeClass(options.validatedClass);
			}
			else if ( options.addclass == true )
			{
				element.removeClass(options.errorClass);
				element.addClass(options.validatedClass);
			}
			
			if ( hideErrorB )
				hideError(ErrorElement, options.message);
			
			return true;
		}
		else
		{
			element.trigger('validated-invalid.validator', [form, element, options, ErrorElement]);
			
			if ( clearClass )
			{
				element.removeClass(options.errorClass);
				element.removeClass(options.validatedClass);
			}
			else if ( options.addclass == true )
			{
				element.removeClass(options.validatedClass);
				element.addClass(options.errorClass);
			}
			
			if ( showErrors && options.message.length > 0 )
				showError(ErrorElement, options.message);
			
			return false;
		}
	}

	function showError(ErrorElement, message)
	{			
		$(ErrorElement).html(message);
		$(ErrorElement).fadeIn(500);
	}
	
	function hideError(ErrorElement, message)
	{
		if ( message != undefined && message != $(ErrorElement).text() )
			return;
		
		$(ErrorElement).fadeOut(500, function(){
			$(this).html('');
		});
	}
	}
	
	$.expr[':'].isfilled = function(obj, index, meta, stack)
	{
		var	$this = $(obj);
		
		if ( $this.is('input[type=checkbox]') )
			return $this.is(':checked');
		else
			return ( $this.val() !== "" );
	};
	
	$.fn.FormValidator.defaults = { name: '', min: -1, max: -1, required: true, dependson: false, message: '', equalsTo: '', regex: /^(.+)$/i, notAllRequired: true, addclass: true, validatedClass: "valid", errorClass: "invalid", defaultText: '' }
})(jQuery);