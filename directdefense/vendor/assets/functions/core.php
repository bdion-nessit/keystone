<?php

add_filter('widget_text','do_shortcode');

//-------General Functions-------
function close_element() {
	?>
	</div>
	<?php
}

//-------Begin Intro Section-------

add_action('joints_intro', 'open_intro', 2);
add_action('joints_intro', 'intro_bg', 6);
add_action('joints_intro', 'do_intro_content');
add_action('joints_intro_content', 'open_intro_content', 2);
add_action('joints_intro_content', 'page_breadcrumbs');
add_action('joints_intro_content', 'get_intro_content');
add_action('joints_intro_content', 'close_intro_content', 50);
add_action('joints_intro_content', 'close_element', 50);
add_action('joints_intro', 'close_element', 50);

function open_intro() {
	?>
	<div <?php apply_filters('intro_class', 'intro') ?>>
	<?php
}
function open_intro_content() {
	$intro_size;
	switch(true) {
		case (is_page_template('template-l1.php')) :
			$intro_size = 9;
			break;
		case (is_home() || is_archive()) : 
			$intro_size = 8;
			break;
		case (is_single()) :
			$intro_size = 7;
			break; 
		default :
			$intro_size = 6;
	}
	?>
	<div class="intro-content">
		<div class="vc_row">
			<div class="vc_column_container vc_col-sm-<?php echo $intro_size ?>">
				<div class="vc_column-inner">
	<?php
}
function intro_bg() {
	$page_for_posts_id = get_option('page_for_posts');
	$page = (is_home() || is_archive() ? $page_for_posts_id : null);
	$featured_img = get_the_post_thumbnail_url($page, 'full');
	$bg_img = (is_single() ? get_stylesheet_directory_uri() . '/images/single_post_intro.jpg' : (!empty($featured_img) ? $featured_img : '/wp-content/uploads/2017/05/default_featured_1.jpg'));
	echo '<div class="intro-bg" style="background-image: url(\'' . $bg_img . '\');">
	</div>';
}
function page_breadcrumbs() {
	global $post;
	if(is_front_page()) {
		return;
	}
	echo '<div class="page-breadcrumbs">
		C: \\ ';
	$breadcrumbs = array();
	$breadcrumbs[] = get_the_title();
	$ancestors = get_post_ancestors($post);
	foreach($ancestors as $ancestor) {
		$breadcrumbs[] = '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
	}
	$breadcrumbs = array_reverse($breadcrumbs);
	echo implode(' \\ ', $breadcrumbs);
	echo '</div>';
}
function do_intro_content() {
	do_action('joints_intro_content');
}
function get_intro_content() {
	$page_for_posts_id = get_option('page_for_posts');
	$page = (is_home() || is_archive() ? $page_for_posts_id : null);
	echo //(is_front_page() ? '' : get_the_title()) .
		(function_exists('get_field') ? get_field('intro_content', $page) : '');
}
function close_intro_content() {
	?>
	</div>
		</div>
			</div>
	<?php
}

//-------End Intro Section-------

//-------Begin Loop-------

add_action('joints_entry', 'joints_loop');

function joints_loop() {
  if (have_posts()) { 
  		while (have_posts()) { 
  			the_post();
    		if(get_post_type() === 'page') {
        		get_template_part( 'parts/loop', 'page' );
      		}
      		elseif(is_single()) {
      			get_template_part( 'parts/loop', 'single' );
      		}
      		else {
      			get_template_part( 'parts/loop', 'archive' );
      		}
		}
		if(is_archive() || is_front_page()) {
			joints_page_navi();
		}
	}
	else {
		get_template_part( 'parts/content', 'missing' );
	} 
}

	//-------Begin Archive Functionality-------

function joints_archive_title() {
	?>
	<h3>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	<?php  
}

function open_post_content() {
	echo '<div class="post-content">';
}

	//-------End Archive Functionality-------

	//-------Begin Single Post Functionality-------

	function single_post_intro() {
		global $post;
		$cat = get_the_category($post->ID);
		echo '<div class="post-breadcrumbs">
			<a href="' . get_permalink(get_option('page_for_posts')) . '"><img src="' . get_stylesheet_directory_uri() . '/images/button_left_blue.png" alt="Back" />&nbsp;&nbsp;&nbsp;Back</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . get_category_link($cat[0]->term_id) . '">' . $cat[0]->name . '</a>
		</div>
		<h2>' .
			$post->post_title . 
		'</h2>';
	}
	function get_single_title() {
		?>
		<h3 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h3>
	<?php
	}

	//-------End Single Post Functionality-------

//-------End Loop-------

//-------Begin Entry Header Section-------

add_filter('entry_header_class', 'initialize_entry_header_class', 1);
add_filter('entry_header_class', 'do_entry_header_class', 99);

function initialize_entry_header_class() {
	return array('entry-header');
}
function do_entry_header_class($classes) {
	echo 'class="' . implode(' ', $classes) . '"';
}

add_action('joints_entry_header', 'open_entry_header', 1);
add_action('joints_entry_header', 'post_header_fields');
add_action('joints_entry_header', 'close_entry_header', 99);

function open_entry_header() {
	?>
	<header <?php apply_filters('entry_header_class', ''); ?>>
	<?php
}
function post_header_fields() {
	if(!is_home() && !is_archive()) {
		return;
	}
	echo '<div class="post-featured">';
		get_featured();
	echo '</div>';
	get_category_list();
}
function close_entry_header() {
	?>
	</header>
	<?php
}

function get_byline() {
	get_template_part( 'parts/content', 'byline' );
}

//-------End Entry Header Section-------

add_action('joints_entry_content', 'the_entry_content', 9);

function the_entry_content() {
	if(is_archive() || is_front_page()) {
		the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>');
	}
	else {
		the_content();
	}
}

function get_featured() {
	the_post_thumbnail('full');
}
function get_category_list() {
	$cats = get_the_category();
	$cat_links = array();
	echo (!empty($cats) ? '<div class="category-list">' : "");
	foreach($cats as $cat) {
		$cat_links[] = '<a href="/category/' . $cat->category_nicename . '">' . $cat->name . '</a>';
	}
	echo implode(' ', $cat_links);
	echo (!empty($cats) ? '</div>' : "");
}

add_action('joints_entry', 'blog_filler');

function blog_filler() {
	do_shortcode('[vc_row el_class="blog-filler"][vc_column][/vc_column][/vc_row]');
}

add_action('joints_sidebar_inner', 'get_primary_sidebar');

function get_primary_sidebar() {
	if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

	<?php endif; 
}
