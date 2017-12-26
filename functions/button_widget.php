<?php
class Custom_Button extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'custom_button',
			'description' => 'A widget for adding buttons to sidebars',
		);
		parent::__construct( 'custom_button', 'Custom Button', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		  // PART 1: Extracting the arguments + getting the values
		extract($args, EXTR_SKIP);
		
		$content= empty($instance['content']) ? '' : $instance['content'];
		$link_url = empty($instance['link_url']) ? '' : $instance['link_url'];
		$target = empty($instance['target']) ? '' : $instance['target'];
		$is_download = empty($instance['is_download']) ? '' : $instance['is_download'];
		$element_id = empty($instance['element_id']) ? '' : $instance['element_id'];
		$class = empty($instance['class']) ? '' : $instance['class'];
		$class .= empty($instance['hover_anim']) ? '' : ' ' . 'hover-anim ' . $instance['hover_anim'];
		$class .= empty($instance['hover_anim']) || empty($instance['hover_color']) ? '' : ' ' . $instance['hover_color'];
		$style = empty($instance['style']) ? '' : $instance['style'];
		$data = empty($instance['data']) ? array() : $instance['data'];
		
		$data_arr = array(); //Initiazlie array of data attributes for button
		
		//Takes each data item provide and adds it to $data_arr as a string ready to add to the element
		foreach($data as $i => $datum) {
			$data_arr[] = 'data-' . $i . '="' . $datum . '"';
		}
		
		$before = (!empty($link_url) ? '<a href="' . $link_url . '"' . ($is_download === 'true' ? ' download' : "") . (!empty($target) ? ' target="' . trim($target) . '"' : '') . '>' : '<button>'); //opening wrapper.  <a> if link, <button> otherwise
		$after = (!empty($link_url) ? '</a>' : '</button>'); //Closing wrapper.  <a> if link, <button> otherwise

		// Before widget code, if any
		if(isset($before_widget)) {
			$before_widget = preg_replace("/\>/", ' style="' . $style . '" ' . implode(' ', $data_arr) . '>', $before_widget); //Insert styles into button
			
			//If the before widget element has an ID field, replace it with the element's ID
			if(preg_match("/id=\"/", $before_widget)) {
				$before_widget = preg_replace("/class=\"/", 'class="' . $class . ' ', $before_widget);
				echo preg_replace("/id=\"[^\"]*\"/", 'id="' . $element_id . '"', $before_widget);
			}
			
			//Otherwise, insert the element ID before the classes
			else {
				echo preg_replace("/class=\"/", 'id="' . $element_id . '" class="' . $class . ' ', $before_widget);
			}
		}
		

		// PART 2: The title and the text output
		if (isset($content)) {
			echo $before . 
					$content .
				$after;
		}

		  // After widget code, if any  
		echo (isset($after_widget)?$after_widget:'');
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		 // PART 1: Extract the data from the instance variable
		$instance = wp_parse_args( (array) $instance, array( 
				'content' => '', 
				'link_url' => '',
				'target' => '',
				'is_download' => '',
				'hover_anim' => '',
				'hover_color' => '', 
				'element_id' => '',
				'class' => '', 
				'style' => '',
				'data' => array(),
			));
		$content = $instance['content']; 
		$link_url = $instance['link_url'];
		$target = $instance['target'];
		$is_download = $instance['is_download'];
		$hover_anim = $instance['hover_anim'];
		$hover_color = $instance['hover_color'];
		$element_id = $instance['element_id'];
		$class = $instance['class'];
		$style = $instance['style'];
		$data = $instance['data'];

	   ?>
	   <!--Widget content field START -->
	   <p>
		<label for="<?php echo $this->get_field_id('content'); ?>">Button Content: 
		  <input class="widefat" id="<?php echo $this->get_field_id('content'); ?>" 
				 name="<?php echo $this->get_field_name('content'); ?>" type="text" 
				 value="<?php echo esc_attr($content); ?>" />
		</label>
		</p>
		<!-- Widget content field END -->
		
	   <!--Widget link_url field START -->
	   <p>
		<label for="<?php echo $this->get_field_id('link_url'); ?>">Button URL:
		  <input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" 
				 name="<?php echo $this->get_field_name('link_url'); ?>" type="text" 
				 value="<?php echo esc_attr($link_url); ?>" />
		</label>
		</p>
		<!-- Widget link_url field END -->

		<!-- Link target field START -->
	   <p>Open Link in New Window: <br />
		<label for="<?php echo $this->get_field_id('target'); ?>">Yes 
		  <input class="widefat" id="<?php echo $this->get_field_id('target'); ?>" 
				 name="<?php echo $this->get_field_name('target'); ?>" type="checkbox" 
				 value="_blank"<?php echo (esc_attr($target) === '_blank' ? ' checked' : ''); ?> />
		</label>
		</p>
		<!-- Link target field END -->

		<!--Widget is download field START -->
	   <p>Link is file download: <br />
		<label for="<?php echo $this->get_field_id('is_download'); ?>">Yes 
		  <input class="widefat" id="<?php echo $this->get_field_id('is_download'); ?>" 
				 name="<?php echo $this->get_field_name('is_download'); ?>" type="checkbox" 
				 value="yes"<?php echo (esc_attr($is_download) === 'yes' ? ' checked' : ''); ?> />
		</label>
		</p>
		<!-- Widget is download field END -->

		<!--Widget id field START -->
	   	<p>
		<label for="<?php echo $this->get_field_id('element_id'); ?>">ID (optional):
		  <input class="widefat" id="<?php echo $this->get_field_id('element_id'); ?>" 
				 name="<?php echo $this->get_field_name('element_id'); ?>" type="text" 
				 value="<?php echo esc_attr($element_id); ?>" />
		</label>
		</p>
		<!-- Widget id field END -->

		<!--Widget hover animation START -->
	   	<p>
		<label for="<?php echo $this->get_field_id('hover_anim'); ?>">Animation on Hover:
		  <select class="widefat" id="<?php echo $this->get_field_id('hover_anim'); ?>" 
				 name="<?php echo $this->get_field_name('hover_anim'); ?>"
				 value="<?php echo esc_attr($hover_anim); ?>">
				 <option value="">None</option>
				 <option value="hover-fill-up"<?php echo ($hover_anim === 'hover-fill-up' ? ' selected' : ''); ?>>Fill Up</option>
				 <option value="hover-partial-fill-down"<?php echo ($hover_anim === 'hover-partial-fill-down' ? ' selected' : ''); ?>>Partial Fill Down</option>
				 <option value="hover-fill-right"<?php echo ($hover_anim === 'hover-fill-right' ? ' selected' : ''); ?>>Fill Right</option>
		</select>
		</label>
		</p>
		<!-- Widget hover animation END -->

		<!--Widget hover color START -->
	   	<p>
		<label for="<?php echo $this->get_field_id('hover_color'); ?>">Hover Color:
		  <select class="widefat" id="<?php echo $this->get_field_id('hover_color'); ?>" 
				 name="<?php echo $this->get_field_name('hover_color'); ?>"
				 value="<?php echo esc_attr($hover_color); ?>">
				 <option value="hover-blue"<?php echo ($hover_color === 'hover-blue' ? ' selected' : ''); ?>>Blue</option>
				  <option value="hover-gray"<?php echo ($hover_color === 'hover-gray' ? ' selected' : ''); ?>>Gray</option>
				 <option value="hover-blue-inverse"<?php echo ($hover_color === 'hover-blue-inverse' ? ' selected' : ''); ?>>White w/ Blue Text</option>
		</select>
		</label>
		</p>
		<!-- Widget hover color END -->

		<!--Widget classes field START -->
	   	<p>
		<label for="<?php echo $this->get_field_id('class'); ?>">Extra Classes:
		  <input class="widefat" id="<?php echo $this->get_field_id('class'); ?>" 
				 name="<?php echo $this->get_field_name('class'); ?>" type="text" 
				 value="<?php echo esc_attr($class); ?>" />
		</label>
		</p>
		<!-- Widget classes field END -->

		<!--Widget styles field START -->
	   	<p>
		<label for="<?php echo $this->get_field_id('style'); ?>">Extra Styles:
		  <input class="widefat" id="<?php echo $this->get_field_id('style'); ?>" 
				 name="<?php echo $this->get_field_name('style'); ?>" type="text" 
				 value="<?php echo esc_attr($style); ?>" />
		</label>
		</p>
		<!-- Widget styles field END -->
	   <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['content'] = $new_instance['content'];
		$instance['link_url'] = $new_instance['link_url'];
		$instance['target'] = $new_instance['target'];
		$instance['is_download'] = $new_instance['is_download'];
		$instance['hover_anim'] = $new_instance['hover_anim'];
		$instance['hover_color'] = $new_instance['hover_color'];
		$instance['element_id'] = $new_instance['element_id'];
		$instance['class'] = $new_instance['class'];
		$instance['style'] = $new_instance['style'];
		$instance['data'] = $new_instance['data'];
		return $instance;
	}
}
add_action('widgets_init',
	create_function('', 'return register_widget("Custom_Button");')
);