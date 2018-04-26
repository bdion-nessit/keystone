<?php 
remove_action('joints_intro_content', 'page_breadcrumbs');
remove_action('joints_intro_content', 'get_intro_content');
get_header(); 
?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="main" class="large-12 medium-12 columns first" role="main">
				<div class="vc_row">
					<div class="vc_col-sm-12 vc_column_container">
					<div class="vc_column-inner" style="padding: 0;">
						<header>
							<h2 class="archive-title"><?php _e( 'Search Results for:', 'jointswp' ); ?> <?php echo esc_attr(get_search_query()); ?></h2>
						</header>
					</div>
					</div>
				</div>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive' ); ?>
				    
				<?php endwhile; ?>	
				<div class="vc_row">
					<div class="vc_col-sm-12 vc_column_container">
					<div class="vc_column-inner" style="padding: 0;">
						<?php joints_page_navi(); ?>
					</div>
					</div>
				</div>
					
				<?php else : ?>
				
					<?php 
					get_template_part( 'parts/content', 'missing' ); 
					blog_filler();
					?>
						
			    <?php endif; ?>
	
		    </main> <!-- end #main -->
		
		  
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
