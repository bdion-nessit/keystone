<?php
function do_blog_load_more() {
	global $i;
	global $archive;
	global $type;
	
	//Get and sanitize data
	$data = filter_input_array(INPUT_POST, array(
		'data' => array(
			'filter' => FILTER_SANITIZE_STRING,
			'flags' => FILTER_REQUIRE_ARRAY,
			)
		));
	
	//Store data elements as easier to manage variables
	$cats = $data['data']['cat'];
	$tax_types = $data['data']['tax_type'];
	$type = $_POST['data']['type'];
	$type = (empty($type) ? 'post' : $type);
	$subtype = $_POST['data']['subtype'];
	$count = (!empty($_POST['data']['count']) ? intval($_POST['data']['count']) : 10);
	$i = intval($_POST['data']['i']);
	
	$content = ''; //Initialize content
	$paged = 1 + (($i - ($i % $count)) / $count); //next "page" of content
	
	//Query args for getting next "page" of content
	$args = array(
		'post_type' => $type,
		'paged' => $paged,
		'posts_per_page' => $count,
		);
	
	//Query args to determine if there is another "page" after the next one
	$args2 = array(
		'post_type' => $type,
		'paged' => $paged + 1,
		'posts_per_page' => $count,
		);
	
	$widget_args = array(
			'post_types' => 'document',
			'show_featured_image' => 'yes',
			'no_filter' => true,
			'post_count' => 5,
			'use_pagination' => 'yes',
			'paged' => $paged,
			);
	$widget_args['post_cats'] = implode(',', $cats);
	
	if(!empty($widget_args['post_cats'])) {
		$widget_args['tax_type'] = implode(',', $tax_types);
		
		//Initialize array of tax querys to be added to the query args
		$tax_arr = array(
        'relation' => 'AND',
        );
		
		foreach($tax_types as $tax_type) {
        $temp = array(
          'relation' => 'OR',
          );
			foreach($cats as $cat) {
				//Store individual tax query in temporary variable
			  $temp[] = array(
			  'taxonomy' => $tax_type,
			  'field' => 'slug',
			  'terms' => $cat,
			  'operator' => 'IN',
			  );
			}
			
			$tax_arr[] = $temp; //Add tax query to array of tax queries
			
			$args['tax_query'] = $tax_arr; //Set the query to use the array of tax queries
			$args2['tax_query'] = $tax_arr; //Set the query to use the array of tax queries
      }
	}
	
	//Clear post_cats from $widget_args if it's set but empty
	if(isset($widget_args['post_cats']) && empty($widget_args['post_cats'])) {
		unset($widget_args['post_cats']);
	}
	
	$query1 = new WP_QUERY($args); //Get next "page" of content
	if ($query1->have_posts()) {
		$content = joints_vc_custom_posts_widget($widget_args);
	}
	
	//Check if there's content after the next "page"
	$query2 = new WP_QUERY($args2); 
	$has_next = count($query2->posts) > 0;
	
	$output = array(
		'has_next' => $has_next,
		'i' => $i,
		'content' => $content,
		);
	
	print(json_encode($output));
	die();
}