<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php'); 


// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php'); 

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php'); 

//-------Begin required/included files-------

//get core theme functions
require_once(get_stylesheet_directory() . '/assets/functions/core.php');

//add sidebars to theme
require_once(get_stylesheet_directory() . '/widget_areas.php');

//add custom button widget to theme
require_once(get_stylesheet_directory() . '/button_widget.php');

//add custom VC widgets and functions
require_once(get_stylesheet_directory() . '/vc_custom.php');

require_once(get_stylesheet_directory() . '/pagination.php');

require_once(get_stylesheet_directory() . '/document_filter.php');

//-------End required/included files-------

//-------Begin external scripts-------

add_action('wp_head', 'preloader');

function preloader() {
  ?>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/preloader.css" rel="stylesheet" type="text/css">
  <?php
}

add_action('wp_footer', 'end_preloader', 50);

function end_preloader() {
  ?>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/preloader-end.css" rel="stylesheet" type="text/css">
  <?php
}

add_action('wp_head', 'google_fonts');

function google_fonts() {
  ?>
  <link href="" rel="stylesheet">
  <?php
}

//add general custom scripts 
add_action('wp_head', 'get_theme_scripts');

function get_theme_scripts() {
  echo '<script type="text/javascript" src="' . get_stylesheet_directory_uri() . '/assets/js/theme_scripts.js"></script>';
}

//add general slider scripts 
add_action('wp_head', 'get_slider_scripts');

function get_slider_scripts() {
  echo '<script type="text/javascript" src="' . get_stylesheet_directory_uri() . '/assets/js/slider.js"></script>';
}


add_action('wp_enqueue_scripts', 'enqueue_document_filter');
add_action('wp_ajax_do_document_filter', 'do_document_filter');
add_action('wp_ajax_nopriv_do_document_filter', 'do_document_filter');

function enqueue_document_filter() {
  wp_enqueue_script('document_filter_ajax', get_stylesheet_directory_uri() . '/assets/js/document_filter_ajax.js', array('jquery'), '1.0', true);

  wp_localize_script('document_filter_ajax', 'ajax_admin_url', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_blog_load_more');
add_action( 'wp_ajax_blog_load_more', 'do_blog_load_more' );
add_action( 'wp_ajax_nopriv_blog_load_more', 'do_blog_load_more' );

function enqueue_blog_load_more() {
  wp_enqueue_script( 'blog_load_more_ajax', get_stylesheet_directory_uri() . '/assets/js/blog_load_more_ajax.js', array('jquery'), '1.0', true );

  wp_localize_script( 'blog_load_more', 'ajax_admin_url', array(
    'ajax_url' => admin_url( 'admin-ajax.php' )
  ));
}

//-------End external scripts-------

//-------Begin Shortcodes------

add_shortcode('get_search_box', 'get_search_form');
add_shortcode('inline_custom_button', 'get_custom_button');
add_shortcode('joints_site_map', 'get_site_map');
add_shortcode('newsletter_block', 'get_newsletter_block');
add_shortcode('content_slider_controls', 'get_slider_content_controls');
add_shortcode('l1_nav', 'do_l1_nav');
add_shortcode('document_filter', 'get_document_filter');

function get_custom_button($atts) {
  ob_start();
  the_widget('Custom_Button', $atts);
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}
function get_site_map() {
  $primary = wp_get_nav_menu_items('primary-nav');
  $output = '<div class="vc_column_container vc_col-sm-4 sitemap-col"><div class="vc_column-inner">';
  $i = 1;
  $cur_parent = 0;
  foreach($primary as $ind => $item) {
    if(!preg_match("/Overview/", $item->title)) {
      $is_sub_parent = false;
      if($item->menu_item_parent == 0 ) {
        $cur_parent = $item->ID;
        if($ind != 0){
          $output .= '</div></div><div class="vc_column_container vc_col-sm-4 sitemap-col"><div class="vc_column-inner">';
        } 
      }
      elseif($item->menu_item_parent == $cur_parent) {
        $sub_count = count(get_pages( array( 'parent' => $item->object_id, 'post_type' => 'page', 'hierarchical' => 0  ) ));
        if($sub_count) {
          $is_sub_parent = true;
          $output .= '<strong>';
        }

      }
      if(!in_array('primary-sub-header', $item->classes)) {
        $output .= '<a href="' . $item->url . '">' . $item->title . '</a><br />';
      }
      if($is_sub_parent) {
        $output .= '</strong>';
      }
    }
  }
  $output .= '</div></div>';
  return $output;
}
function get_newsletter_block() {
  return do_shortcode('[vc_linkable_column link="url:https%3A%2F%2Fgo.pardot.com/emailPreference/e/350831/91||target:%20_blank|" el_class="newsletter-widget widget"][vc_column_text]<img class="size-full wp-image-371 aligncenter" src="/wp-content/uploads/2017/06/newsletter_icon.png" alt="Sign up for the latest security threat news." width="111" height="111" />[/vc_column_text][vc_custom_heading text="Sign up for the latest security threat news." font_container="tag:h5|text_align:center" use_theme_fonts="yes"][vc_inline_custom_button content_type="text" title="Signup" hover_anim="hover-partial-fill-down" hover_color="hover-gray" button_display="inline-block" color="#ffffff"][/vc_linkable_column]');
}

function get_slider_content_controls() {
  return do_shortcode('[inline_custom_button class="content-slide-prev content-slide-dir arrow-left arrow-left-blue" style="border-color: transparent;"]') . 
  do_shortcode('[inline_custom_button class="content-slide-next content-slide-dir arrow-left arrow-left-blue" style="border-color: transparent;"]');
}
function do_l1_nav($atts) {
  global $post;

  $children = get_children(array(
            'numberposts' => -1,
            'post_parent' => (!empty($atts['id']) ? $atts['id'] : $post->ID),
            'post_status' => 'publish',
            ), OBJECT);
  if(empty($children)) {
    return;
  }
  $i = 0;
  $num_children = count($children);
  echo '<div class="l1-nav vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-o-content-top vc_row-flex inner-row">
    <div class="vc_column_container vc_col-sm-6 l1-nav-nav inner-column">
      <div class="vc_column-inner">';
          foreach($children as $child) {
            if($i === intval(ceil($num_children / 2))) {
                echo '</div>
                </div>
                <div class="vc_column_container vc_col-sm-6 l1-nav-nav inner-column">
                  <div class="vc_column-inner">';
              }
              echo '<a href="' . get_permalink($child->ID) . '" class="l1-nav-item">' . $child->post_title . '</a>';
            $i++;
          }
        echo '</div>
    </div>
  </div>';
}

//-------End Shortcodes-------


//Code to create custom post type

/** add_action( 'init', 'create_slide_type' );
function create_slide_type() {
  register_post_type( 'intro_slide',
    array(
      'labels' => array(
        'name' => __( 'Intro Slides' ),
        'singular_name' => __( 'Intro Slide' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}*/

//Modifies nav
//Sets primary nav to Foundation dropdown by default
add_action('joints_nav', 'call_nav_filter', 3);

function call_nav_filter() {
  if ( is_admin() ) {
        return;
    }
    global $is_mobile_menu;
    $is_mobile_menu = false;
    add_filter('wp_nav_menu_items', 'custom_nav_filter', 1, 2);
}

function custom_nav_filter($items, $args) {
  if($args->menu->slug === 'primary-nav') {
    global $is_mobile_menu;
    if(!$is_mobile_menu) {
      $args->items_wrap = '<ul id="%1$s" class="%2$s dropdown menu">%3$s</ul>';
      //$items = preg_replace('/sub\-menu/', 'sub-menu menu vertical', $items);
      $is_mobile_menu = true;
    }
    else {
      $args->items_wrap = '<ul id="%1$s" class="%2$s vertical menu" data-drilldown data-auto-height="true">%3$s</ul>';
      $items = preg_replace('/sub\-menu/', 'sub-menu menu vertical', $items);
    }
  }
  return $items;
}

add_filter('the_content', 'add_spans');

function add_spans($content) {
  return preg_replace("/\<li\>/", '<li><span>', preg_replace("/\<\/li\>/", '</span></li>', $content));
}

function l2_nav() {
  global $post;

  $parent_id = (is_page_template('template-l2.php') ? get_the_ID() : $post->post_parent);
  $children = get_children(array(
            'numberposts' => -1,
            'post_parent' => $parent_id,
            'post_status' => 'publish',
            ), OBJECT);
  if(empty($children)) {
    return;
  }
  echo '<div class="l2-nav vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-o-content-top vc_row-flex">
    <div class="vc_column_container vc_col-sm-6 l2-nav-header">
      <div class="vc_column-inner">
        <div class="vc_column_container vc_col-sm-9 inner-column">
          <div class="vc_column-inner">
            <h2>
              Explore<br />
              By:<br />' .
              preg_replace("/[[:space:]]+/", '<br />', get_the_title($parent_id)) . '<br />
            <span class="l2-nav-underline"></span>
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="vc_column_container vc_col-sm-6 l2-nav-nav">
      <div class="vc_column-inner">';
          foreach($children as $child) {
            echo '<a href="' . get_permalink($child->ID) . '" class="l2-nav-item' . ($child->ID === $post->ID ? ' current-l2-nav-item' : "") . '">' . $child->post_title . '</a>';
          }
        echo '</div>
    </div>
  </div>';
}

add_action( 'dynamic_sidebar_before', 'widget_title_h4_h6' );

function widget_title_h4_h6( $sidebar_id ) {
 global $wp_registered_sidebars;
 if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
    if ( isset($wp_registered_sidebars[$sidebar_id]['before_title']) ) {
      $now = $wp_registered_sidebars[$sidebar_id]['before_title'];
      $now = str_ireplace( '<h4', '<h6', $now );
      $wp_registered_sidebars[$sidebar_id]['before_title'] = $now;
    }
 }
}

add_action('widget_categories_args', 'add_all_categories');

function add_all_categories($args) {
  $args['title_li'] = '<div class="cat-item all-cats"><a href=' . get_permalink(get_option('page_for_posts')) . '>All Categories</a></div>';
  return $args;
}

function blog_footer() {
  if(!function_exists('get_field')) {
    return; 
  }
  $blog = get_option('page_for_posts');
  echo '<div class="blog-footer">' .
    get_field('blog_footer', $blog) .
    '<div style="clear: both;"></div>
  </div>';
}

add_filter('wp_tag_cloud', 'tag_cloud_wrap', 10);

function tag_cloud_wrap($tags) {
  $tags_arr = explode('</a>', $tags);
  foreach($tags_arr as &$tag) {
    $tag = substr_replace($tag, '<span>', strpos($tag, '>', strpos($tag, '<a')) + 1, 0);
  }
  unset($tag);
  return implode('</span></a>', $tags_arr);
}

//add_filter('wp_tag_cloud', 'test', 10, 2);

function test($a, $b) {
  echo htmlspecialchars(preg_replace("/\<\/a\>/", '</span></a>', preg_replace("/[^\/a]\>/", '><span>', $a)));
  //echo '<br /><br />';
  //print_r($b);  return $a;
}

function get_document_filter() {
  $output = '<div class="document-filter">
        <span>Filter by topic: </span><select class="document-filter-dropdown" data-type="document_category">
          <option value="">All</option>';
          $terms = get_terms(array(
            'taxonomy' => 'document_category',
            )
            );
          foreach($terms as $term) {
            $output .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
          }
      $output .= '</select>
      </div>
      <div class="document-filter">
        <span>Filter by type: </span><select class="document-filter-dropdown" data-type="document_type">
          <option value="">All</option>';
          $terms = get_terms(array(
            'taxonomy' => 'document_type',
            )
            );
          foreach($terms as $term) {
            $output .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
          }
      $output .= '</select>
      </div>';
  return $output;
}

//add_action('joints_entry_content', 'testing');

function testing() {
  $widget_args = array(
      'post_types' => 'document',
      'show_featured_image' => 'yes',
      'no_filter' => true,
      'post_count' => 5,
      'use_pagination' => 'yes',
      'post_cats' => "",
      'tax_type' => "document_type,document_category",
      );
  echo joints_vc_custom_posts_widget($widget_args);
}

/* Hide WP version strings from scripts and styles
 * @return {string} $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function fjarrett_remove_wp_version_strings( $src ) {
 global $wp_version;
 parse_str(parse_url($src, PHP_URL_QUERY), $query);
 if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
 $src = remove_query_arg('ver', $src);
 }
 return $src;
}
add_filter( 'script_loader_src', 'fjarrett_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'fjarrett_remove_wp_version_strings' );

/* Hide WP version strings from generator meta tag */
function wpmudev_remove_version() {
return '';
}
add_filter('the_generator', 'wpmudev_remove_version');



// Simple Query String Login page protection
function simple_query_string_protection_for_login_page() {
$QS = '?admin=directdefense';
$theRequest = 'https://' . $_SERVER['SERVER_NAME'] . '/' . 'wp-login.php' . '?'. $_SERVER['QUERY_STRING'];

// these are for testing
// echo $theRequest . '<br>';
// echo site_url('/wp-login.php').$QS.'<br>';	

	if ( site_url('/wp-login.php').$QS == $theRequest ) {
		//echo 'Query string matches';
	} else {
		header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '' );
	}
}
add_action('login_head', 'simple_query_string_protection_for_login_page'); 

