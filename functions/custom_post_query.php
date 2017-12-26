<?php
function do_custom_post_query() {
    $data = filter_input_array(INPUT_POST, array(
        'data' => array(
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_REQUIRE_ARRAY,
        ),
    ));
    $data = $data['data'];
    $args = array();
    foreach($data['query_data'] as $i => $item) {
        $args[$i] = (preg_match("/\,/", $item) ? explode(',', $item) : $item);
    }
	if(!empty($data['tax'])) {
		$args['tax_query'] = array();
		
		if(count($data['tax']) > 1) {
			$args['tax_query'] = array(
				'relation' => 'AND'
			);
		}
		
		foreach($data['tax'] as $tax) {
			array_push($args['tax_query'], array(
				'taxonomy' => $tax['tax'],
				'terms' => explode(',', $tax['terms']),
			));
		}
	}
	if(!empty($data['meta'])) {
		$args['meta_query'] = array();
		
		if(count($data['meta']) > 1) {
			$args['meta_query'] = array(
				'relation' => 'AND'
			);
		}
		foreach($data['meta'] as $meta) {
			array_push($args['meta_query'], array(
				'key' => $meta['key'],
				'value' => $meta['val'],
				'compare' => preg_replace("/GREATER THAN/", '>', preg_replace("/LESS THAN/", '<', $meta['compare'])),
			));
		}
	}
	
    $query1 = new WP_Query($args);
    $output = array();
    if(!empty($data['callback'])) {
        $output['content'] = $data['callback']($query1);
        $output['type'] = 'string';
		$output['args'] = $args;
    }
	else {
		$output['type'] = 'string';
		
		if($query1->have_posts()) {
			global $is_custom_query;
			$is_custom_query = true;
			ob_start();
			$j = 0;
			while($query1->have_posts()) {
				$query1->the_post();
				require(get_stylesheet_directory() . '/parts/loop-archive.php');
				$j++;
			}
			$output['j'] = $j;
			$output['content'] = ob_get_contents();
			$output['args'] = $args;
			ob_end_clean();
		}
		else {
			$output['content'] = '<article id="" class="post-filler post type-' . $data['query_data']['post_type'] . ' status-publish format-standard hentry" role="article">	';
		}
		wp_reset_postdata();
	}
	
	if(!empty($data['remove_target'])) {
		$output['remove_target'] = $data['remove_target'];
	}
    
    print(json_encode($output));
    die();
}