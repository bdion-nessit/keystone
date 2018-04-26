<div class="post-meta">
	<span class="post-author-img"><?php global $post; $author_pic = get_the_author_meta('profile_picture', $post->post_author); 
	echo wp_get_attachment_image($author_pic['ID'], 'thumbnail')?></span><span class="post-author">&nbsp;&nbsp;&nbsp;By: <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('display_name', $post->post_author);  ?></a>&nbsp;&nbsp;&nbsp;</span><span class="post-date"><?php the_time('m.d.y'); ?></span>
</div>