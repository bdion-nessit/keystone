jQuery(function($) {
    $(document).ready(function() {
        function queryData(source, existingQuery) {
			
			if(existingQuery) {
				if($(source).data('meta_key') && $(source).data('meta_value')) {
					existingQuery.meta.push({
						key:$(source).data('meta_key'), 
						val:$(source).data('meta_value'),
						compare:$(source).data('meta_compare'),
					});
				}
				
				if($(source).data('taxonomy') && $(source).data('terms')) {
					existingQuery.tax.push({
						tax:$(source).data('taxonomy'), 
						terms:$(source).data('terms'),
					});
				}
				
				if($(source).data('s')) {
					existingQuery.query_data.s = $(source).data('s');
				}
				
				if($(source).data('callback') && !existingQuery.callback) {
					existingQuery.callback = $(source).data('callback');
				}
				
				return existingQuery;
			}
			
			var orderBy = $(source).data('orderby');
			var query = {
                query_data:{
                    post_type:$(source).data('post_type'),
                    orderby:orderBy,
                    posts_per_page:$(source).data('posts_per_page'),
                    s:$(source).data('s'),
                    order:($(source).hasClass('asc') ? 'ASC' : 'DESC'),
					cat:$(source).data('cat'),
                },
                callback:$(source).data('callback'),
				remove_target: $(source).data('remove_target'),
				tax:[],
				meta:[],
            }
			if(orderBy && (orderBy === 'meta_value' || orderBy === 'meta_value_num')) {
				query.query_data.meta_key = $(source).data('meta_key');
			}
			
            return query;
        }
        
        var request;
        $('.post-sort').click(function() {			
			$(this).siblings('.post-sort').removeClass('js-active-sort');
			if(!$(this).hasClass('js-active-sort')) {
			   $(this).addClass('js-active-sort')
			}
			
            var _this = this;
            $(this).toggleClass('asc')
                .siblings('.post-filter').toggleClass('asc');
            filterInput(this, this);
        });
        
        $('.post-filter').on('input', function() {
			$(this).siblings('.post-sort-content').html('<div class="sorter-loading"><img src="/wp-content/themes/lucid-equipment-theme/images/loading_icon_cropped.gif" alt="Loading results" /></div>');
			filterInput(this, this);
        });
        
		function filterInput(field, context) {
			var dataToSend;
			var starter = $(field).siblings('.js-active-sort').length ? $(field).siblings('.js-active-sort') : field;
			
			if($(context).siblings('.filter-global').length) {
				var filterGlobal = $(context).siblings('.filter-global');
				let temp = queryData($(context).siblings('.filter-global'));
				starter.data('post_type', filterGlobal.data('post_type'));
				starter.data('posts_per_page', filterGlobal.data('posts_per_page'));
			}
			dataToSend = queryData(starter);
			

			var filters = $.merge($(context).siblings('.pods-form-fields').find('input.pods-form-ui-field-name-watch-lists.sorter').siblings('.sorter-data'), $(context).siblings('.post-filter'));
			filters = $.merge(filters, $(context).parent().find('.slider-range').find('.slider-range-data'));
			if (starter !== field) {
				filters.push(field);
			} 
			
			$.each(filters, function(i, j) {
								
				var clearMetaVal = false;
				
				if($(j).data('meta_key') && !$(j).data('meta_value') && !$(j).data('orderby')) {
					$(j).data('meta_value', $(j).val());
					clearMetaVal = true;
				}
				else {
					if($(j).data('type') && $(j).data('type') === 'search') {
						$(j).data('s', $(j).val());
					}
				}
				
				dataToSend = queryData(j, dataToSend);
				if(clearMetaVal) {
					$(j).data('meta_value', '');
				}
			});
			
            if(request) {
                request.abort();
            }
            
			//console.log(dataToSend);
            request = $.post(ajax_admin_url.ajax_url, {
                action:'custom_post_query',
                data:dataToSend,
                dataType:'json',
            }, function(resp) {
                doCustomPostQuery(resp, ($(context).parent('.filter-sort-wrap').length ? $(context).parent() : $(context)));
            });
		}
        
        
        function doCustomPostQuery(resp, button) {
            resp = $.parseJSON(resp);
			//console.log(resp);
            if(resp.type === 'string') {
				if(resp.remove_target) {
					var target = $(resp.remove_target);
					target.first().after(resp.content);
					target.remove();
				}
				else {
				   $(button).siblings('.post-sort-content').html(resp.content);
				}
            }
			initializeButtons();
        }
    });
});