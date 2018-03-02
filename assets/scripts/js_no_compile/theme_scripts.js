function updateFavorites(data, button) {
	jQuery(button).siblings('.favorite-count').html(data.count + ' Favorites');
}

//Initial call is used to add listeners to items
//Remains available to be called if items are added to or removed from the DOM
function initializeButtons() {
	jQuery(function($) {
		$('.custom_button').off('click', '', toggle_modal);
		$('.update-post').off('click', '', updatePost);
		
		$('.custom_button').on('click', '', toggle_modal);
		$('.update-post').on('click', '', updatePost);
	});
}

initializeButtons();

jQuery(function($) {
	$('.hamburger-menu-wrap').click(function() {
		var target = $(this).data('target'); //"Target" the menu is controlling
		
		$(this).children('.hamburger-menu').toggleClass('active');
		
		if(!target) {
			target = '.mobile-menu';
		}
		
		$(target).toggleClass('active');
	});
});
