<?php
add_action('joints_entry_header', 'joints_archive_title');

add_action('joints_entry_header', 'get_byline');

add_action('joints_entry_content', 'open_post_content', 8);
add_action('joints_entry_content', 'close_element', 11);

global $post;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-' . $post->post_type); ?> role="article">	
	<section class="post-content">
		<div class="vc_row vc_row-o-equal-height vc_row-flex">
			<div class="vc_column_container vc_col-sm-12">	
				<div class="vc_column-inner">	

					<?php 
					do_action('joints_entry_header');

					do_action('joints_entry_content'); 
					?>
										
					<footer class="article-footer">
					</footer> <!-- end article footer -->	
				</div>
			</div>
		</div>
	</section>		    						
</article> <!-- end article -->