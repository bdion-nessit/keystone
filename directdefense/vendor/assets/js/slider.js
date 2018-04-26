jQuery(function($) {
	$(document).ready(function() {
		$('.content-slide-wrap').each(function(i, j) {
			var k = $(j).children().first();
			var controls = $(j).find('.content-slider-controls');
			var windowWidth = $(j).width();
			var initialScroll = true;
			var scrollPos = 0;
			var curPage = 'app';
			var slideHeight = 100;

			//Positions the slides relative to the window size
			function positionSlides(left) {
				$(k).find('.content-slide').each(function(l,m) {
					$(m).show();
					left += windowWidth;
					slideHeight = Math.max(slideHeight, $(m).height());
				});
				$(k).height(slideHeight);
			}			

			//initializes slides
			positionSlides(0);

			//adjust slides on resize
			$(window).resize(function() {
				var windowScale = $('body').width() / windowWidth;
				scrollPos = scrollPos * windowScale;
				windowWidth = $('body').width();
				positionSlides(0);
				$('body').scrollLeft(scrollPos);

			});
		var userSlide = true;
			
			var buttons = "";
			for(var a = 1; a <= $(k).find('.content-slide').length; a++) {
				if(a === 1) {
					buttons += '<div class="content-slide-buttons"><button class="content-slide-button active" data-slide="' + a + '">';
				}
				else {
					buttons += '<button class="content-slide-button" data-slide="' + a + '">';
				}
				buttons +=  '</button>';
				if(!(a === $(k).find('.content-slide').length)) {
					buttons += '<span class="content-slide-div"></span>';
				}
				else {
					buttons += '</div>';
				}
			}
			controls.find('.content-slide-prev').after(buttons);
			
			//change slides

			$(".content-slide-button").click(function() {
				
				if(!$(this).hasClass('active')) {
					userSlide = false;
					var curSlide = $(j).find('.content-slide:eq(' + (parseInt(controls.find(".active").data('slide')) - 1) + ')');
					controls.find(".active").removeClass('active');
					$(this).addClass('active');
					var newSlide = $(j).find('.content-slide:eq(' + (parseInt($(this).data('slide')) - 1) + ')');
					curSlide.css('opacity', 0);
					newSlide.css('opacity', 1);
					setTimeout(function() { userSlide = true; }, 500);

				}
			});
			$('.content-slide-prev').click(function() {
				if(!(controls.find('.active').prev().prev(".content-slide-button").length <= 0)) {
					controls.find('.active').prev().prev(".content-slide-button").last().trigger('click');
				}
				else {
					controls.find('.content-slide-button').last().trigger('click');
				}
			});
			$('.content-slide-next').click(function() {
				if(!(controls.find('.active').next().next(".content-slide-button").length <= 0)) {
					controls.find('.active').next().next(".content-slide-button").first().trigger('click');
				}
				else {
					controls.find('.content-slide-button').first().trigger('click');
				}
			});
		});
	});
});