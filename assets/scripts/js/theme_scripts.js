function updateFavorites(data, button) {
	jQuery(button).siblings('.favorite-count').html(data.count + ' Favorites');
}

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
		var target = $(this).data('target');
		if($(this).children('.hamburger-menu').hasClass('active')) {
			$(this).children('.hamburger-menu').removeClass('active')
		}
		else {
			$(this).children('.hamburger-menu').addClass('active')
		}
		if(target) {
		   if($(target).hasClass('active')) {
				$(target).removeClass('active')
			}
			else {
				$(target).addClass('active')
			}
		}
		else {
			if($('.mobile-menu').hasClass('active')) {
				$('.mobile-menu').removeClass('active')
			}
			else {
				$('.mobile-menu').addClass('active')
			}
		}
	});
});
