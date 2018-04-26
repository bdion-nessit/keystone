<?php 
add_action('joints_inner_footer', 'do_footer_sidebar_1', 6);
add_action('joints_inner_footer', 'do_footer_sidebar_2', 6);
add_action('joints_inner_footer', 'do_footer_sidebar_3', 6);
add_action('joints_inner_footer', 'do_footer_sidebar_4', 6);

function do_footer_sidebar_1() {
	if(is_active_sidebar('footer-sidebar-1')) {
		echo '<div class="vc_col-sm-6 vc_column_container footer-sidebar-1 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-1');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_2() {
	if(is_active_sidebar('footer-sidebar-2')) {
		echo '<div class="vc_col-sm-6 vc_column_container footer-sidebar-2 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-2');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_3() {
	if(is_active_sidebar('footer-sidebar-3')) {
		echo '<div class="vc_col-sm-6 vc_column_container footer-sidebar-3 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-3');
		echo '</div>
		</div>';
	}
}
function do_footer_sidebar_4() {
	if(is_active_sidebar('footer-sidebar-4')) {
		echo '<div class="vc_col-sm-6 vc_column_container footer-sidebar-4 footer-sidebar">
			<div class="vc_column-inner">';
		dynamic_sidebar('footer-sidebar-4');
		echo '</div>
		</div>';
	}
}

				do_action('joints_before_footer'); ?>
				<footer class="site-footer" role="contentinfo">
					<div id="inner-footer" class="row">
					<?php
					do_action('joints_inner_footer');
					?>
						
						
					</div> <!-- end #inner-footer -->
				</footer> <!-- end .footer -->
				<?php do_action('joints_after_footer'); ?>
			</div>  <!-- end .main-content -->
		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->