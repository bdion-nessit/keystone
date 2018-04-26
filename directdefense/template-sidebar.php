<?php
/*
Template Name: Page with Sidebar
*/
?>

<?php 
add_action('joints_after_content', 'l2_nav');

add_action('joints_sidebar', 'get_download');
add_action('joints_sidebar_inner', 'get_download');
add_action('joints_sidebar_inner', 'get_related_materials');
add_action('joints_sidebar_inner', 'get_testimonial');
remove_action('joints_sidebar_inner', 'get_primary_sidebar');

function get_download() {
	if(!function_exists('get_field')) {
		return;
	}
	$dl_text = get_field('dl_text');
	$dl_url = get_field('dl_url');
	if(empty($dl_text) || empty($dl_url)) {
		return;
	}
	echo '<div class="sidebar-dl widget">
			<a href="' . $dl_url . '" download>' . 
				$dl_text . 
			'</a>
		</div>';
}
function get_testimonial() {
	if(!function_exists('get_field') || empty(get_field('testimonial'))) {
		return;
	}
	echo '<div class="testimonial widget">
			<div class="testimonial-content">' . get_field('testimonial') . '</div>
			<div class="testimonial-source">' . get_field('testimonial_source') . '</div>
	</div>';
}

function get_related_materials() {
	if(!function_exists('have_rows') || !have_rows('related_materials')) {
    return;
  }
  echo '<div class="related-materials widget">
  			<h6 class="widgettitle">
  				Related Materials
  			</h6>';
  while(have_rows('related_materials')) {
  	the_row();
  	echo '<a href="' . get_sub_field('rm_url') . '" class="related-material fill-right arrow-right arrow-right-black">
  		<span>' . 
  			get_sub_field('rm_text') . 
  		'</span>
  	</a>';
  }
  echo '</div>';
}

get_header();
do_action('joints_before_content');
?>
	
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-7 medium-7 columns" role="main">
	
				<?php do_action('joints_entry'); ?>							
			    					
			</main> <!-- end #main -->

		    <?php 
		    add_action('joints_sidebar', 'get_sidebar');
		    do_action('joints_sidebar');
		     ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
