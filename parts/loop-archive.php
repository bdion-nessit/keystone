<?php
/**
 * Template part for displaying posts
 *
 * Used for single, index, archive, search.
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

//Remove header elements intended for single pages
remove_action('joints_entry_header', 'entry_header_row_open', 3);
remove_action('joints_entry_header', 'get_entry_header', 9);
remove_action('joints_entry_header', 'entry_header_row_close', 15);

add_action('joints_entry_header', 'get_archive_title');
add_action('joints_entry_header', 'get_byline');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">	
	<section class="post-content">
		<div class="vc_row vc_row-o-equal-height vc_row-flex">
			<div class="vc_column_container vc_col-sm-12">	
				<div class="vc_column-inner">	

					<?php 
					do_action('joints_entry_header'); //Default actions defined in core.php
					?>
					
				</div>
			</div>
		</div>
		
		<?php
		if(get_post_type() !== 'page') { 
		?>
		<div class="vc_row vc_row-o-equal-height vc_row-flex">
			<div class="vc_column_container vc_col-sm-12">	
				<div class="vc_column-inner">	

					<?php 
		}
		
					do_action('joints_entry_content'); //Default actions defined in core.php
					?>
		<?php
		if(get_post_type() !== 'page') {
		?>			
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="vc_row vc_row-o-equal-height vc_row-flex">
			<div class="vc_column_container vc_col-sm-12">	
				<div class="vc_column-inner">	

					<?php 
					do_action('joints_entry_footer'); //Default actions defined in core.php
					?>
					
				</div>
			</div>
		</div>		
		
	</section>		    						
</article> <!-- end article -->