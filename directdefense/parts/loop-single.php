<?php

add_action('joints_entry_header', 'open_post_featured');
add_action('joints_entry_header', 'get_featured');
add_action('joints_entry_header', 'close_element');
add_action('joints_entry_header', 'get_single_title');

function open_post_featured() {
	echo '<div class="post-featured">';
}

add_action('joints_entry_content', 'get_byline');
add_action('joints_entry_content', 'adjacent_posts_buttons');

function adjacent_posts_buttons() {
	$prev = get_previous_post();
	$next = get_next_post();
	if(empty($prev) && empty($next)) {
		return;
	}
	echo '<div class="post-nav">';
	if(!empty($prev)) {
		echo get_custom_button(array(
			'content' => 'Prev',
			'link_url' => $prev->guid,
			'style' => 'color: #333; border-color: #b7b7b7; display: inline-block;',
			'class' => 'hover-anim hover-fill-up hover-blue arrow-left arrow-left-blue post-control post-prev',
			));
	}
	if(!empty($next)) {
		echo get_custom_button(array(
			'content' => 'Next',
			'link_url' => $next->guid,
			'style' => 'color: #333; border-color: #b7b7b7; display: inline-block;',
			'class' => 'hover-anim hover-fill-up hover-blue arrow-right arrow-right-blue post-control post-next',
			));
	}
	echo '</div>';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<section class="post-content">
		<div class="vc_row vc_row-o-equal-height vc_row-flex">
			<div class="vc_column_container vc_col-sm-12">	
				<div class="vc_column-inner">	
						
   <?php do_action('joints_entry_header'); ?>
					
		<?php do_action('joints_entry_content'); ?>
						
	<footer class="article-footer">
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
	</footer> <!-- end article footer -->
	</footer> <!-- end article footer -->	
				</div>
			</div>
		</div>
	</section>												
</article> <!-- end article -->