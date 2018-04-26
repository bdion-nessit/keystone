<?php
add_action('joints_entry_content', 'wp_link_pages', 9);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
	<?php 

	do_action('joints_entry_header'); 

	?>
					
    <section class="entry-content" itemprop="articleBody">

	    <?php  do_action('joints_entry_content'); ?>
	    
	</section> <!-- end article section -->
						
	<footer class="article-footer">
		
	</footer> <!-- end article footer -->
						    
	<?php comments_template(); ?>
					
</article> <!-- end article -->