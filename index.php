<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

add_action('joints_primary_sidebar', 'get_sidebar');
get_header(); 
do_action('joints_before_content');
?>
			
	<div class="content">
	
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
			
		<?php 
            do_action('joints_secondary_sidebar');
        ?>
	
		    <main class="main large-<?php echo $column_width; ?> medium-<?php echo $column_width; ?> small-12 cell" role="main">
		    
			    <?php 
		    		do_action('joints_entry');
		    	?>
																								
		    </main> <!-- end #main -->
		    
			<?php 
				do_action('joints_primary_sidebar');
			?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
?>