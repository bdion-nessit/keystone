<?php 
/**
 * The template for displaying all single posts and attachments
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

add_action('joints_entry_content', 'echo_open_vc_row_wrapper', 7);
add_action('joints_entry_content', 'echo_open_vc_row_wrapper', 11);

get_header(); 
do_action('joints_before_content');
?>
			
<div class="content">

	<div class="inner-content grid-x grid-margin-x grid-padding-x">
		
		<?php 
            do_action('joints_secondary_sidebar');
        ?>

		<main class="main large-<?php echo $column_width; ?> medium-<?php echo $column_width; ?> small-12 cell" role="main">
		
		    <?php do_action('joints_entry'); //Default functionality can be found in functions/core.php ?>	

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