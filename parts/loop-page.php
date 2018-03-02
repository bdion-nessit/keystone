<?php
/**
 * Template part for displaying page content in page.php
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */
?>

<?php
add_action('joints_entry_content', 'wp_link_pages', 9);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
	<?php do_action('joints_entry_header'); ?>

    <?php  do_action('joints_entry_content'); ?>
						
	<footer class="article-footer">
		
	</footer> <!-- end article footer -->
						    
	<?php comments_template(); ?>
					
</article> <!-- end article -->

