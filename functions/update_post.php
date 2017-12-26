<?php
function update_post() {
	$output = array();
	if(!is_user_logged_in()) {
		print(json_encode(array(
			'status' => 'error',
			'message' => 'You must be logged in to create warm fuzzies.'
		)));
		die();
	}
	$data = filter_input_array(INPUT_POST, array(
		'data' => array(
			'filter' => FILTER_SANITIZE_STRING,
			'flags' => FILTER_REQUIRE_ARRAY,
		),
	));
	$data = $data['data'];
	
	$data['post_type'] = (!empty($data['post_type']) ? $data['post_type'] : 'post');
	$data['post_no'] = (!empty($data['post_no']) ? $data['post_no'] : 0);
	$data['post_field'] = (!empty($data['post_field']) ? $data['post_field'] : 'post_content');
	$data['target'] = (!empty($data['target']) ? $data['target'] : '.message');
	$data['callback'] = (!empty($data['callback']) ? $data['callback'] : '');
	
	$post_pod = pods($data['post_type'], $data['post_no']);
	
	switch($data['action']) {
		case 'create':
			$postarr = array(
				'post_type' => $data['post_type'],
				'post_status' => 'publish',
			);
			if(!empty($data['post_fields'])) {
				foreach($data['post_fields'] as $i => $field) {
					$postarr[$i] = $field;
				}
			}
			$new = wp_insert_post($postarr);
			if($new > 0) {
				if(!empty($data['meta_fields'])) {
					foreach($data['meta_fields'] as $i => $field) {
						update_post_meta($new, $i, $field);
						$output['temp'][] = $new . ' ' . $i . ' ' . $field;
					}
				}
				$output['status'] = 'success';
				$output['message'] = 'Post successfully created!';
			}
			else {
				$output['status'] = 'error';
				$output['message'] = 'Error creating post';
			}
			break;
		case 'toggle_field': 
			$output['test'] = $data['meta_fields'];
			switch($data['field_type']) {
				case 'pods':
					if(!empty($data['meta_fields'])) {
						foreach($data['meta_fields'] as $i => $field) {
							$field_data = $post_pod->field($i);
							$field_data_ids = array();
							if(!empty($field_data)) {
								foreach($field_data as $datum) {
									$field_data_ids[] = $datum['ID'];
								}
							}
							
							$message_arr = json_decode(preg_replace("/(\')|(\&\#39\;)/", '"', $data['messages']), true);
							if(!empty($message_arr)) {
								$data['messages'] = $message_arr;
							}
							
							if(empty($field_data_ids) || !in_array($field, $field_data_ids)) {
								$field_data_ids[] = $field;
								$output['message'] = 'Post updated successfully!';
								if(!empty($data['messages']) && gettype($data['messages']) === 'array' && !empty($message_arr[1])) {
									$output['message'] = $message_arr[1];
								}
							}
							else {
								$key = array_search($field, $field_data_ids);
								unset($field_data_ids[$key]);
								$output['message'] = 'Post updated successfully!';
								if(!empty($data['messages']) && gettype($data['messages']) === 'array' && !empty($message_arr[0])) {
									$output['message'] = $message_arr[0];
								}
							}
							$post_pod->save($i, $field_data_ids);
							$post_pod->save($i . '-count', count($field_data_ids));
							$output['count'] = count($field_data_ids);
							$output['status'] = 'success';
						}
					}
					break;
			}
			break;
	}
	$output['target'] = $data['target'];
	$output['callback'] = $data['callback'];
	
	print(json_encode($output));
	die();
}