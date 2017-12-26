function toggle_modal() {
	var elemID = jQuery(this).attr('id'); //Get the button's ID
    var modal = jQuery('#' + elemID + '-modal'); //Use ID to get modal ID
	
	//If the button has a modal data field, use that to get the modal instead
	if(jQuery(this).data('modal')) {
		modal = jQuery('.js-modal.' + jQuery(this).data('modal'));
	}
	
	//If the buttons info yielded an actual modal element
    if(modal.length) {
    	modal.show();
		modal.find('.multi-slider-wrap').trigger('initialize'); //Triggers the multi slider's initialize function so that it has the correct width when the modal oens
    }
   }

jQuery(function($) {

	$('.custom_button').on('click', '', toggle_modal);

	//Close the modal when clicking "Close" or the background behind it
	$('.modal-content .js-close-x').click(function() {
		$(this).parent().parent().hide();
	});
	$('.js-modal-background').click(function() {
		$(this).parent().hide();
	});
		
});