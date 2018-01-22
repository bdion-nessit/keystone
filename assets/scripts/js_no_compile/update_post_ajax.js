function updatePost(elem) {
	var _this = this;
	jQuery(function($) {
		var request;
		var noErrors = true;
		console.log(elem);
		
		$(_this).siblings('.required').each(function(i, j) {
			if(!$(j).val()) {
				noErrors = false;
				return;
			}
		}).promise().done(function() {
			if(!noErrors) {
			   return;
			}
			if(request) {
				request.abort();
			}
			var dataToSend = {
				'action':$(_this).data('action'),
				'post_no':$(_this).data('post_no'),
				'post_type':$(_this).data('post_type'),
				'post_fields':{
					'post_content':$(_this).siblings('input[name="post_content"], textarea[name="post_content"]').val(),
				},
				'meta_fields':{},
				'field_type':$(_this).data('field_type'),
				'target':$(_this).data('target'),
				'messages':$(_this).data('messages'),
				'callback':$(_this).data('callback'),
			};

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
		//console.log(resp);
		
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
		if(resp.callback) {
			window['updateFavorites'](resp, button);
		}
	});
}

//jQuery('.update-post').click(updatePost);
	