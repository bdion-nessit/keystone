<?php
/*
Template Name: Page with no Intro
*/
?>

<?php 
add_action('wp_head', 'body_bg');

function body_bg() {
	$featured_img = get_the_post_thumbnail_url(null, 'full');
	$bg_img = (is_single() ? get_stylesheet_directory_uri() . '/images/single_post_intro.jpg' : (!empty($featured_img) ? $featured_img : '/wp-content/uploads/2017/05/default_featured_1.jpg'));
	echo '<style>
		body {
			background-image: url(\'' . $bg_img . '\');
		}
	</style>';
}

remove_action('joints_intro_content', 'page_breadcrumbs');

get_header(); 
do_action('joints_before_content');
?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				
				<?php 

				do_action('joints_entry'); 

				?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
