<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_id
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $el_id = $width = $css = $offset = $css_animation = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'multi-slide-wrap',
	'vc_column-inner',
	esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ),
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output .= ($show_featured === 'yes' ? '<div class="vc_row inner-row vc_row-o-equal-height vc_row-flex">
	<div class="slider-featured vc_col-sm-6 vc_column_container">
	</div>
	<div class="vc_col-sm-6 vc_column_container">
		<div class="vc_column-inner">' : '') .  
			'<div class="slider-info">' . 
				($show_title === 'yes' ? 
				'<p class="slide-title">
					<strong>Title</strong><br>
					<span></span>
				</p>' : '') . 
				($show_desc === 'yes' ? 
				'<p class="slide-description">
					<strong>Description</strong><br>
					<span></span>
				</p>' : '') . 
			'</div>
			<div ' . implode( ' ', $wrapper_attributes ) . '>
				<div class="wpb_wrapper multi-slider">';
$output .=  wpb_js_remove_wpautop( $content ) . 
'<div class="vc_row wpb_row vc_inner vc_row-fluid inner-row content-slider-controls">
	<div class="inner-column wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<div id="" class="content-slide-prev multi-prev content-slide-dir arrow-left arrow-left-blue widget custom_button" style="">
							<button></button>
						</div>
						<div class="content-slide-buttons"></div>
						<div id="" class="content-slide-next multi-next content-slide-dir arrow-left arrow-left-blue widget custom_button" style="">
							<button></button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>';
$output .= '</div>';
$output .= '</div>' . 
($show_featured === 'yes' ? '</div>
		</div>
	</div>' : '');

echo $output;

remove_action('wp_footer', 'get_multi_slider_scripts');
add_action('wp_footer', 'get_multi_slider_scripts');
