<?php
//Because VC eliminated presets, and thus default presets, set defaults for existing widgets here instead
add_action('vc_after_init', 'set_vc_defaults');
function set_vc_defaults() {
    vc_update_shortcode_param( 'vc_row_inner', array(
		'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
		'value' => 'inner-row',
	));
	vc_update_shortcode_param( 'vc_column_inner', array(
		'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
		'value' => 'inner-column',
	));
	
	vc_update_shortcode_param('vc_custom_heading', array(
		'type' => 'checkbox',
        'heading' => 'Use theme default font family?',
        'param_name' => 'use_theme_fonts',
		'value' => array(
			'Yes' => 'yes',
		),
		'std' => 'yes',
	));
	
	vc_update_shortcode_param('vc_single_image', array(
		'type' => 'textfield',
        'heading' => 'Image Size',
        'param_name' => 'img_size',
		'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).',
		'value' => 'full',
	));
}

//--------Create custom widgets--------

add_action('vc_before_init', 'vc_single_item_slider_init');
add_action('vc_before_init', 'vc_multi_item_slider_init');
add_action('vc_before_init', 'vc_linkable_column');
add_action('vc_before_init', 'vc_rotary_menu_init');
add_action('vc_before_init', 'vc_table_init');
add_action('vc_before_init', 'vc_custom_button_init');
add_action('vc_before_init', 'vc_blockquote_init');
add_action('vc_before_init', 'vc_flex_gallery_init'); 
add_action('init', 'vc_custom_posts_widget_init', 35);
add_action('init', 'vc_custom_posts_accordion_widget_init', 35);

function vc_single_item_slider_init() {
  vc_map(array(
    'name' => 'Single Item Slider',
    'base' => 'vc_single_item_slider',
    'icon' => 'vc_single_item_slider_icon',
    'as_parent' => array(
      'only' => 'vc_single_item_slider_item',
      ),
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'admin_enqueue_css' => get_stylesheet_directory_uri() . '/assets/styles/custom-editor-style.css',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Element ID',
        'param_name' => 'elem_id',
        'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      array(
        'type' => 'css_editor',
        'heading' => 'CSS Options',
        'param_name' => 'css',
        'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  vc_map(array(
    'name' => 'Single Item Slider Item',
    'base' => 'vc_single_item_slider_item',
    'icon' => 'vc_single_item_slider_item_icon',
    'as_child' => array(
      'only' => 'vc_single_item_slider',
      ),
	'as_parent' => array(
		'except' => 'vc_single_item_slider, vc_table_row, vc_table_th, vc_table_td, single_item_slider_item, multi_item_slider, multi_item_slider_item',
	),
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Element ID',
        'param_name' => 'elem_id',
        'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      array(
        'type' => 'css_editor',
        'heading' => 'CSS Options',
        'param_name' => 'css',
        'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_Single_Item_Slider extends WPBakeryShortCodesContainer {

    }
    class WPBakeryShortCode_vc_Single_Item_Slider_Item extends WPBakeryShortCodesContainer {

    }
  }
}
function vc_multi_item_slider_init() {
	vc_map(array(
		'name' => 'Multi Item Slider',
		'base' => 'vc_multi_item_slider',
		'icon' => 'vc_multi_item_slider_icon',
		'as_parent' => array(
		  'only' => 'vc_multi_item_slider_item',
		  ),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'admin_enqueue_css' => get_stylesheet_directory_uri() . '/assets/styles/custom-editor-style.css',
		'params' => array(
			array(
				'type' => 'checkbox',
				'heading' => 'Included feature block for images?',
				'param_name' => 'show_featured',
				'group' => 'General',
				'value' => array(
					'Yes' => 'yes',
				),
				'std' => '',
			),
			array(
				'type' => 'checkbox',
				'heading' => 'Show slide title',
				'param_name' => 'show_title',
				'group' => 'General',
				'value' => array(
					'Yes' => 'yes',
				),
				'std' => '',
			),
			array(
				'type' => 'checkbox',
				'heading' => 'Show slide description',
				'param_name' => 'show_desc',
				'group' => 'General',
				'value' => array(
					'Yes' => 'yes',
				),
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Element ID',
				'param_name' => 'elem_id',
				'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
				'group' => 'General',
				),
			array(
				'type' => 'textfield',
				'heading' => 'Extra class name',
				'param_name' => 'el_class',
				'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
				'group' => 'General',
				),
			array(
				'type' => 'css_editor',
				'heading' => 'CSS Options',
				'param_name' => 'css',
				'group' => 'Design options',
				),
			),
		"js_view" => 'VcColumnView',
		)
	);
  vc_map(array(
    'name' => 'Multi Item Slider Item',
    'base' => 'vc_multi_item_slider_item',
    'icon' => 'vc_multi_item_slider_item_icon',
    'as_child' => array(
      'only' => 'vc_single_item_slider',
      ),
	'as_parent' => array(
		'except' => 'vc_single_item_slider, vc_table_row, vc_table_th, vc_table_td, single_item_slider_item, multi_item_slider, multi_item_slider_item',
	),
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => array(
		array(
			'type' => 'textfield',
			'heading' => 'Slide Title',
			'param_name' => 'slide_title',
        'group' => 'General',
        ),
		array(
			'type' => 'textfield',
			'heading' => 'Slide Description',
			'param_name' => 'slide_desc',
			'group' => 'General',
        ),
		array(
			'type' => 'textfield',
			'heading' => 'Element ID',
			'param_name' => 'elem_id',
			'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
			'group' => 'General',
        ),
		array(
			'type' => 'textfield',
			'heading' => 'Extra class name',
			'param_name' => 'el_class',
			'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
			'group' => 'General',
        ),
		array(
			'type' => 'css_editor',
			'heading' => 'CSS Options',
			'param_name' => 'css',
			'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_Multi_Item_Slider extends WPBakeryShortCodesContainer {

    }
    class WPBakeryShortCode_vc_Multi_Item_Slider_Item extends WPBakeryShortCodesContainer {

    }
  }
}
function vc_linkable_column() {
  vc_map(array(
    'name' => 'Linkable Column',
    'base' => 'vc_linkable_column',
    'icon' => 'vc_linkable_column_icon',
    'as_parent' => array('except' => ''),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => array(
      array(
        "type" => "vc_link",
        'admin_label' => true,
        "class" => "",
        "heading" => 'URL (Link)',
        "param_name" => "link",
        "value" => '',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Element ID',
        'param_name' => 'elem_id',
        'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      array(
        'type' => 'css_editor',
        'heading' => 'CSS Options',
        'param_name' => 'css',
        'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_Linkable_Column extends WPBakeryShortCodesContainer {

    }
  }
}
function vc_rotary_menu_init() {
  vc_map(array(
    'name' => 'Rotary Menu',
    'base' => 'vc_rotary_menu',
    'icon' => 'vc_rotary_menu_icon',
    'as_parent' => array(
      'only' => 'vc_rotary_menu_item',
      ),
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'admin_enqueue_css' => get_stylesheet_directory_uri() . '/assets/styles/custom-editor-style.css',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Menu Title',
        'param_name' => 'title',
        'group' => 'General',
        ),
      array(
        'type' => 'colorpicker',
        'heading' => 'Title Color',
        'param_name' => 'title_color',
        'group' => 'General',
        ),
      array(
        'type' => 'colorpicker',
        'heading' => 'Rotary Hub BG',
        'param_name' => 'rotary_bg',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Element ID',
        'param_name' => 'elem_id',
        'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      array(
        'type' => 'css_editor',
        'heading' => 'CSS Options',
        'param_name' => 'css',
        'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  vc_map(array(
    'name' => 'Rotary Menu Item',
    'base' => 'vc_rotary_menu_item',
    "as_child" => array('only' => 'vc_rotary_menu_slider'),
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Element ID',
        'param_name' => 'elem_id',
        'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
        'group' => 'General',
        ),
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      array(
        'type' => 'css_editor',
        'heading' => 'CSS Options',
        'param_name' => 'css',
        'group' => 'Design options',
        ),
      ),
    "js_view" => 'VcColumnView',
    ));
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_Rotary_Menu extends WPBakeryShortCodesContainer {

    }
    class WPBakeryShortCode_vc_Rotary_Menu_Item extends WPBakeryShortCodesContainer {

    }
  }
}
function vc_table_init() {
	vc_map(array(
		'name' => 'Table',
		'base' => 'vc_table',
		'icon' => 'vc_table_icon',
		'as_parent' => array(
		  'only' => 'vc_table_row',
		  ),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'admin_enqueue_css' => get_stylesheet_directory_uri() . '/assets/styles/custom-editor-style.css',
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => 'Border Collapse',
				'param_name' => 'border_collapse',
				'group' => 'General',
				'value' => array(
					'Seperate' => 'separate',
					'Collapse' => 'collapse',
					'Inherit' => 'inherit',
				),
			),
		  array(
			'type' => 'textfield',
			'heading' => 'Element ID',
			'param_name' => 'elem_id',
			'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
			'group' => 'General',
			),
		  array(
			'type' => 'textfield',
			'heading' => 'Extra class name',
			'param_name' => 'el_class',
			'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
			'group' => 'General',
			),
		  array(
			'type' => 'css_editor',
			'heading' => 'CSS Options',
			'param_name' => 'css',
			'group' => 'Design options',
			),
		  ),
		"js_view" => 'VcColumnView',
    ));
	vc_map(array(
		'name' => 'Table Row',
		'base' => 'vc_table_row',
		'icon' => 'vc_table_row_icon',
		"as_child" => array('only' => 'vc_table'),
		'as_parent' => array(
		  'only' => 'vc_table_td, vc_table_th',
		),
		  'content_element' => true,
		  'show_settings_on_create' => false,
		  'is_container' => true, 
		  'params' => array(
			array(
				'type' => 'textfield',
				'heading' => 'Element ID',
				'param_name' => 'elem_id',
				'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
				'group' => 'General',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Extra class name',
				'param_name' => 'el_class',
				'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
				'group' => 'General',
			),
		  array(
			'type' => 'css_editor',
			'heading' => 'CSS Options',
			'param_name' => 'css',
			'group' => 'Design options',
			),
		  ),
		"js_view" => 'VcColumnView',
    ));
	vc_map(array(
		'name' => 'Table Heading Cell',
		'base' => 'vc_table_th',
		'icon' => 'vc_table_th_icon',
		"as_child" => array('only' => 'vc_table_row'),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'params' => array(
		  array(
			'type' => 'textfield',
			'heading' => 'Element ID',
			'param_name' => 'elem_id',
			'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
			'group' => 'General',
			),
		  array(
			'type' => 'textfield',
			'heading' => 'Extra class name',
			'param_name' => 'el_class',
			'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
			'group' => 'General',
			),
		  array(
			'type' => 'css_editor',
			'heading' => 'CSS Options',
			'param_name' => 'css',
			'group' => 'Design options',
			),
		  ),
		"js_view" => 'VcColumnView',
    ));
	vc_map(array(
		'name' => 'Table Cell',
		'base' => 'vc_table_td',
		'icon' => 'vc_table_td_icon',
		"as_child" => array('only' => 'vc_table_row'),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'params' => array(
		  array(
			'type' => 'textfield',
			'heading' => 'Element ID',
			'param_name' => 'elem_id',
			'description' => 'Enter element ID (Note: make sure it is unique and valid according to w3c specification).',
			'group' => 'General',
			),
		  array(
			'type' => 'textfield',
			'heading' => 'Extra class name',
			'param_name' => 'el_class',
			'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
			'group' => 'General',
			),
		  array(
			'type' => 'css_editor',
			'heading' => 'CSS Options',
			'param_name' => 'css',
			'group' => 'Design options',
			),
		  ),
		"js_view" => 'VcColumnView',
    ));
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_Table extends WPBakeryShortCodesContainer {

    }
	 class WPBakeryShortCode_vc_Table_Row extends WPBakeryShortCodesContainer {

    }
    class WPBakeryShortCode_vc_Table_Td extends WPBakeryShortCodesContainer {

    }
	class WPBakeryShortCode_vc_Table_Th extends WPBakeryShortCodesContainer {

    }  
  }
}
function vc_custom_posts_widget_init() {
  if(!function_exists('vc_map')) {
    return;
  }
  vc_map( array(
    'name' => 'Joints Post Widget',
    'base' => 'vc_custom_posts_widget',
    'params' => array(
      array(
        'type' => 'posttypes',
        'holder' => 'div',
        'heading' => 'Post Type(s)',
        'param_name' => 'post_types',
        'group' => 'General',
        ),
      array(
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Show Only Specific Categories',
        'description' => 'Shows all if none selected',
        'param_name' => 'post_cats',
        'group' => 'General',
        'value' => get_tax_list(),
        'dependency' => array(
          'element' => 'post_types',
          'value' => post_type_has_tax(),
          ),
        ),
      array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => 'Number of Posts',
        'description' => 'Enter -1 to show all posts',
        'param_name' => 'post_count',
        'group' => 'General',
        'value' => 3,
        ),
      array(
        'type' => 'dropdown',
        'holder' => 'div',
        'heading' => 'Posts per Row',
        'param_name' => 'row_size',
        'group' => 'General',
        'value' => array(
          'One' => '1',
          'Two' => '2',
          'Three' => '3',
          'Four' => '4',
          ),
        'std' => 'Three',
        ),
      array(
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Show Post Breadcrumbs',
        'param_name' => 'show_breadcrumbs',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
        ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => 'Show Featured Image',
        "param_name" => "show_featured_image",
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
        ),
      array(
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Show Author',
        'param_name' => 'show_author',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
        ),
      array(
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Show Author Avatar',
        'param_name' => 'show_author_img',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
        'dependency' => array(
          'element' => 'show_author',
          'not_empty' => true,
          ),
        ),
      array(
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Show Date',
        'param_name' => 'show_date',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
        ),
      ),
    )
  );
}

function vc_custom_button_init() {
  if(!function_exists('vc_map')) {
    return;
  }
  vc_map( array(
      "name" => 'Joints Custom Button',
      "base" => "vc_inline_custom_button",
      "params" => array(
          array(
              "type" => "dropdown",
              'admin_label' => true,
              "class" => "",
              "heading" => 'Button Content Type',
              "param_name" => "content_type",
              'group' => 'General',
              'value' => array(
                'Text' => 'text',
                'Image' => 'img',
              ),
              'std' => 'Text',
           ),
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => 'Button Text',
              'admin_label' => true,
              "param_name" => "title",
              "value" => '',
              'group' => 'General',
              'dependency' => array(
                'element' => 'content_type',
                'value' => array(
                  'text',
                  ),
                ),
           ),
          array(
            'type' => 'attach_images',
            'heading' => 'Button Image',
            'admin_label' => true,
            'description' => 'Choose up to two images.  The second will be used as a hover state.',
            'param_name' => 'img',
            'value' => '',
            'group' => 'General',
            'dependency' => array(
              'element' => 'content_type',
              'value' => array(
                'img'
                ),
              ),
            ),
          /**
          array(
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => 'Button Size',
              "param_name" => "button_size",
              'group' => 'General',
              'value' => array(
                'Normal' => '',
                'Big' => 'big',
              ),
              'std' => 'Normal',
           ),*/
          array(
              "type" => "vc_link",
              'admin_label' => true,
              "class" => "",
              "heading" => 'URL (Link)',
              "param_name" => "link",
              "value" => '',
              'group' => 'General',
           ),
          array(
            'type' => 'checkbox',
            'heading' => 'Link is file download',
            'param_name' => 'is_download',
            'group' => 'General',
            'value' => array(
              'Yes' => 'yes',
              ),
            'std' => '',
            ),
          array(
            'type' => 'dropdown',
            'heading' => 'Animation on Hover',
            'param_name' => 'hover_anim',
            'class' => '',          
            'group' => 'General',
            'value' => array(
              'None' => '',
              'Fill Up' => 'hover-fill-up',
				'Fill Right' => 'hover-fill-right',
				'Fill Right Gradient' => 'hover-fill-right gradient',
              'Partial Fill Down' => 'hover-partial-fill-down',
              'Underline Slide Out Left 50%' => 'hover-underline-slide-left-half',
              ),
            ),
          array(
            'type' => 'dropdown',
            'heading' => 'Hover Color',
            'param_name' => 'hover_color',
            'group' => 'General',
            'value' => array(
              'Blue' => 'hover-blue',
              'Gray' => 'hover-gray',
              'White w/ Blue Text' => 'hover-blue-inverse',
              'White' => 'hover-white',
              'Custom Colors' => 'custom',
              ),
            'std' => '',
            'dependency' => array(
              'element' => 'hover_anim',
              'not_empty' => true,
              ),
            ),
          array(
              'type' => 'colorpicker',
              'heading' => 'Text Color (on hover)',
              'param_name' => 'hover_text_color',
              'group' => 'General',
              'dependency' => array(
                'element' => 'hover_color',
                'value' => 'custom',
                ),
             ),
          array(
              'type' => 'colorpicker',
              'heading' => 'Background Color (on hover)',
              'param_name' => 'hover_bg_color',
              'group' => 'General',
              'dependency' => array(
                'element' => 'hover_color',
                'value' => 'custom',
                ),
             ),
          array(
              'type' => 'colorpicker',
              'heading' => 'Border Color (on hover)',
              'param_name' => 'hover_border_color',
              'group' => 'General',
              'dependency' => array(
                'element' => 'hover_color',
                'value' => 'custom',
                ),
             ),
          array(
              'type' => 'colorpicker',
              'heading' => 'Text Color',
              'param_name' => 'color',
              'group' => 'General',
           ),
          array(
            'type' => 'dropdown',
            'heading' => 'Display',
            'param_name' => 'button_display',
            'group' => 'General',
            'value' => array(
              'Inline-block' => 'inline-block',
              'Block' => 'block',
              ),
            'std' => '',
            ),
          /**
          array(
            'type' => 'dropdown',
            'holder' => 'div',
            'heading' => 'Button Wrapper Padding',
            'param_name' => 'wrapper_padding',
            'group' => 'General',
            'value' => array(
              'Theme Default' => 'default',
              'No Padding' => 'none',
              ),
            'std' => 'Theme Default',
            ),
          */
		  array(
              'type' => 'textfield',
              'heading' => 'Modal Slug',
              'param_name' => 'button_modal',
              'group' => 'General',
          ),
          array(
              'type' => 'textfield',
              'heading' => 'Element ID',
              'param_name' => 'elem_id',
              'group' => 'General',
          ),
          array(
              'type' => 'textfield',
              'heading' => 'Extra class name',
              'param_name' => 'el_class',
              'group' => 'General',
          ),
          array(
              'type' => 'css_editor',
              'heading' => 'CSS Options',
              'param_name' => 'css',
              'group' => 'Design options',
          ),
      ),
   ) );
}
function vc_blockquote_init() {
	if(!function_exists('vc_map')) {
    return;
  }
	vc_map(array(
		'name' => 'Joints Blockquote',
		'base' => 'vc_blockquote',
		'icon' => 'vc_blockquote_icon',
		'params' => array(
			array(
				'type' => 'textarea',
				'heading' => 'Content',
				'param_name' => 'block_content',
				'holder' => 'p',
				'group' => 'General',
				'value' => 'This is a blockquote element.',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Element ID',
				'param_name' => 'elem_id',
				'group' => 'General',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Extra class name',
				'param_name' => 'el_class',
				'group' => 'General',
			),
			array(
				'type' => 'css_editor',
				'heading' => 'CSS Options',
				'param_name' => 'css',
				'group' => 'Design options',
			),
		),
	));
}
function vc_flex_gallery_init() {
	if(!function_exists('vc_map')) {
    return;
  }
	vc_map(array(
		'name' => 'Joints Flex Gallery',
		'base' => 'vc_flex_gallery',
		'icon' => 'vc_flex_gallery_icon',
		'params' => array(
			array(
				'type' => 'attach_images',
				'heading' => 'Images',
				'admin_label' => true,
				'description' => 'Choose up to two images.  The second will be used as a hover state.',
				'param_name' => 'img',
				'value' => '',
				'group' => 'General',
            ),
			array(
				'type' => 'dropdown',
				'heading' => 'Number of Columns',
				'param_name' => 'num_cols',
				'group' => 'General',
				'value' => array(
					'One' => 1,
					'Two' => 2,
					'Three' => 3,
					'Four' => 4,
				),
			),
			array(
				'type' => 'textfield',
				'heading' => 'Element ID',
				'param_name' => 'elem_id',
				'group' => 'General',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Extra class name',
				'param_name' => 'el_class',
				'group' => 'General',
			),
			array(
				'type' => 'css_editor',
				'heading' => 'CSS Options',
				'param_name' => 'css',
				'group' => 'Design options',
			),
		),
	));
}
function vc_custom_posts_accordion_widget_init() {
  if(!function_exists('vc_map')) {
    return;
  }
  vc_map(array(
    'name' => 'Joints Posts Accordion Widget',
    'base' => 'vc_custom_posts_accordion',
    'params' => array(
      array(
        'type' => 'posttypes',
        'holder' => 'div',
        'heading' => 'Post Type(s)',
        'param_name' => 'post_types',
        'group' => 'General',
        ),
      array(
        'type' => 'dropdown',
        'holder' => 'div',
        'heading' => 'Sort by Category',
        'param_name' => 'category_sort',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          'No' => 'no',
          ),
        'std' => 'Yes',
        ),
      array(
        'type' => 'dropdown',
        'holder' => 'div',
        'heading' => 'Sort by:',
        'param_name' => 'choose_category_sort',
        'group' => 'General',
        'value' => get_taxonomies(),
        'dependency' => array(
          'element' => 'category_sort',
          'value' => array(
            'yes',
            ),
          ),
        ),
      array(
              'type' => 'css_editor',
              'heading' => 'CSS Options',
              'param_name' => 'css',
              'group' => 'Design options',
            ),
      ),
    ));
}

function post_type_has_tax($tax = 'category') {
  $post_type_args = array(
    'exclude_from_search' => false,
    );
  $post_types = get_post_types($post_type_args);
  $has_tax = array();
  foreach($post_types as $type) {
    $args = array(
      'post_type' => $type,
      'posts_per_page' => 1,
      );
    $query1 = new WP_Query($args);
    if(!empty($query1->posts[0]) && is_object_in_term($query1->posts[0]->ID, $tax)) {
      $has_tax[] = $type;
    }
  }
  return $has_tax;
}

function get_tax_list($tax = 'category') {
  $terms_list = array();
  foreach(get_terms(array(
    'taxonomy' => $tax,
    )) as $term) {
    $terms_list[$term->name] = $term->slug;
  }
  return $terms_list;
}

//--------Functionality for custom VC widgets-------

add_shortcode('vc_custom_posts_widget', 'joints_vc_custom_posts_widget');
add_shortcode('vc_inline_custom_button', 'joints_custom_vc_button');
add_shortcode('vc_blockquote', 'joints_blockquote');
add_shortcode('vc_flex_gallery', 'joints_flex_gallery');
add_shortcode('vc_custom_posts_accordion', 'joints_custom_posts_accordion');

function joints_vc_custom_posts_widget($atts) {
  $post_types = explode(',', $atts['post_types']);
  $output = '';
  $row_size = intval((!empty($atts['row_size']) ? $atts['row_size'] : 3));
  $col_width = 12 / $row_size;
  $post_count = (!empty($atts['post_count']) ? $atts['post_count'] : 3); 
	
  $args = array(
      'post_type' => $post_types,
      'posts_per_page' => $post_count,
      'post_status' => 'publish',
    );
  if(!empty($atts['post_cats'])) {
      $tax_arr = array(
        'relation' => 'AND',
        );
	  
      $tax_types = (!empty($atts['tax_type']) ? explode(',', $atts['tax_type']) : array('category'));
      $cats = explode(',', $atts['post_cats']);
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
      }
      $args['tax_query'] = $tax_arr;
  }
  if(!empty($atts['paged'])) {
    $args['paged'] = $atts['paged'];
  }

  $query1 = new WP_Query($args);
  $output .= '<div class="vc_col-sm-12 vc_column_container post-widget">
            <div class="vc_col-sm-12 vc_column_container post-widget-inner ' . implode('-wrap ', $post_types) . '-wrap">';
            $j = 1;
            global $i;
            $i = (empty($i) ? 1 : $i);
            if($query1->have_posts()) {
                while($query1->have_posts()) {

                  $cat = get_the_category($query1->post->ID);

                  $posts_meta = array();
					
                  //Get the author profile picture if option set to yes
                  $author_pic = get_the_author_meta('profile_picture');
                  $posts_meta[] = (!empty($atts['show_author_img']) ? '<span class="post-author-img">' . 
                          wp_get_attachment_image($author_pic['ID'], 'thumbnail') . 
                        '</span>' : '');
					
                   //Get the author profile picture if option set to yes
                  $posts_meta[] = (!empty($atts['show_author']) ? '<span class="post-author">
                        By: <a href="' . get_author_posts_url( get_the_author_meta( 'ID' )) . '">' . 
                          get_the_author() . 
                        '</a>
                      </span>' : '');
					
                   //Get the post date if option set to yes
                  $posts_meta[] = (!empty($atts['show_date']) ? '<span class="post-date">' . 
                        get_the_date('m.d.y') . '</span>' : '');

                  //If new row, open row
                  if($j === 1) {
                    $output .= '<div class="posts-row">';
                  }
                  $query1->the_post();
                  $output .= '<div class="vc_col-sm-' . $col_width . ' vc_column_container single single-' . $query1->post->post_type . '"' . (!empty($atts['show_featured_image']) && $query1->post->post_type === 'post' ? 'style="background-image: url(\'' . get_the_post_thumbnail_url($query1->post->ID, 'full') . '\');"' : "")  . '>' . 

                      //Display featured image if option set to yes
                      (!empty($atts['show_featured_image']) && $query1->post->post_type != 'post' ? '<div class="post-featured">' . get_the_post_thumbnail($query1->post->ID, 'full') . '</div>' : "") .
                      
                      //Display breadcrumbs if option set to yes
                      (!empty($atts['show_breadcrumbs']) ? '<div class="post-breadcrumbs">
                          <a href="' . get_post_type_archive_link(get_post_type()) . '">' . preg_replace("/_/", ' ', preg_replace("/post/", 'Blog', get_post_type())) . '</a>' .
                          (!empty($cat) ? ' \\ <a href="' . get_category_link($cat[0]->term_id) . '">' . $cat[0]->name . '</a>' : "") . 
                        '</div>' : '') . 

                      '<h3 class="single-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>' . 

                      (!empty($posts_meta) && !empty($posts_meta[0]) ? '<div class="post-meta">' . implode('&nbsp;&nbsp;&nbsp;', $posts_meta) . '</div>' : '') .
                      '<div class="post-content">' . get_the_excerpt() . '</div>
                    </div>';
                    $i++;
                    $j++;

                    //If end of row, close row
                    if($j > $row_size) {
                      $j = 1;
                      $output .= '</div>';
                    }
                }
              }
        if($j != 1) {
          $output .= '</div>';
        }
        if(empty($atts['no_filter'])) {
            $output .= '<div class="posts-data" data-i="' . $i . '" data-type="document" data-count="' . $post_count . '"' . (!empty($atts['tax_type']) ? ' data-tax-type="' . $atts['tax_type'] . '"' : "") . ' style="display: none;"></div>';
          $args2 = $args;
          $args2['paged'] = 2;
          $query2 = new WP_QUERY($args2);
          if(($i - 1) === intval($post_count) && count($query2->posts) > 0 && !empty($atts['use_pagination'])) {
            $button_atts = array(
              'content' => 'LOAD MORE',
              'class' => 'hover-anim hover-fill-up hover-blue',
              'style' => 'background-color: transparent',
              'element_id' => 'load-more'
            );
            $output .= '<div class="load-more-wrap">' . 
              get_custom_button($button_atts) . 
            '</div>';
          }
        }
        $output .= '</div>';
        wp_reset_postdata();   
  return $output . '</div>';
}

function joints_custom_vc_button($atts) {
    
    $class = (isset($atts['el_class']) ? $atts['el_class'] : "");
    
  //Get the visual composer styles
  $css = (isset($atts['css']) ? $atts['css'] : "");
  $css_class = (!empty($css) ? apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'inline_custom_button', $atts ) : "");

  $target = (isset($atts['link']) ? vc_build_link($atts['link']) : "");

  //Pass along link attributes to button widget if set
  $button_atts['link_url'] = (isset($target['url']) ? $target['url'] : "");
  $button_atts['target'] = (isset($target['target']) ? $target['target'] : "");

  //Tell button widget if target is a download
  $button_atts['is_download'] = (isset($atts['is_download']) && $atts['is_download'] === 'yes' ? 'true': false);

  $button_atts['class'] = '';
  $classes_arr = array(//(isset($atts['button_size']) ? $atts['button_size'] . ' ' : "") ,
                            //$atts['content_type'] . ' ' ,
                            $class,
                            $css_class,
                            (!empty($atts['button_display']) ? ' full-width': ""));

  //Format button content
  switch($atts['content_type']) {
    case 'text': 
      $button_atts['content'] = (isset($atts['title']) ? $atts['title'] : "");
      break;
    case 'img': 
      if(isset($atts['img'])) {
        $imgArr = explode(',', $atts['img']);
        $button_atts['content'] = wp_get_attachment_image($imgArr[0], 'full');

        //If a second image (for hover state) is set
        if(!empty($imgArr[1])) {
          $button_atts['content'] .= wp_get_attachment_image($imgArr[1], 'full');

          $classes_arr[] = 'has-hover';
        }
      }
      else {
        $button_atts['content'] = '';
      }
      break;
  }

  $button_atts['element_id'] = (isset($atts['elem_id']) ? $atts['elem_id'] : "");

  $button_atts['hover_anim'] = (isset($atts['hover_anim']) ? $atts['hover_anim'] : "");

  //Pass along the hover animation color to button widget if set
  if(isset($atts['hover_color']) && !empty($button_atts['hover_anim'])) {
      
    if($atts['hover_color'] === 'custom') {
        
        //get custom styles variable to be loaded in the site footer
      global $vc_custom_styles;
        
      $vc_custom_styles = (!empty($vc_custom_styles) ? $vc_custom_styles : "");
        
        //create unique class for style
      $style_id = 'vc-' . preg_replace("/\./", '', uniqid('', true));
        
        //check if class already exists
        //if so, create a new one until the result is unique
      while(strpos($vc_custom_styles, $style_id) !== false) {
        $style_id = 'vc-' . preg_replace("/\./", '', uniqid('', true));
      }

      $classes_arr[] = $style_id;
        
	$button_atts['content'] .= $button_atts['hover_anim'];
      switch($button_atts['hover_anim']) {

        case 'hover-fill-right':
		case 'hover-fill-right gradient':
        case 'hover-fill-up':
          $vc_custom_styles .= '.' . $style_id . ':hover {' . 
            (isset($atts['hover_text_color']) ? 'color: ' . $atts['hover_text_color'] . ' !important;' : '') .
            (isset($atts['hover_border_color']) ? 'border-color: ' . $atts['hover_border_color'] . ' !important;' : '') .
            (isset($atts['hover_bg_color']) ? 'background-color: ' . $atts['hover_bg_color'] . ' !important;' : '') .
          '}' . PHP_EOL;
          break;

        case 'hover-partial-fill-down':
          $vc_custom_styles .= (isset($atts['hover_border_color']) ? '.' . $style_id . ':hover.hover-partial-fill-down:before {
            border-width: 1px;
            border-style: solid;
            border-color: ' . $atts['hover_border_color'] . ';
          }' . PHP_EOL : '');
          break;

        case 'hover-underline-slide-left-half':
          $vc_custom_styles .= (isset($atts['hover_bg_color']) ? '.' . $style_id . ':hover.hover-underline-slide-left-half a:before, 
          .' . $style_id . ':hover.hover-underline-slide-left-half button:before  {
            background-color: ' . $atts['hover_bg_color'] . ' !important;
          }' . PHP_EOL : '');
          break;
      }
        
        //styles shared across animation types
		if(isset($atts['hover_bg_color'])) {
			if(preg_match("/gradient/", $button_atts['hover_anim'])) {
				$direction = '';
				switch($button_atts['hover_anim']) {
					case 'hover-fill-right gradient':
						$direction = 'right';
						break;
				}
				$vc_custom_styles .= '.' . $style_id . ':hover:before {
					background: linear-gradient(to ' . $direction . ', ' . $atts['hover_bg_color'] . ' 0, ' . $atts['hover_bg_color'] . ' 30%, rgba(0, 0, 0, 0) 60%) !important;
				}' . PHP_EOL;
			}	
			else {
				$vc_custom_styles .= '.' . $style_id . ':hover:before {
					background-color: ' . $atts['hover_bg_color'] . ' !important;
				}' . PHP_EOL;
			}
	  	}
    }
      
    //if using pre-set hover colors
    else {
      $button_atts['hover_color'] = $atts['hover_color'];
    }
  }
	
	$button_atts['data'] = array();

	if(!empty($atts['button_modal'])) {
		$button_atts['data']['modal'] = $atts['button_modal'];
	}
	
  	$button_atts['class'] = implode(' ', $classes_arr);
  	$button_atts['style'] = '';
  	$button_atts['style'] = (!empty($atts['color']) ? 'color: ' . $atts['color'] . ';' : "") . (!empty($atts['button_display']) ? ' display: ' . $atts['button_display'] . ';' : "");
	return '<div class="wpb_custom_button" style="' . (!empty($atts['button_display']) ? 'display: ' . $atts['button_display'] . ';' : "") . '">' . get_custom_button($button_atts) . '</div>';
}
function joints_blockquote($atts) {
	$classes = array('vc_blockquote');
	if(!empty($atts['el_class'])) {
		$classes[] = $atts['el_class'];
	}
	$output = '<blockquote ' . (!empty($atts['elem_id']) ? 'id="' . $atts['elem_id'] . '" ' : "") . 'class="' . implode(' ', $classes) . '">' .
		nl2br($atts['block_content']) . 
	'</blockquote>';
	return $output;
}
function joints_flex_gallery($atts) {
	$output = '<div class="flex-gallery">';
	$col_width = 12 / $atts['num_cols'];
	$i = 0;
	$cols = array();
	if(!empty($atts['img'])) {
		$imgs = explode(',', $atts['img']);
		foreach($imgs as $img) {
			$cols[$i][] = '<div class="flex-gallery-image-wrap">
				<div class="flex-gallery-image" style="background-image: url(' . wp_get_attachment_url($img) . ')"></div>
			</div>';
			$i++;
			if($i >= $atts['num_cols']) {
				$i = 0;
			}
		}
		foreach($cols as $col) {
			$output .= '<div class="vc_column_container vc_col-sm-' . $col_width . '">' . implode('', $col) . '</div>';
		}
	}
	
	return $output . '</div>';
}
function joints_custom_posts_accordion($atts) {
  $output = '<div class="post-accordions-wrap">';
  $accordion = '';
  $buttons = '';
  $post_types = (isset($atts['post_types']) ? explode(',', $atts['post_types']) : array());
  $fields = array();
  foreach($post_types as $post_type) {
    $pod = pods($post_type);
    if(!empty($pod)) {
      foreach($pod->fields() as $field) {
        $fields[$post_type][$field['label']] = $field['name'];
      }
    } 
  }
  if(isset($atts['category_sort']) && $atts['category_sort'] === 'yes') {
    $buttons .= '<div class="posts-accordion-buttons-wrap">';
    $cat = $atts['choose_category_sort'];
    $terms = get_terms(array(
      'taxonomy' => $cat,
      'hide_empty' => 'false',
      ));
    $i = 1;
    $j = 1;
    foreach($terms as $term) {
      $buttons .= get_custom_button(array(
        'content' => $term->name,
        'element_id' => 'post-accordion-' . $i . '-button',
        'classes' => 'text accordion-button hover-color-green',
        ));
      $args = array(
        'post_type' => $post_types,
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => $cat,
            'field' => 'term_id',
            'terms' => $term->term_id,
            ),
          ),
        );
      $query1 = new WP_Query($args);
      $accordion .= '[vc_tta_accordion active_section="0" collapsible_all="true" el_id="post-accordion-' . $i . '" el_class="post-accordion"' . (isset($atts['css']) ? ' css="' . $atts['css'] . '"' : "") . ']';
      if($query1->have_posts()) {
        while($query1->have_posts()) {
          $query1->the_post();
          $accordion .= '[vc_tta_section title="' . get_the_title() . '" tab_id="post-accordion-' . $j . '-section"]
            [vc_column_text]
              <p>';
          if(!empty($fields[get_post_type()])) {
            foreach($fields[get_post_type()] as $name => $field) {
              $accordion .= '<strong>' . $name . '</strong><br />' . 
                      get_post_meta($query1->post->ID, $field, true) . '<br />';
            }
          }
          $accordion .= '<strong>Description</strong><br />' . 
                strip_tags(get_the_content()) . 
              '</p>
            [/vc_column_text]
          [/vc_tta_section]';
          $j++;
        }
        wp_reset_postdata();
      }
      $accordion .= '[/vc_tta_accordion]';
      $i++;
    }
  }
  else {
    $i = 1;
    $args = array(
      'post_type' => $post_types,
      'posts_per_page' => -1,
      'post_status' => 'publish',
      );
    $query1 = new WP_Query($args);
    $accordion .= '[vc_tta_accordion active_section="0" collapsible_all="true"]';
    if($query1->have_posts()) {
      while($query1->have_posts()) {
        $query1->the_post();
        $accordion .= '[vc_tta_section title="' . get_the_title() . '" tab_id="post-accordion-' . $i . '-section"]
          [vc_column_text]
            <p>';
              if(!empty($fields[get_post_type()])) {
                foreach($fields[get_post_type()] as $name => $field) {
                  $accordion .= '<strong>' . $name . '</strong><br />' . 
                          get_post_meta($query1->post->ID, $field, true) . '<br />';
                }
              }
              $accordion .= '<strong>Description</strong><br />' . 
              strip_tags(get_the_content()) . 
            '</p>[/vc_column_text]
        [/vc_tta_section]';
        $i++;
      }
      wp_reset_postdata();
    }
    $accordion .= '[/vc_tta_accordion]';
  }
  $output = $buttons . '</div>' . $output . do_shortcode($accordion) . '</div>';
  return $output;
}


//-------Extend Posts Grid-------

add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_shortcodes' );
function my_module_add_grid_shortcodes( $shortcodes ) {
   
  $shortcodes['vc_custom_author_pic'] = array(
    'name' => __( 'Author Avatar', 'my-text-domain' ),
    'base' => 'vc_custom_author_pic',
    'category' => __( 'Content', 'my-text-domain' ),
    'description' => __( 'Show custom post meta', 'my-text-domain' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
   );
  $shortcodes['vc_custom_breadcrumbs'] = array(
    'name' => __( 'Breadcrumbs', 'my-text-domain' ),
    'base' => 'vc_custom_breadcrumbs',
    'category' => __( 'Content', 'my-text-domain' ),
    'description' => __( 'Show custom post meta', 'my-text-domain' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
   );
  return $shortcodes;
}
 

// output function
add_shortcode( 'vc_custom_breadcrumbs', 'vc_custom_breadcrumbs_render' );
add_shortcode( 'vc_custom_author_pic', 'vc_custom_author_pic_render' );

function vc_custom_breadcrumbs_render($atts, $content, $tag) {
  return '{{zebreadcrumbs}}';
}
function vc_custom_author_pic_render($atts, $content, $tag) {
  return '{{author_pic}}';
}
  
add_filter( 'vc_gitem_template_attribute_post_attr', 'vc_gitem_template_attribute_post_attr', 10, 2 );
add_filter( 'vc_gitem_template_attribute_custom_meta', 'vc_gitem_template_attribute_custom_meta', 10, 2 );
add_filter( 'vc_gitem_template_attribute_zebreadcrumbs', 'vc_gitem_template_attribute_zebreadcrumbs', 10, 2 );
add_filter( 'vc_gitem_template_attribute_author_pic', 'vc_gitem_template_attribute_author_pic', 10, 2 );

function vc_gitem_template_attribute_post_attr( $value, $data ) {
  

   /**
    * @var Wp_Post $post
    * @var string $data
    */
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );

  //return json_encode(get_post_meta( $post->ID, 'test' ));
   return $post->{$data};
}
function vc_gitem_template_attribute_custom_meta( $value, $data ) {
  

   /**
    * @var Wp_Post $post
    * @var string $data
    */
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );

  //return json_encode(get_post_meta( $post->ID, 'test' ));
   return get_post_meta( $post->ID, $data, true );
}
function vc_gitem_template_attribute_zebreadcrumbs( $value, $data ) {
  //return 'test';
  /**
    * @var Wp_Post $post
    * @var string $data
    */
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );
  $cat = get_the_category($post->ID);
  print_r($cat);
  return '<div class="post-breadcrumbs">
                          <a href="' . get_post_type_archive_link(get_post_type($post->ID)) . '">' . preg_replace("/_/", ' ', preg_replace("/post/", 'Blog', get_post_type($post->ID))) . '</a>' .
                          (!empty($cat) ? ' \\ <a href="' . get_category_link($cat[0]->term_id) . '">' . $cat[0]->name . '</a>' : "") . 
                        '</div>';
}
function vc_gitem_template_attribute_author_pic( $value, $data ) {
  /**
    * @var Wp_Post $post
    * @var string $data
    */
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );

  $author_pic = get_the_author_meta('profile_picture', $post->post_author);
  return '<span class="post-author-img">' . 
                          wp_get_attachment_image($author_pic['ID'], 'thumbnail') . 
                        '</span>';
}

