<?php
add_action('joints_nav', 'open_nav', 2);
add_action('joints_nav', 'close_element', 50);
add_action('joints_nav', 'joints_do_topbar');
add_action('joints_nav', 'joints_do_mobile_menu');
add_action('joints_nav', 'get_site_logo');

function open_nav() {
	?>
	<div class="site-nav">
	<?php
}
function get_site_logo() {
	echo '<a href="' . get_home_url() . '" class="site-logo"><img src="' . get_stylesheet_directory_uri() . '/images/logo.png" alt="' . get_bloginfo('name') . '" /><img src="' . get_stylesheet_directory_uri() . '/images/sticky_logo.png" alt="' . get_bloginfo('name') . '" /></a>';
}
function joints_do_topbar() {
	echo '<div class="top-sidebar">';
	dynamic_sidebar('top_sidebar'); 
	echo '</div>';
}
function joints_do_mobile_menu() {
	echo '<div class="mobile-menu">
		<div class="hamburger-menu-wrap">
			<div class="hamburger-menu"></div>
		</div>
		<div class="mobile-menu-inner">';
			dynamic_sidebar('mobile_menu'); 
	echo '</div>
	</div>';
}

add_filter('intro_class', 'initialize_classes_intro', 1);
add_filter('intro_class', 'do_classes_intro', 99);

function initialize_classes_intro() {
	return array('intro');
}
function do_classes_intro($classes) {
	echo 'class="' . implode(' ', $classes) . '"';
}

?>
<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">
		
		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	    	<meta name="theme-color" content="#121212">
	    <?php } ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

		<script src="https://use.typekit.net/vac3mxn.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>


	</head>
	
	<!-- Uncomment this line if using the Off-Canvas Menu --> 
		
	<body <?php body_class(); ?>>
		<div class="preload"></div>
		<div class="off-canvas-wrapper">
							
			<?php get_template_part( 'parts/content', 'offcanvas' ); ?>
			
			<div class="off-canvas-content" data-off-canvas-content>
				<?php do_action('joints_before_header'); ?>
				<header class="header" role="banner">
					<?php 

					do_action('joints_before_nav'); 

					do_action('joints_intro');

					do_action('joints_nav');

					do_action('joints_after_nav');

					 ?>
	 	
				</header> <!-- end .header -->
				<?php do_action('joints_after_header'); ?>