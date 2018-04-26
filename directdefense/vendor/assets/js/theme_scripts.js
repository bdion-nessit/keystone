var canCheckSticky = true;

jQuery(function($) {
	$(document).ready(function() {
		function toggle_modal() {
    		var elemID = $(this).attr('id');
    		var modal = $('#' + elemID + '-modal');
    		if(modal.length) {
    			modal.show();
    		}
    	}

	    $('.custom_button').click(toggle_modal);

	    $('.modal-content .close-x').click(function() {
	      $(this).parent().parent().hide();
	    });
	    $('.modal-background').click(function() {
	      $(this).parent().hide();
	    });

	    $(document).scroll(function() {
	    	if(!canCheckSticky) {
	    		return;
	    	}
	    	canCheckSticky = false;
	    	if($(document).scrollTop() >= window.innerHeight && !$('.site-nav').hasClass('sticky')) {
	    		$('.site-nav').addClass('sticky');
	    	}
	    	else {
	    		if($(document).scrollTop() < window.innerHeight && $('.site-nav').hasClass('sticky')) {
	    			$('.site-nav').removeClass('sticky');
	    		}
	    	}
	    	setTimeout(function() {
	    		canCheckSticky = true;
	    	}, 80);
	    });
	    $('#menu-primary-nav > .menu-item').mouseover(function() {
	    	$(this).children('.sub-menu').addClass('active');

	    });
	    $('#menu-primary-nav > .menu-item').mouseout(function() {
	    	$(this).children('.sub-menu').removeClass('active');
	    });
	});
});