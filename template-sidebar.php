<?php 
/*
Template Name: Page with Sidebar
*/

global $column_width;

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
					do_action('joints_entry'); //Default functionality found in functions/core.php
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