<?php 
remove_action('joints_intro', 'do_intro_content');

remove_action('joints_entry_content', 'the_entry_content', 9);
add_action('joints_entry_content', 'not_found_content');

function not_found_content() {
	?>
	<section class="entry-content">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/404-static.png" alt="Error: 404" />
						<p><?php _e( 'ERROR: 404 - Page not found... try a search or ', 'jointswp' ); ?><a href="/">return home</a></p>
	</section> <!-- end article section -->

	<section class="search">
		<p><?php get_search_form(); ?></p>
	</section> <!-- end search section -->
	<?php
}

get_header(); 
?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="main" class="large-12 medium-12 columns" role="main">

				<article id="content-not-found">
				
					<header class="article-header">
						<!--<h1><?php //_e( 'Epic 404 - Article Not Found', 'jointswp' ); ?></h1>-->
					</header> <!-- end article header -->
			
					<?php do_action('joints_entry_content'); ?>
			
				</article> <!-- end article -->
	
			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>