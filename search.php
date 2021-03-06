<?php 
/**
 * The template for displaying search results pages
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

add_action('joints_entry_header', 'get_entry_header', 9);
 	
get_header(); 
do_action('joints_before_content');
?>
			
	<div class="content">

		<div class="inner-content grid-x grid-margin-x grid-padding-x row">
			
			<?php 
				do_action('joints_secondary_sidebar');
			?>
	
			<main class="main small-12 large-<?php echo $column_width; ?> medium-<?php echo $column_width; ?> cell" role="main">
				<?php 
					//do_action('joints_entry_header');
					if (have_posts()) {			
						do_action('joints_entry_header');
						do_action('joints_entry');
					
					}
					else { 
						get_template_part( 'parts/content', 'missing' ); 
						blog_filler();
					}
				?>
	
		    </main> <!-- end #main -->
		
		    <?php 
                //do_action('joints_primary_sidebar'); //Main sidebar loads here by default
            ?>
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
?>
