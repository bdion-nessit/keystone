jQuery(function($) {
	function setHoverBoxHeight() {
		$('.hover_box').each(function(i, j) {
			$(j).children().css('height', 'auto');
			
			var defaultHeight = $(j).children('.hover_box_default').innerHeight();
			var hoverHeight = $(j).children('.hover_box_hover').innerHeight();

			$(j).css('min-height', Math.max(defaultHeight, hoverHeight) + 'px');
			$(j).children().css('height', '');
		});
	}
	
	setHoverBoxHeight();
	
	$(window).resize(setHoverBoxHeight);
});