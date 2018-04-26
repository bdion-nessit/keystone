jQuery(function($) {
  $(document).ready(function() {
    var request;
    $('.document-filter-dropdown').change(function() {
      if(request) {
        request.abort();
      }
      var cats, tax_type;
      cats = [];
      tax_type = [];
      if($(this).val()) {
        cats.push($(this).val());
        tax_type.push($(this).data('type'));
      }
      $(this).parent().siblings('.document-filter').each(function(i,j) {
        console.log($(j));
        if($(j).children('.document-filter-dropdown').val()) {
          cats.push($(j).children('.document-filter-dropdown').val());
          tax_type.push($(j).children('.document-filter-dropdown').data('type'));
        }
      });
      console.log(cats);
      console.log(tax_type);
      $('.posts-data').data('tax_type', tax_type);
      $('.posts-data').data('cat', cats);
      var dataToSend = {
        'type' : $('.posts-data').data('type'),
        'tax_type' : tax_type,
        'cat' : cats,
        'count' : $('.posts-data').data('count'),
      };
      request = $.post(ajax_admin_url.ajax_url, {
        'action' : 'do_document_filter',
        'data' : dataToSend,
        'dataType' : 'json'
      }, documentFilter);
    });
    function documentFilter(response) {
      response = $.parseJSON(response);
      console.log(response);
      var content = response.content.substr(response.content.indexOf('<div class="posts-row">'));
      content = content.substr(0, content.length-12);
      $('.document-filter').siblings('.posts-row').remove();
      $('.document-filter').last().after(content);
      if(!response.has_next) {
        $('.load-more-wrap').hide();
      }
      else {
        $('.load-more-wrap').show();
      }
    }

  });
});