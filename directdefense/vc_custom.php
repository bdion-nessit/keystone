<?php

//--------Create custom widgets--------

add_action('vc_before_init', 'vc_linkable_column');
add_action('vc_before_init', 'vc_single_item_slider_init');
add_action('vc_before_init', 'vc_custom_button_init');
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
    'admin_enqueue_css' => get_stylesheet_directory_uri() . '/assets/css/custom-editor-style.css',
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
    'as_parent' => array('except' => ''),
    'as_child' => array(
      'only' => 'vc_single_item_slider',
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
    class WPBakeryShortCode_vc_Single_Item_Slider extends WPBakeryShortCodesContainer {

    }
    class WPBakeryShortCode_vc_Single_Item_Slider_Item extends WPBakeryShortCodesContainer {

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
        'type' => 'checkbox',
        'holder' => 'div',
        'heading' => 'Use pagination',
        'param_name' => 'use_pagination',
        'group' => 'General',
        'value' => array(
          'Yes' => 'yes',
          ),
        'std' => '',
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
              ),
            'std' => '',
            'dependency' => array(
              'element' => 'hover_anim',
              'not_empty' => true,
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
                if($query1->posts[0]->post_type === 'document' && empty($atts['no_filter'])) {
                    $output .= get_document_filter();
                }
                while($query1->have_posts()) {

                  //Get category if post has one
                  $cat = get_the_category($query1->post->ID);
                  $query1->the_post();

                  //Array for storing post meta data
                  $posts_meta = array();
                  //Get the author profile picture if option set to yes
                  $author_pic = get_the_author_meta('profile_picture', $query1->post->post_author);
                  $posts_meta[] = (!empty($atts['show_author_img']) ? '<span class="post-author-img">' . 
                          wp_get_attachment_image($author_pic['ID'], 'thumbnail') . 
                        '</span>' : '');
                   //Get the author profile picture if option set to yes
                  $posts_meta[] = (!empty($atts['show_author']) ? '<span class="post-author">
                        By: <a href="' . get_author_posts_url( $query1->post->post_author) . '">' . 
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
                 
                  $parent_breadcrumb;
                  switch($query1->post->post_type) {
                    case 'event':
                    $parent_breadcrumb = '/resources/upcoming-events/';
                    break;
                    case 'in_the_news':
                    $parent_breadcrumb = '/resources/in-the-news/';
                    break;
                    default: 
                      $parent_breadcrumb = get_post_type_archive_link(get_post_type());
                      break;
                  }
                  if($query1->post->post_type === 'document') {
                    $doc_type_arr = get_the_terms($query1->post, 'document_type');
                    $doc_type = "";
                    if(!empty($doc_type_arr)) {
                      $doc_type = $doc_type_arr[0]->slug;
                    }
                    $doc_featured = "";
                    switch($doc_type) {
                      case 'white-papers':
                        $doc_featured = get_stylesheet_directory_uri() . '/images/documentation-icon_whitepaper.png';
                        break;
                      case 'service-papers':
                        $doc_featured = get_stylesheet_directory_uri() . '/images/documentation-icon_service-paper.png';
                        break;
                      case 'guides':
                        $doc_featured = get_stylesheet_directory_uri() . '/images/documentation-icon_guide.png';
                        break;
                      case 'presentations':
                        $doc_featured = get_stylesheet_directory_uri() . '/images/documentation-icon_presentation.png';
                        break;
                    }
                    $output .= '<a href="' . get_post_meta($query1->post->ID, 'url', true) . '">
                      <div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex inner-row">
                        <div class="vc_col-sm-1 vc_column_container document-featured">' . 

                        //Display featured image if option set to yes
                        (!empty($atts['show_featured_image']) && !empty($doc_featured) ? '<div class="post-featured document-featured-inner"><img src="' . $doc_featured . '" /></div>' : "") . 
                      '</div>
                      <div class="vc_col-sm-11 vc_column_container document-content inner-column">
                        <div class="vc_column-inner">
                          <h6>' . 
                            get_the_title() . 
                          '</h6>
                          <p>
                            Download Now >>
                          </p>
                        </div>
                      </div>
                      </div>
                    </a>';
                  }
                  else {
                  $output .= '<div class="vc_col-sm-' . $col_width . ' vc_column_container single single-' . $query1->post->post_type . '"' . (!empty($atts['show_featured_image']) && $query1->post->post_type === 'post' ? 'style="background-image: url(\'' . get_the_post_thumbnail_url($query1->post->ID, 'full') . '\');"' : "")  . '>' . 

                      //Display featured image if option set to yes
                      (!empty($atts['show_featured_image']) && $query1->post->post_type != 'post' ? '<div class="post-featured">' . get_the_post_thumbnail($query1->post->ID, 'full') . '</div>' : "") .
                      
                      //Display breadcrumbs if option set to yes
                      (!empty($atts['show_breadcrumbs']) ? '<div class="post-breadcrumbs">
                          <a href="' . $parent_breadcrumb . '">' . preg_replace("/_/", ' ', preg_replace("/post/", 'Blog', get_post_type())) . '</a>' .
                          (!empty($cat) ? ' \\ <a href="' . get_category_link($cat[0]->term_id) . '">' . $cat[0]->name . '</a>' : "") . 
                        '</div>' : '') . 

                      '<h3 class="single-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>' . 

                      //Display any post meta set to be shown
                      (!empty($posts_meta) && !empty($posts_meta[0]) ? '<div class="post-meta">' . implode('&nbsp;&nbsp;&nbsp;', $posts_meta) . '</div>' : '') .
                      '<div class="post-content">' . get_the_excerpt() . '</div>
                    </div>';
                  }
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

  //Get the visual composer styles
  $css = (isset($atts['css']) ? $atts['css'] : "");
  $css_class = (!empty($css) ? apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'inline_custom_button', $atts ) : "");

  $target = (isset($atts['link']) ? vc_build_link($atts['link']) : "");

  //Pass along link target to button widget if set
  $button_atts['link_url'] = (isset($target['url']) ? $target['url'] : "");
  $button_atts['target'] = (isset($target['target']) ? $target['target'] : "");

  //Tell button widget if target is a download
  $button_atts['is_download'] = (isset($atts['is_download']) && $atts['is_download'] === 'yes' ? 'true': false);

  //Initialize class variable
  $button_atts['class'] = '';

  //Format button content base on content type set
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

          //Add class that drives hover state
          $button_atts['class'] .= 'has-hover ';
        }
      }
      else {
        $button_atts['content'] = '';
      }
      break;
  }

  //Pass along id to button widget if set
  $button_atts['element_id'] = (isset($atts['elem_id']) ? $atts['elem_id'] : "");

  //Pass along the hover animation type to button widget if set
  $button_atts['hover_anim'] = (isset($atts['hover_anim']) ? $atts['hover_anim'] : "");

  //Pass along the hover animation color to button widget if set
  $button_atts['hover_color'] = (isset($atts['hover_color']) ? $atts['hover_color'] : "");
  $class = (isset($atts['el_class']) ? $atts['el_class'] : "");
  $button_atts['class'] = //(isset($atts['button_size']) ? $atts['button_size'] . ' ' : "") . 
                            //$atts['content_type'] . ' ' . 
                            $class . ' ' . 
                            $css_class . 
                            (!empty($atts['button_display']) ? ' full-width': "");
  $button_atts['style'] = '';
  $button_atts['style'] = (!empty($atts['color']) ? 'color: ' . $atts['color'] . ';' : "") . (!empty($atts['button_display']) ? ' display: ' . $atts['button_display'] . ';' : "");
  return '<div class="wpb_custom_button" style="' . (!empty($atts['button_display']) ? 'display: ' . $atts['button_display'] . ';' : "") . '">' . get_custom_button($button_atts) . '</div>';
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
	$shortcodes['vc_custom_event_location'] = array(
    'name' => __( 'Event Location', 'my-text-domain' ),
    'base' => 'vc_custom_event_location',
    'category' => __( 'Content', 'my-text-domain' ),
    'description' => __( 'Show the event\'s location', 'my-text-domain' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
   );
	
	$shortcodes['vc_linked_custom_field'] = array(
    'name' => __( 'Linked Custom Field', 'my-text-domain' ),
    'base' => 'vc_linked_custom_field',
    'category' => __( 'Content', 'my-text-domain' ),
    'description' => __( 'Displays a custom field as a link', 'my-text-domain' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
	'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Field key name',
        'param_name' => 'key',
        'description' => 'Enter custom field name to retrieve meta data value.',
        'group' => 'General',
        ),
      ),
   );

  $shortcodes['vc_custom_formatted_date'] = array(
    'name' => __( 'Custom Formatted Date', 'my-text-domain' ),
    'base' => 'vc_custom_formatted_date',
    'category' => __( 'Content', 'my-text-domain' ),
    'description' => __( 'Post Date with the format 00.00.00', 'my-text-domain' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Extra class name',
        'param_name' => 'el_class',
        'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
        'group' => 'General',
        ),
      ),
   );
  return $shortcodes;
}
 

// output function
add_shortcode( 'vc_custom_breadcrumbs', 'vc_custom_breadcrumbs_render' );
add_shortcode( 'vc_custom_author_pic', 'vc_custom_author_pic_render' );
add_shortcode( 'vc_custom_event_location', 'vc_custom_event_location_render' );
add_shortcode( 'vc_linked_custom_field', 'vc_linked_custom_field_render' );
add_shortcode( 'vc_custom_formatted_date', 'vc_custom_formatted_date_render' );

function vc_custom_breadcrumbs_render($atts, $content, $tag) {
  return '{{zebreadcrumbs}}';
}

function vc_custom_author_pic_render($atts, $content, $tag) {
  return '{{author_pic}}';
}

function vc_custom_event_location_render($atts, $content, $tag) {
  return '{{event_location}}';
}

function vc_linked_custom_field_render($atts, $content, $tag) {
  $link = '{{custom_meta:' . $atts['key'] . '}}';
	return '<a href="' . $link . '" class="vc_gitem-linked-post-meta-field">' . $link . '</a>';
}

function vc_custom_formatted_date_render($atts, $content, $tag) {
  return '<div class="vc_custom_heading vc_gitem-post-data vc_gitem-post-data-source-post_date ' . $atts['el_class'] . '"> {{custom_formatted_date}} </div>';
}
  
add_filter( 'vc_gitem_template_attribute_post_attr', 'vc_gitem_template_attribute_post_attr', 10, 2 );
add_filter( 'vc_gitem_template_attribute_custom_meta', 'vc_gitem_template_attribute_custom_meta', 10, 2 );
add_filter( 'vc_gitem_template_attribute_zebreadcrumbs', 'vc_gitem_template_attribute_zebreadcrumbs', 10, 2 );
add_filter( 'vc_gitem_template_attribute_author_pic', 'vc_gitem_template_attribute_author_pic', 10, 2 );
add_filter( 'vc_gitem_template_attribute_custom_formatted_date', 'vc_gitem_template_attribute_custom_formatted_date', 10, 2 );

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
   return get_post_meta($post->ID, $data, true);
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
  $parent_breadcrumb;
                  switch($post->post_type) {
                    case 'event':
                    $parent_breadcrumb = '/resources/upcoming-events/';
                    break;
                    case 'in_the_news':
                    $parent_breadcrumb = '/resources/in-the-news/';
                    break;
                    default: 
                      $parent_breadcrumb = get_post_type_archive_link(get_post_type());
                      break;
                  }
  return '<div class="post-breadcrumbs">
                          <a href="' . $parent_breadcrumb . '">' . preg_replace("/_/", ' ', preg_replace("/post/", 'Blog', get_post_type($post->ID))) . '</a>' .
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
function vc_gitem_template_attribute_custom_formatted_date( $value, $data ) {
  

   /**
    * @var Wp_Post $post
    * @var string $data
    */
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );

  //return json_encode(get_post_meta( $post->ID, 'test' ));
   return get_the_date('m.d.y', $post->ID);
}

