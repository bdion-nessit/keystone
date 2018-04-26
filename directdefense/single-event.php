<?php 
global $post;
$target = get_post_meta($post->ID, 'event_link', true);
if(!empty($target)) {
	header('Location: ' . $target);
}
remove_action('joints_intro_content', 'page_breadcrumbs');
add_action('joints_intro_content', 'single_post_intro');
add_action('joints_intro_content', 'get_byline');

add_action('joints_after_content', 'blog_footer');
get_header(); 
do_action('joints_before_content');
?>
			
<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="large-7 medium-7 columns" role="main">
		
		    <?php do_action('joints_entry'); ?>	

		</main> <!-- end #main -->

		 	<?php 
		    add_action('joints_sidebar', 'get_sidebar');
		    do_action('joints_sidebar');
		     ?>

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); ?>