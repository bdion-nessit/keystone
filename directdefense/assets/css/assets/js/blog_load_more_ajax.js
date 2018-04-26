jQuery(function($) {
  $(document).ready(function() {
  	var paged = 2;
  	var request;
	$('#load-more').click(function() {
		if(request) {
			request.abort();
		}
		var cats, tax_type;
		cats = tax_type = [];
		var dataToSend = {
			'cat' : $('.posts-data').data('cat'),
			'tax_type' : $('.posts-data').data('tax_type'),
			'type' : $('.posts-data').data('type'),
			'subtype' : $('.posts-data').data('subtype'),
			'i' : $('.posts-data').data('i'),
			'count' : $('.posts-data').data('count'),
		};
		if(dataToSend.is_cat || dataToSend.is_tag) {
			dataToSend.cat = $('.load-more-wrap').data('cat');
		}
		request = jQuery.post(ajax_admin_url.ajax_url, {
			'action' : 'blog_load_more',
			'data' : dataToSend,
			'dataType' : 'json'
 		},
 		loadMorePosts);
	});

	function loadMorePosts(response) {
		response = $.parseJSON(response);
		console.log(response);
		var content = response.content.substr(response.content.indexOf('<div class="posts-row">'));
      	content = content.substr(0, content.length-12);
		$('.posts-data').before(content);
		$('.posts-data').data('i', response.i);
		if(!response.has_next) {
			$('.load-more-wrap').hide();
		}
		else {
	        $('.load-more-wrap').show();
	      }
		paged++;
	}

  }); 
});