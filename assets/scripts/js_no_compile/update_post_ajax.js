function updatePost(elem) {
	var _this = this;
	
	jQuery(function($) {
		var request;
		var noErrors = true;
		
		$(_this).siblings('.required').each(function(i, j) {
			//If a required item is empty, request fails validation
			if(!$(j).val()) {
				noErrors = false;
				return;
			}
		}).promise().done(function() {
			if(!noErrors) {
			   return;
			}
			
			if(jQuery(_this).data('confirmation')) {
				var confirm = window.confirm(jQuery(_this).data('confirmation'));

				if(!confirm) {
					return false;
				}
			}
			
			if(request) {
				request.abort();
			}
			
			var dataToSend = {
				'action':$(_this).data('action'),
				'post_no':$(_this).data('post_no'),
				'post_type':$(_this).data('post_type'),
				'post_fields':{},
				'meta_fields':{},
				'field_type':$(_this).data('field_type'),
				'target':$(_this).data('target'),
				'messages':$(_this).data('messages'),
				'callback':$(_this).data('callback'),
			};
			var post_fields = $(_this).data('post_fields'); 
			var content = $(_this).data('content');
			
			if(post_fields) {
			   $.each(post_fields, function(i, j) {
				   dataToSend.post_fields[j] = content[i];
			   });
			}
			
			//Store each meta field to be updated separately
			$(_this).siblings('.meta').each(function(k, l) {
				dataToSend.meta_fields[$(l).attr('name')] = $(l).val();
			});

			request = $.post(ajax_admin_url.ajax_url, {
				'action':'update_post',
				'data':dataToSend,
				'dataType':'json',
			}, function(resp) {
				processUpdate(resp, _this);
			});
		});
	});
}
function processUpdate(resp, button) {
	jQuery(function($) {
		resp = $.parseJSON(resp);
		
		if(resp.target === 'this') {
			$(button).find('button').html(resp.message)
				.addClass((resp.status === 'error' ? 'message-red' : ''));
		}
		else {
			$(button).siblings(resp.target).html(resp.message)
				.addClass('message-' + (resp.status === 'error' ? 'red' : 'green'));
		}
		
		if(resp.status === 'success') {
		   $(button).siblings('input[type="text"], textarea').val('');
		}
		
		switch(resp.callback) {
			case 'reload':
				location.reload();
				break;
		}
	});
}

jQuery('.update-post').on('click', updatePost);
	