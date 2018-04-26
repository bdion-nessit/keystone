<?php
$args_arr = array();
$args_arr[] = array(
		'name' => 'Top sidebar',
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
		'description'   => 'A widget area for the mobile site',
		'before' => '<div class="mobile-menu>',
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
/**
$args_arr[] = array(
		'name' => 'Copyright Footer',
		'id' => 'footer-sidebar-4',
		'description'   => 'A footer area for copyright information and the like',
		'before' => '<div class="copyright-footer large-12 medium-12">',
		'after' => '</div>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
);
*/

foreach($args_arr as $args) {
	register_sidebar( $args );
}
