;(function($){
	$(document).ready(function() {

		$('#freetile-demo').children().each(function()
		{
			$(this).freetile({
				animate: true,
				elementDelay: 10
			});
		});
	});
})(jQuery)
				
