(function($, undefined){

	$.fb_lazyload = function(classNameOld, classNameNew)
	{
		$(window).lazyBind('scroll', function()
		{
			doWork(classNameOld, classNameNew);
		}, 100);
		
		doWork(classNameOld, classNameNew);
	}
	
	function doWork(classNameOld, classNameNew)
	{
		var $load = $('.' + classNameOld + ':isInView');			
		$load.removeClass(classNameOld).addClass(classNameNew);
			
		$load.each(function(){
			FB.XFBML.parse($(this).parent().get(0));
		});
	}
	
	$.fn.lazyBind = function(event, func, delay)
	{
		var timer = null;
		
		$(this).bind(event, function()
		{
			if ( timer != null )
				clearTimeout(timer);			
			
			timer = setTimeout(func, delay);
		});
	}

	$.expr[':'].isInView = function(obj, index, meta, stack) {
		var $this = $(obj);
		
		return $this.offset().top >= $(window).scrollTop() && $this.offset().top <= $(window).scrollTop() + $(window).height();
	};
})(jQuery);