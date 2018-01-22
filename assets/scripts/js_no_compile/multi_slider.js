var canCheckSticky = true;

//Display the details for the selected slide
function slideDetails(j) {
	var info = j.siblings('.slider-info');
	
	info.find('.slide-title span').html(j.find('.multi-slide').first().data('title'));
	info.find('.slide-description span').html(j.find('.multi-slide').first().data('caption'));
	
	j.find('.multi-slide').click(function() {
		info.find('.slide-title span').html((jQuery(this).data('title') ? jQuery(this).data('title') : ""));
		info.find('.slide-description span').html((jQuery(this).data('caption') ? jQuery(this).data('caption') : ""));
	});
}

function slideFeatured(j) {
	var bg = j.find('.multi-slide').first().css('background-image');
	
	if(!bg || bg === 'none') {
	  bg = 'url(\'' + j.find('.multi-slide').first().find('img').attr('src') + '\')';
	}
	
	j.parent().parent().siblings('.slider-featured').css('background-image', bg);
	
	j.find('.multi-slide').click(function() {
		var bg = jQuery(this).css('background-image');
		if(!bg || bg === 'none') {
		  bg = 'url(\'' + jQuery(this).find('img').attr('src') + '\')';
		}
		j.parent().parent().siblings('.slider-featured').css('background-image', bg);
	});
}

jQuery(function($) {
	$(document).ready(function() {

		if($('.multi-slide').length) {
			$('.multi-slide-wrap').each(function(i, j) {
				var sliderWidth = $(j).width();
				var curScroll = 0;
				var slideCount = $(j).find('.multi-slide').length;
				var controls = $(j).find('.content-slider-controls');
				var canRotate = true;

				function getVisibleSlides() {
					switch(true) {
						case (window.innerWidth > 1024):
							return 4;
						case (window.innerWidth > 767):
							return 3;
						case (window.innerWidth > 640):
							return 2;
						default: 
							return 1;
					}
				}

				var visibleSlides = getVisibleSlides();

				function initializeMultiSlider() {
					var sliderHeight = 0;
					$(j).find('.multi-slider').height('');
					$(j).find('.multi-slide').each(function(k, l) {
						$(l).outerWidth(Math.max((sliderWidth / visibleSlides), (sliderWidth / $(j).find('.multi-slide').length)) + 'px');
						sliderHeight = Math.max(sliderHeight, $(l).outerHeight());
					});
					$(j).height(sliderHeight + 'px');
				}
				
				//Mainly here to fix the slider/slides on after resizing
				function adjustSlides() {
					var oldWidth = sliderWidth;
					var oldVisible = visibleSlides;
					
					sliderWidth = $(j).width();
					visibleSlides = getVisibleSlides();
					
					initializeMultiSlider();
					
					$(j).scrollLeft(curScroll * (sliderWidth / oldWidth) * (oldVisible / visibleSlides));
					curScroll = $(j).scrollLeft();
					//$('.multi-slider-wrap').scrollLeft(($('.multi-slider-wrap').scrollLeft() + sliderWidth - oldWidth) * (sliderWidth / oldWidth));
				}
				
				initializeMultiSlider();
				
				if($(j).parent().parent().siblings('.slider-featured').length) {
					slideFeatured($(j));
				}
				
				if($(j).siblings('.slider-info').length) {
					slideDetails($(j));
				}
				else {
					
				}
				
				$(j).on('initialize', function() {
					adjustSlides();
				});
				$(window).resize(function() {
					adjustSlides();
				});
				
				controls.find('.multi-prev').click(function() {
					var slideWidth = $(j).find('.multi-slide').first().outerWidth();
					var oldScroll = $(j).scrollLeft();
					var newScroll = oldScroll - slideWidth;
					
					//canRotate used to prevent overlapping clicks causing issues
					if(!canRotate) {
						setTimeout(function() {
							$(j).find('.multi-prev').trigger('click');
						}, 50);
					}
					else {
						canRotate = false;
						if(newScroll < -5) {
							$(j).animate({'scrollLeft' : ((slideWidth * slideCount) - sliderWidth)}, 350, function() {
								curScroll = $(j).scrollLeft();
								canRotate = true;
							});
						}
						else {
							$(j).animate({'scrollLeft' : newScroll}, 350, function() {
								curScroll = $(j).scrollLeft();
								canRotate = true;
							});
						}
					}
				});
				controls.find('.multi-next').click(function() {
					var slideWidth = $(j).find('.multi-slide').first().outerWidth();
					var oldScroll = $(j).scrollLeft();
					var newScroll = oldScroll + slideWidth;
					
					//canRotate used to prevent overlapping clicks causing issues
					if(!canRotate) {
						setTimeout(function() {
							$(j).find('.multi-next').trigger('click');
						}, 50);
					}
					else {
						canRotate = false;
						if(newScroll > ((slideWidth * slideCount) - sliderWidth + 5)) {
							$(j).animate({'scrollLeft' : 0}, 350, function() {
								curScroll = $(j).scrollLeft();
								canRotate = true;
							});
						}
						else {
							$(j).animate({'scrollLeft' : newScroll}, 350, function() {
								curScroll = $(j).scrollLeft();
								canRotate = true;
							});
						}
					}
					//$('.multi-slider-wrap').scrollLeft(oldScroll + slideWidth);
				});
			});
		}

	});
});