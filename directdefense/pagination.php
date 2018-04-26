<?php
function do_blog_load_more() {
	global $i;
	global $archive;
	global $type;
	$data = filter_input_array(INPUT_POST, array(
		'data' => array(
			'filter' => FILTER_SANITIZE_STRING,
			'flags' => FILTER_REQUIRE_ARRAY,
			)
		));
	$cats = $data['data']['cat'];
	$tax_types = $data['data']['tax_type'];
	$type = $_POST['data']['type'];
	$type = (empty($type) ? 'post' : $type);
	$subtype = $_POST['data']['subtype'];
	$count = (!empty($_POST['data']['count']) ? intval($_POST['data']['count']) : 10);
	$i = intval($_POST['data']['i']);
	$content = '';
	$paged = 1 + (($i - ($i % $count)) / $count);
	$args = array(
		'post_type' => $type,
		'paged' => $paged,
		'posts_per_page' => $count,
		);
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
        $args2['tax_query'] = $tax_arr;
      }
	}
	if(isset($widget_args['post_cats']) && empty($widget_args['post_cats'])) {
		unset($widget_args['post_cats']);
	}
	$query1 = new WP_QUERY($args);
	if ($query1->have_posts()) {
		$content = joints_vc_custom_posts_widget($widget_args);
	}
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