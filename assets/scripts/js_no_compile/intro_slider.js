var degBase; //The amount by which the slider rotates each time
var deg = 0; //The current rotation value
var isOld = !(Modernizr.preserve3d); //Checks if browser supports transform-style: preserve-3d
var autoRotate;

//Initialize slider
jQuery(document).ready(function() {
	degBase = 360 / jQuery(".intro-slides .intro-slide").length;
	if(!isOld) {
		initializeSlides(0);
	}
	else {
		rotateSlidesOld(0);
		$('.intro-slides').css('-webkit-transform-style', 'flat')
							.css('transform-style', 'flat');
		$('.intro-slide').css('-webkit-transform-style', 'flat')
							.css('transform-style', 'flat');
		setTimeout(function() {
			jQuery('.intro-slider-preload').removeClass('intro-slider-preload');
		}, 800);
	}
	autoRotate = setTimeout(function() { jQuery(".intro-slider-next").trigger('click'); }, 10000);
});

//Rotate to previous slide
jQuery(".intro-slider-prev").click(function() { 
		deg -= degBase; //Decrements the rotation value to rotate left by one slide
		if(!isOld) {
			rotateSlides(deg / degBase);
		}
		else {
			rotateSlidesOld(deg / degBase);
		}
});
jQuery(".intro-slider-next").click(function() { 
		clearTimeout(autoRotate);
		deg += degBase; //Increments the rotation value to rotate left by one slide
		if(!isOld) {
			rotateSlides(deg / degBase);
		}
		else {
			rotateSlidesOld(deg / degBase);
		}
		autoRotate = setTimeout(function() { jQuery(".intro-slider-next").trigger('click'); }, 10000);
});
function initializeSlides(rotation) {
    var rotDeg, angle, sliderLen;

    //For each slide
	jQuery(".intro-slides .intro-slide").css('z-index', 1)
		.each(function(i, j) {

			//Keeps the rotation within -180 to 180
			rotDeg = (-i + rotation) * degBase;
			rotDeg = (rotDeg >= 360 ? rotDeg - 360 : rotDeg);
			rotDeg = (rotDeg <= -360 ? rotDeg + 360 : rotDeg);
			rotDeg = (rotDeg > 180 ? rotDeg - 360 : rotDeg);
			rotDeg = (rotDeg < -180 ? rotDeg + 360 : rotDeg);

        	angle = 180 / jQuery(".intro-slides .intro-slide").length; //Angle use for calculating apothem
        	sliderLen = (100 / (2 * Math.tan(angle * (Math.PI / 180)))); //Finds the length of the slider's apothem, aka how far forward each slide should be moved to line up correctly
			jQuery(j).css('transform', 'rotateY(' + rotDeg + 'deg)  translateZ(' + sliderLen + 'vw)'); //Rotates the slide then moves it forward
		});

	//Sets the perspective value for the slider
    jQuery('.intro').css('-moz-perspective', sliderLen + 'vw')
                        .css('-webkit-perspective', sliderLen + 'vw')
                        .css('perspective', sliderLen + 'vw');

    //Initializes the slider's 3d transform
    jQuery('.intro-slides').css('transform', 'translateZ(-' + sliderLen + 'vw) rotateY(' + deg + 'deg)');
    setTimeout(function() {
    	jQuery('.intro-slider-preload').removeClass('intro-slider-preload');
    }, 800);
}
function rotateSlides(rotation) {
	var angle = 180 / jQuery(".intro-slides .intro-slide").length; //Angle for calculating apothem
    var sliderLen = (100 / (2 * Math.tan(angle * (Math.PI / 180)))); //Finds the length of the slider's apothem, aka how far forward each slide should be moved to line up correctly

    //Rotates the slider.
    //Reincludes the translateZ by necessity.
    jQuery('.intro-slides').css('transform', 'translateZ(-' + sliderLen + 'vw) rotateY(' + deg + 'deg)');

    //If the slider has made a full rotation
    //Keeps the rotation within -360 to 360 while helping to alleviate jumping
    if(deg === -360 || deg === 360) {
        deg = 0; //Reset rotation variable

        //Sets the reset to happen after the initial transition has mostly completed
    	setTimeout(function() {
        	jQuery('.intro-slides').css('transition', 'all 0s')
                                  .css('transform', 'translateZ(-' + sliderLen + 'vw) rotateY(' + deg + 'deg)');

            //Resets the slider's transition value after reset
            setTimeout(function() {
            	jQuery('.intro-slides').css('transition', 'all .8s')
            							.css('transition-timing-function', 'ease-out');
            }, 100);
        }, 700);
                       
    }
}
//Backup for browsers that don't support transform-style: preserve-3d
function rotateSlidesOld(rotation) {
	jQuery(".intro-slides .intro-slide").css('z-index', 1)
	.each(function(i, j) {
		var rotDeg = (-i + rotation) * degBase;
		rotDeg = (rotDeg >= 360 ? rotDeg - 360 : rotDeg);
		rotDeg = (rotDeg <= -360 ? rotDeg + 360 : rotDeg);
		rotDeg = (rotDeg > 180 ? rotDeg - 360 : rotDeg);
		rotDeg = (rotDeg < -180 ? rotDeg + 360 : rotDeg);
		if(rotDeg === degBase || rotDeg === -degBase) {
			jQuery(j).css('z-index', 2);
		}
		if(rotDeg === 0) {
			jQuery(j).css('z-index', 3);
		}
     	var angle = 180 / jQuery(".intro-slides .intro-slide").length;
    	var sliderLen = (100 / (2 * Math.tan(angle * (Math.PI / 180))));
		jQuery(j).css('transform', 'rotateY(' + rotDeg + 'deg)  translateZ(' + sliderLen + 'vw)');
	});
}

