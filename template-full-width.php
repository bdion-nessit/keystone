<?php
/*
Template Name: Full Width (No Sidebar)
*/

get_header(); 
do_action('joints_before_content');
?>
			
	<div class="content">
	
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
	
		    <main class="main small-12 medium-12 large-12 cell" role="main">
				
			<?php 
				do_action('joints_entry'); 
			?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
