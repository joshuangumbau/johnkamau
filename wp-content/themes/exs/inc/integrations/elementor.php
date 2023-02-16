<?php
/**
 * Elementor extended support
 *
 * @package WordPress
 * @subpackage ExS
 * @since 2.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//add Customizer Elementor section
add_filter( 'exs_customizer_options', 'exs_filter_exs_customizer_options_elementor' );
if ( ! function_exists( 'exs_filter_exs_customizer_options_elementor' ) ) :
	function exs_filter_exs_customizer_options_elementor( $options ) {

		//section
		$options['section_elementor']   = array(
			'type'        => 'section',
			'label'       => esc_html__( 'ExS Elementor Options', 'exs' ),
			'description' => esc_html__( 'Set your Elementor plugin additional theme', 'exs' ),
		);

		//enable Elementor styles and extensions
		$options['exs_elementor_enable'] = array(
			'type'        => 'checkbox',
			'section'     => 'section_elementor',
			'default'     => exs_option( 'exs_elementor_enable', '' ),
			'label'       => esc_html__( 'Enable Elementor ExS Addons', 'exs' ),
			'description' => esc_html__( 'If enabled - additional Elementor styling and functionality will be loaded', 'exs' ),
		);

		//enable Elementor styles and extensions
		$options['elementor_add_heading_styles'] = array(
			'type'        => 'checkbox',
			'section'     => 'section_elementor',
			'default'     => exs_option( 'elementor_add_heading_styles', '' ),
			'label'       => esc_html__( 'Enable Elementor Headings Styles Inheritance', 'exs' ),
			'description' => esc_html__( 'If enabled - theme Customizer typography settings will be used for default styling Elementor heading widget.', 'exs' ),
		);

		return $options;
	}
endif;

//Our Customizer option to filter headings in headeng widget
if ( ! function_exists( 'exs_fliter_heading_inline_styles_add_elementor_heading_widget_styles' ) ) :
	function exs_fliter_heading_inline_styles_add_elementor_heading_widget_styles( $styles ) {
		if ( ! exs_option( 'elementor_add_heading_styles') ) {
			return $styles;
		}
		//adding elementor heading title to an appropriate heading selector
		$styles = str_replace( 'h1', 'h1,h1.elementor-heading-title', $styles );
		$styles = str_replace( 'h2', 'h2,h2.elementor-heading-title', $styles );
		$styles = str_replace( 'h3', 'h3,h3.elementor-heading-title', $styles );
		$styles = str_replace( 'h4', 'h4,h4.elementor-heading-title', $styles );
		$styles = str_replace( 'h5', 'h5,h5.elementor-heading-title', $styles );
		$styles = str_replace( 'h6', 'h6,h6.elementor-heading-title', $styles );

		return $styles;
	}
endif;
add_filter( 'exs_typography_inline_styles_string', 'exs_fliter_heading_inline_styles_add_elementor_heading_widget_styles' );

if ( exs_option( 'exs_elementor_enable' ) ) {
	require_once EXS_THEME_PATH . '/inc/integrations/elementor-addons.php';
}