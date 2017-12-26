<?php 
/**
 * The template for displaying search results pages
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
 	
get_header(); 
do_action('joints_before_content');
?>
			
	<div class="content">

		<div class="inner-content grid-x grid-margin-x grid-padding-x">
			
			<?php 
				do_action('joints_secondary_sidebar');
			?>
	
			<main class="main small-12 medium-8 large-8 cell" role="main">
				<?php 
					do_action('joints_entry_header');
					if (have_posts()) {
						while (have_posts()) {
							the_post(); 
							
							do_action('joints_entry');
						}
						joints_page_navi();
					}
					else { 
						get_template_part( 'parts/content', 'missing' ); 
						blog_filler();
					}
				?>
	
		    </main> <!-- end #main -->
		
		    <?php 
                do_action('joints_primary_sidebar'); //Main sidebar loads here by default
            ?>
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
?>
