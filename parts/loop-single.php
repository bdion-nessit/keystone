<?php
/**
 * Template part for displaying a single post
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

add_action('joints_entry_header', 'get_byline');

add_action('joints_entry_content', 'get_featured');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
   <?php do_action('joints_entry_header'); ?>
					
	<?php do_action('joints_entry_content'); ?>
						
	<footer class="article-footer">
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>	
	</footer> <!-- end article footer -->
						
	<?php comments_template(); ?>	
													
</article> <!-- end article -->