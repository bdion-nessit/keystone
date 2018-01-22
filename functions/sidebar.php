<?php
// SIDEBARS AND WIDGETIZED AREAS
function joints_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'jointswp'),
		'description' => __('The first (primary) sidebar.', 'jointswp'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'jointswp'),
		'description' => __('The offcanvas sidebar.', 'jointswp'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
	//Custom Sidebars
	$args_arr = array();
	$args_arr[] = array(
			'name' => 'Topbar',
			'id' => 'top_sidebar',
			'description'   => 'A widget area for the top of the page',
			'before' => '<div class="top-sidebar>',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);
	
	$args_arr[] = array(
			'name' => 'Mobile Menu',
			'id' => 'mobile_menu',
			'description'   => 'A widget area for mobile browsers',
			'before' => '<div class="mobile-menu">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	$args_arr[] = array(
			'name' => 'Footer sidebar 1',
			'id' => 'footer-sidebar-1',
			'description'   => 'A sidebar for the footer area',
			'before' => '<div class="footer-widgets-1 large-3 medium-6">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	$args_arr[] = array(
			'name' => 'Footer sidebar 2',
			'id' => 'footer-sidebar-2',
			'description'   => 'A sidebar for the footer area',
			'before' => '<div class="footer-widgets-2 large-3 medium-6">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	$args_arr[] = array(
			'name' => 'Footer sidebar 3',
			'id' => 'footer-sidebar-3',
			'description'   => 'A sidebar for the footer area',
			'before' => '<div class="footer-widgets-3 large-3 medium-6">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	$args_arr[] = array(
			'name' => 'Footer sidebar 4',
			'id' => 'footer-sidebar-4',
			'description'   => 'A sidebar for the footer area',
			'before' => '<div class="footer-widgets-4 large-3 medium-6">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	$args_arr[] = array(
			'name' => 'Copyright Footer',
			'id' => 'copyright_footer',
			'description'   => 'A footer area for copyright information and the like',
			'before' => '<div class="copyright-footer large-12 medium-12">',
			'after' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
	);

	foreach($args_arr as $args) {
		register_sidebar( $args );
	}


	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'jointswp'),
		'description' => __('The second (secondary) sidebar.', 'jointswp'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!