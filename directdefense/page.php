
<?php 
add_action('joints_entry_content', 'about_us_nav');

function about_us_nav() {
	global $post;
	if(!($post->post_parent === 41)) {
		return;
	}
	$children = get_children(array(
		'post_parent' => 41,
		'post_type' => 'page',
		'numberposts' => -1,
		'post_status' => 'publish',
		));
	echo '<div class="vc_row wpb_row vc_row-fluid vc_row-has-fill about-us-nav">
		<div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner">
			<hr />
		</div></div>
		<div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner vc_custom_1496756576613"><div class="wpb_wrapper">
		<div class="wpb_text_column wpb_content_element ">
			<div class="wpb_wrapper">
				<h4>More Under: About US</h4>';
				foreach($children as $child) {
					echo get_custom_button(array(
						'content' => $child->post_title,
						'link_url' => get_permalink($child->ID),
						'hover_anim' => 'hover-partial-fill-down',
						'hover_color' => 'hover-gray',
						'style' => 'color: #fff; border-color: #009cde; background-color: #009cde;',
						));
				}
			echo '</div>
		</div>
	</div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner vc_custom_1496756731874"></div></div></div>';
}

get_header(); 
do_action('joints_before_content');
?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				
				<?php 

				do_action('joints_entry'); 

				?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php 
do_action('joints_after_content');
get_footer(); 
