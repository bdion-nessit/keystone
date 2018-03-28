var singleSliders = {}; //Store single items sliders for later access
var midClick = false;



jQuery(function($) {
	$(document).ready(function() {
		
		//Begin single item slider "object" "class"
			function singleSlider(j, k, controls, windowWidth, scrollPos) {
				this.j = j;
				this.k = k;
				this.controls = controls;
				this.windowWidth = windowWidth;
				this.scrollPos = scrollPos;
				this.hasAutoRotate = $(j).data('auto_rotate') ? $(j).data('auto_rotate') : 'no';
				
				if(this.hasAutoRotate === 'yes') {
					this.autoRotator();
				}
			}
		
		singleSlider.prototype.resize = function() {
			var windowScale = $('body').width() / this.windowWidth;
			scrollPos = this.scrollPos * windowScale;
			this.windowWidth = $('body').width();
			this.formSlideHeight();
			this.positionSlides(0);
			$('body').scrollLeft(this.scrollPos);
		};
		
		//Positions the slides relative to the window size
		//Uses height of larges slide
		singleSlider.prototype.positionSlides = function(left) {
			var slideHeight = 100;

			$(this.k).find('.content-slide').each(function(l,m) {
				$(m).show();
				left += this.windowWidth;
				slideHeight = Math.max(slideHeight, $(m).innerHeight());
			});
				
			//make sure slider isn't also a form
			if(!$(this.j).hasClass('form-slide-wrap')) {
            	$(this.k).height(slideHeight);
        	}
		};
		singleSlider.prototype.formSlideHeight = function() {
			if(!$(this.j).hasClass('form-slide-wrap')) {
        		return;
        	}
			var curSlide = $(this.k).find('.content-slide.active');
			$(this.k).height(curSlide.height() + 225);
		};
		singleSlider.prototype.autoRotator = function() {
			
			this.autoRotate = setTimeout(function(slider) {
				$(slider.controls).find('.content-slide-next').trigger('click');
			}, 5000, this);
			
			return;
		}
		
		//End single item slider "object" "class"
		
		$('.single-slide-wrap').each(function(i, j) {
			var k = $(j).children().first();
			var controls = $(j).find('.content-slider-controls');
			var windowWidth = $(j).width();
			var initialScroll = true;
			var scrollPos = 0;
			var curPage = 'app';
			var canScroll = true;
			var scrollDebounce;
			var curScrollLeft = 0;
			
			var sliderObject = new singleSlider(j, k, controls, windowWidth, scrollPos);
			var sliderId = $(j).data('slider_id');
			if(sliderId) {
			   singleSliders[sliderId] = sliderObject;
			}
			else {
				singleSliders.push(sliderObject);
			}
			
			$(window).resize(function() {
				sliderObject.resize();
			});
            
            $('.form-slide-prev').hide(); //Hide back button as slider loads on first slide
			
		var userSlide = true;
			
			//Create buttons to jump to each slide, dynamically
			var buttons = "";
			
			//Initializes slider
			//Waits until inner grid items have loaded if applicable
			function initializeSliderWGrid(sliderObject) {
				
				//Check if inner grid exists but its "slides" haven't loaded yet.  
				if(k.find('.vc_grid-container-wrapper').length && !k.find('.vc_grid-container-wrapper').find('.content-slide').length) {
					setTimeout(function() {
						initializeSliderWGrid(sliderObject)	
					}, 250);
					return;
				}
				
				//initializes slides			
				sliderObject.positionSlides(0);
				sliderObject.formSlideHeight();
				
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
				$(".single-slider-controls .content-slide-button").click(function() {

					if(!$(this).hasClass('active')) {
						userSlide = false;

						//Consider overhauling to just get active slide directly
						var curSlide = $(j).find('.content-slide:eq(' + (parseInt(controls.find(".active").data('slide')) - 1) + ')'); //Gets active slide by finding the slide that corresponds to the "active" button
						controls.find(".active").removeClass('active');

						$(this).addClass('active');
						var newSlide = $(j).find('.content-slide:eq(' + (parseInt($(this).data('slide')) - 1) + ')'); //Gets the slide being moved to by finding the slide that corresponds to the clicked button

						curSlide.css('opacity', 0).removeClass('active')
							.children('.vc_grid-item-mini').css('opacity', 0);
						newSlide.css('opacity', 1).addClass('active')
							.children('.vc_grid-item-mini').css('opacity', 1);
						curScrollLeft = newSlide.index() * k.width();

						//Slider becomes scrollable at mobile sizes
						//In such cases, use debouncing to control behavior
						if(window.innerWidth <= 768) {
							canScroll = false;
							if(scrollDebounce) {
								clearTimeout(scrollDebounce);
							}
							scrollDebounce = setTimeout(function() {
								k.animate({scrollLeft : curScrollLeft}, 100, function() {
									canScroll = true;
								});
							}, 50);
						}
						setTimeout(function() { userSlide = true; }, 500);
						setTimeout(function() { midClick = false; }, 25);
					}
				});
			}
			
			setTimeout(function() {
						initializeSliderWGrid(sliderObject)	
					}, (k.find('.vc_grid-container-wrapper').length ? 250 : 1));
			
			//When user is done scrolling, finish scrolling slide for them if needed
			//Keeps the slider cleaner looking and aims to make scrolling easier
			jQuery('.content-slide-wrap > .vc_column-inner').on('scroll', function() { 
				if(midClick || window.innerWidth >= 768 || !canScroll) {
					return;
				}
				
				//Scrolling right
				if($(this).scrollLeft() > curScrollLeft && $(this).find('.active').next().length) {
					let offsetMod = $(this).find('.active').next().offset().left % $(this).parent().width(); //How far in the left edge of the next slide is
					
					//Checks if the next slide is visible and scrolled in enough to be worth finishing the scroll
					if($(this).find('.active').next().offset().left < $(this).parent().width() && offsetMod < ($(this).parent().width() / 2) && offsetMod !== 0) {
						midClick = true;
						$(this).parent().siblings('.content-slider-controls').find('.content-slide-next').trigger('click');
					}
				}
				
				//Scrolling left
				else {
					if($(this).scrollLeft() < curScrollLeft && $(this).find('.active').prev().length) {
						let offsetMod = Math.abs($(this).find('.active').prev().offset().left) % $(this).parent().width(); //How far in the left edge of the prev slide is
						
						//Checks if the prev slide is visible and scrolled in enough to be worth finishing the scroll
						if(Math.abs($(this).find('.active').prev().offset().left) < $(this).parent().width() && offsetMod < ($(this).parent().width() / 2) && offsetMod !== 0) {
							midClick = true;
							$(this).parent().siblings('.content-slider-controls').find('.content-slide-prev').trigger('click');
						}
					}
				} 
				
				//Don't auto-scroll until user is done scrolling
				if(scrollDebounce) {
						clearTimeout(scrollDebounce);
					}
					scrollDebounce = setTimeout(function() {
						k.animate({scrollLeft : curScrollLeft}, 100, function() {
							canScroll = true;
						});
				}, 101);
			});
		});
		
		//In order to reduce complexity, clicking the "previous" or "next" buttons behaves as if you had clicked the button of the previous or next slide, respectively
		$('.single-slider-controls .content-slide-prev').click(function() {
			var sliderId = $(this).parents('.content-slide-wrap').data('slider_id');
			var curSlider = singleSliders[sliderId];
			var controls = curSlider.controls;
			
			if(!(controls.find('.active').prevAll(".content-slide-button").length <= 0)) {
				controls.find('.active').prevAll(".content-slide-button").last().trigger('click');
			}
			else {
				controls.find('.content-slide-button').last().trigger('click');
			}
			
			if(curSlider.hasAutoRotate === 'yes') {
				curSlider.autoRotator();
			}
		});
		$('.single-slider-controls .content-slide-next').on('click', function() {
			var sliderId = $(this).parents('.content-slide-wrap').data('slider_id');
			var curSlider = singleSliders[sliderId];
			var controls = curSlider.controls;
			
			if(!(controls.find('.active').nextAll(".content-slide-button").length <= 0)) {
				controls.find('.active').nextAll(".content-slide-button").first().trigger('click');
			}
			else {
				controls.find('.content-slide-button').first().trigger('click');
			}
			
			if(curSlider.hasAutoRotate === 'yes') {
				curSlider.autoRotator();
			}
		});
	});
});