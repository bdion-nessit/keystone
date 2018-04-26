<?php
function do_document_filter() {
	global $i;
	global $archive;
	global $type;
	$data = filter_input_array(INPUT_POST, array(
		'data' => array(
			'filter' => FILTER_SANITIZE_STRING,
			'flags' => FILTER_REQUIRE_ARRAY,
			)
		));
	$count = (!empty($_POST['data']['count']) ? intval($_POST['data']['count']) : 10);
	$type = $data['data']['type'];
	$subtype = $data['data']['subtype'];
	$cats = $data['data']['cat'];
	$tax_types = $data['data']['tax_type'];
	$args = array(
		'post_type' => $data['data']['type'],
		'post_status' => 'publish',
		'posts_per_page' => $count,
		);
	$widget_args = array(
			'post_types' => 'document',
			'show_featured_image' => 'yes',
			'no_filter' => true,
			'post_count' => $count,
			'use_pagination' => 'yes',
			);
	$widget_args['post_cats'] = implode(',', $cats);
	if(!empty($widget_args['post_cats'])) {
		$widget_args['tax_type'] = implode(',', $tax_types);
		$tax_arr = array(
        'relation' => 'AND',
        );
		foreach($tax_types as $tax_type) {
        $temp = array(
          'relation' => 'OR',
          );
        foreach($cats as $cat) {
          $temp[] = array(
          'taxonomy' => $tax_type,
          'field' => 'slug',
          'terms' => $cat,
          'operator' => 'IN',
          );
        }
        $tax_arr[] = $temp;
        $args['tax_query'] = $tax_arr;
      }
	}
	if(isset($widget_args['post_cats']) && empty($widget_args['post_cats'])) {
		unset($widget_args['post_cats']);
	}
	$args2 = $args;
	$args2['paged'] = 2;
	$query1 = new WP_Query($args);
	$content = '';
	$i = 1;
	if ($query1->have_posts()) {
		$content = joints_vc_custom_posts_widget($widget_args);
	}
	$query2 = new WP_QUERY($args2);
	$has_next = count($query2->posts) > 0;
	$output = array(
		'content' => $content,
		'has_next' => $has_next,
		'i' => $i,
		);
	wp_reset_postdata();
	print(json_encode($output));
	die();
}