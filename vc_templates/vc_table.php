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

$vc_custom_styles = (!empty($vc_custom_styles) ? $vc_custom_styles : "");
	$style_id = 'vc-' . preg_replace("/\./", '', uniqid('', true));
	while(strpos($vc_custom_styles, $style_id) !== false) {
		$style_id = 'vc-' . preg_replace("/\./", '', uniqid('', true));
	}

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'vc_table',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$styles_arr = array();

if(!empty($border_collapse)) {
	$styles_arr[] = 'border-collapse: ' . $border_collapse . " ";
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$classes = array(esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ), $el_class, $css_class);
$output .= '<table class="' . implode(' ', $classes) . '" style="' . implode(' ', $styles_arr) . '">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</table>';

echo $output;
