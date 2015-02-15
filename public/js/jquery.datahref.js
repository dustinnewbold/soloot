;(function($) {
	// $('[data-href]').on('click', function() {
	// 	window.location = $(this).data('href');
	// });

	$('a[href=]').on('click', function(e) {
		alert('this one');
		e.stopPropagation();
	});
})(jQuery);