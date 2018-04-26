<?php 
remove_action('joints_intro_content', 'page_breadcrumbs');

add_action('joints_after_content', 'blog_footer');

get_header(); 
do_action('joints_before_content');
?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
		
		    <main id="main" class="large-7 medium-7 columns" role="main">
			    <div class="vc_row">
					<div class="vc_col-sm-12 vc_column_container">
					<div class="vc_column-inner" style="padding: 0;">
				    	<header>
				    		<h1 class="page-title archive-title"><?php the_archive_title();?></h1>
							<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
				    	</header>
				    </div>
					</div>
				</div>
		
		    	<?php 

		    	do_action('joints_entry');
		    	
		    	 ?>
		
			</main> <!-- end #main -->
	
			<?php get_sidebar(); ?>
	    
	    </div> <!-- end #inner-content -->
	    
	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
?>