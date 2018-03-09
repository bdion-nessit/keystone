<?php
/**
 * The template for displaying the footer. 
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */			
 ?>
<?php 
add_action('joints_inner_footer', 'do_footer_sidebar_1', 14);
add_action('joints_inner_footer', 'do_footer_sidebar_2', 14);
add_action('joints_inner_footer', 'do_footer_sidebar_3', 14);
add_action('joints_inner_footer', 'do_footer_sidebar_4', 14);
add_action('joints_inner_footer', 'do_copyright', 16);

function do_footer_sidebar_1() {
	global $footer_column_width;
	
	if(is_active_sidebar('footer-sidebar-1')) {
		echo '<div class="vc_col-sm-' . $footer_column_width . ' vc_column_container footer-sidebar-1 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-1');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_2() {
	global $footer_column_width;
	
	if(is_active_sidebar('footer-sidebar-2')) {
		echo '<div class="vc_col-sm-' . $footer_column_width . ' vc_column_container footer-sidebar-2 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-2');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_3() {
	global $footer_column_width;
	
	if(is_active_sidebar('footer-sidebar-3')) {
		echo '<div class="vc_col-sm-' . $footer_column_width . ' vc_column_container footer-sidebar-3 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-3');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_4() {
	global $footer_column_width;
	
	if(is_active_sidebar('footer-sidebar-4')) {
		echo '<div class="vc_col-sm-' . $footer_column_width . ' vc_column_container footer-sidebar-4 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-4');
		echo '</div>
		</div>';
	}
}

function do_copyright() {
	global $footer_column_width;
	
	if(is_active_sidebar('copyright_footer')) {
		echo '<div class="vc_col-sm-' . $footer_column_width . ' vc_column_container copyright-footer">
		<div class="vc_column-inner">';
		dynamic_sidebar('copyright_footer');
		echo '</div>
		</div>';
	}
}
				do_action('joints_before_footer'); ?>
					
				<footer class="site-footer" role="contentinfo">
					
					<div class="inner-footer grid-x grid-margin-x grid-padding-x">
						
						<?php
						do_action('joints_inner_footer');
						?>
					
					</div> <!-- end #inner-footer -->
				
				</footer> <!-- end .footer -->

				<?php do_action('joints_after_footer'); ?>

			</div>  <!-- end .off-canvas-content -->
					
		</div> <!-- end .off-canvas-wrapper -->
		
		<?php wp_footer(); ?>
		
	</body>
	
</html> <!-- end page -->