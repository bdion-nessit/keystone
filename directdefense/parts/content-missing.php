<div class="vc_row">
	<div class="vc_col-sm-12 vc_column_container">
	<div class="vc_column-inner" style="padding: 0;">
		<div id="post-not-found" class="hentry">
			
			<?php if ( is_search() ) : ?>
				
				<header class="article-header">
					<h2><?php _e( 'Sorry, No Results.', 'jointswp' );?></h2>
				</header>
				
				<section class="entry-content">
					<p><?php _e( 'Try your search again.', 'jointswp' );?></p>
				</section>
				
				<section class="search">
				    <p><?php get_search_form(); ?></p>
				</section> <!-- end search section -->
				
				<footer class="article-footer">
					<p><?php _e( 'This is the error message in the parts/content-missing.php template.', 'jointswp' ); ?></p>
				</footer>
				
			<?php else: ?>
			
				<header class="article-header">
					<h2><?php _e( 'Oops, Post Not Found!', 'jointswp' ); ?></h2>
				</header>
				
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'jointswp' ); ?></p>
				</section>
				
				<section class="search">
				    <p><?php get_search_form(); ?></p>
				</section> <!-- end search section -->
				
				<footer class="article-footer">
				  <p><?php _e( 'This is the error message in the parts/content-missing.php template.', 'jointswp' ); ?></p>
				</footer>
					
			<?php endif; ?>
			
		</div>
	</div>
	</div>
</div>
