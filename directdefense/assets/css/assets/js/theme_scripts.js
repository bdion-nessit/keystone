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
	    	if(!canCheckSticky || window.innerWidth <= 767) {
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

	    $('.hamburger-menu-wrap').click(function() {
	    	$(this).parent().toggleClass('active');
	    });
	    
	    function setEventTarget() {
	    	if($('.upcoming-events-grid').length) {
	    		$('.upcoming-events-grid a').attr('target', '_blank');
	    	}
	    	else {
	    		setTimeout(function() {
			    	setEventTarget();
			    }, 100);
	    	}
	    }
	    setEventTarget();
	});
});