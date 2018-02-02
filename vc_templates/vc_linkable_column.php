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
$style_id = get_unique_style_id();

$classes = array(
	'linkable_column', 
	esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ), 
	$el_class,
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'vc_column_container',
	$hover_anim,
	$hover_color,
	$width,
	$style_id,
);

if($hover_color === 'custom') {
	custom_hover_colors($atts, $style_id);
}

if(!empty($hover_anim)) {
	$classes[] = 'hover-anim';
}

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$classes[] = 'vc_col-has-fill';
}

$wrapper_attributes = array();

$class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$target = (isset($atts['link']) ? vc_build_link($atts['link']) : '');
$output .= '<' . (!empty($target['url']) ? 'a href="' . $target['url'] . '"' . (!empty($target['target']) ? ' target="' . $target['target'] . '"' : "") : "div") . ' ' . implode(' ', $wrapper_attributes) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</' . (!empty($target['url']) ? 'a' : "div") . '>';

echo $output;
