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

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
////////
//Tabs//
////////
//Create new Tab styles sections
//to remove unneeded sections we can use same action but 'before_section_end' at the end
add_action( 'elementor/element/tabs/section_tabs_style/after_section_end', function( $element ) {

	//Modify title
	$element->start_controls_section(
		'section_tabs_title_style',
		[
			'label' => esc_html__( 'Title', 'exs' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$element->add_responsive_control(
		'title_nav_padding',
		[
			'label' => esc_html__( 'Title Nav Bar Padding', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'title_background_color',
		[
			'label' => esc_html__( 'Background Color', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};',
			],
		]
	);
	$element->add_control(
		'title_active_background_color',
		[
			'label' => esc_html__( 'Active Background Color', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
			],
		]
	);
	$element->add_control(
		'title_active_border_color',
		[
			'label' => esc_html__( 'Active Border Color', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}};',
			],
		]
	);
	$element->add_responsive_control(
		'title_padding',
		[
			'label' => esc_html__( 'Title Padding', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'title_border',
			'selector' => '{{WRAPPER}} .elementor-tab-title',
		]
	);
	$element->add_responsive_control(
		'title_border_radius',
		[
			'label' => esc_html__( 'Title Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'title_box_shadow',
			'selector' => '{{WRAPPER}} .elementor-tab-title',
		]
	);
	$element->end_controls_section();

	//Modify content
	$element->start_controls_section(
		'section_tabs_content_style',
		[
			'label' => esc_html__( 'Content', 'exs' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$element->add_responsive_control(
		'content_margin',
		[
			'label' => esc_html__( 'Content Margin', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tabs-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'content_background_color',
		[
			'label' => esc_html__( 'Background Color', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-content' => 'background-color: {{VALUE}};',
			],
		]
	);
	$element->add_responsive_control(
		'content_padding',
		[
			'label' => esc_html__( 'Content Padding', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'content_border',
			'selector' => '{{WRAPPER}} .elementor-tab-content',
		]
	);
	$element->add_responsive_control(
		'content_border_radius',
		[
			'label' => esc_html__( 'Content Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .elementor-tabs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'content_box_shadow',
			'selector' => '{{WRAPPER}} .elementor-tab-content',
		]
	);
	$element->end_controls_section();
} );

///////////
//Counter//
///////////
//Extend Counter Number
add_action( 'elementor/element/counter/section_number/before_section_end', function( $element ) {
	$element->add_control(
		'prefix_grow',
		[
			'label' => esc_html__( 'Prefix Grow', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [''],
			'default' => [
				'unit' => '',
				'size' => 1,
			],
			'range' => [
				'' => [
					'min' => 0,
					'max' => 10,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-counter-number-prefix' => 'flex-grow: {{SIZE}};',
			],
		]
	);
	$element->add_control(
		'suffix_grow',
		[
			'label' => esc_html__( 'Suffix Grow', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [''],
			'default' => [
				'unit' => '',
				'size' => 1,
			],
			'range' => [
				'' => [
					'min' => 0,
					'max' => 10,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-counter-number-suffix' => 'flex-grow: {{SIZE}};',
			],
		]
	);
} );
//Extend Counter Title
add_action( 'elementor/element/counter/section_title/before_section_end', function( $element ) {
	$element->add_control(
		'text_align',
		[
			'label' => esc_html__( 'Text Align', 'exs' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => esc_html__( 'Left', 'exs' ),
					'icon' => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'exs' ),
					'icon' => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'exs' ),
					'icon' => 'eicon-text-align-right',
				],
				'justify' => [
					'title' => esc_html__( 'Justified', 'exs' ),
					'icon' => 'eicon-text-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-counter-title' => 'text-align: {{VALUE}};',
			],
		]
	);
} );

/////////////
//Icon List//
/////////////
//Extend Icon List Icon Options
add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function( $element ) {
	$element->add_responsive_control(
		'icon_padding',
		[
			'label' => esc_html__( 'Icon Padding', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'icon_spacing',
		[
			'label' => esc_html__( 'Spacing', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 60,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'icon_border',
			'selector' => '{{WRAPPER}} .elementor-icon-list-icon',
		]
	);
	$element->add_responsive_control(
		'border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'icon_background_color',
		[
			'label' => esc_html__( 'Background Color', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-list-icon' => 'background-color: {{VALUE}};',
			],
		]
	);
} );

//////////
//Toggle//
//////////
//Extend Toggle Widget Icon
add_action( 'elementor/element/toggle/section_toggle_style_icon/before_section_end', function( $element ) {
	$element->add_control(
		'icon_size',
		[
			'label' => esc_html__( 'Size', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
} );
//Extend Toggle Widget Panel
add_action( 'elementor/element/toggle/section_toggle_style/before_section_end', function( $element ) {
	//remove
	$element->remove_control( 'border_width' );
	$element->remove_control( 'border_color' );

	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'border',
			'selector' => '{{WRAPPER}} .elementor-toggle-item',
		]
	);

	$element->add_responsive_control(
		'border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-toggle-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
} );

/////////////
//Accordion//
/////////////
//Extend Accordion Widget Icon
add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', function( $element ) {
	$element->add_control(
		'icon_size',
		[
			'label' => esc_html__( 'Size', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
} );
//Extend Accordion Widget Panel
add_action( 'elementor/element/accordion/section_title_style/before_section_end', function( $element ) {
	//remove
	$element->remove_control( 'border_width' );
	$element->remove_control( 'border_color' );

	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'border',
			'selector' => '{{WRAPPER}} .elementor-accordion-item',
		]
	);

	$element->add_responsive_control(
		'border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'box_shadow',
			'selector' => '{{WRAPPER}} .elementor-accordion-item',
		]
	);

	$element->add_responsive_control(
		'margin_bottom',
		[
			'label' => esc_html__( 'Spacing', 'exs' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		]
	);
} );
//Extend Accordion Title Panel
add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function( $element ) {
	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'title_border',
			'selector' => '{{WRAPPER}} .elementor-tab-title',
		]
	);

	$element->add_responsive_control(
		'title_border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'exs' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->add_control(
		'title_active_heading',
		[
			'label' => esc_html__( 'Active State', 'exs' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
		]
	);

	$element->add_control(
		'title_active_background',
		[
			'label' => esc_html__( 'Active Background', 'exs' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
			],
		]
	);

	$element->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'title_active_border',
			'selector' => '{{WRAPPER}} .elementor-tab-title.elementor-active',
		]
	);
});

/////////////
//Container//
/////////////
//Extend Container Height because Spacer Height in percentage don't work
add_action( 'elementor/element/container/section_layout_container/before_section_end', function( $element ) {
	$element->update_control(
		'min_height',
		[
			'size_units' => [ 'px', 'vh', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1440,
				],
				'vh' => [
					'min' => 0,
					'max' => 100,
				],
				'%' => [
					'min' => 1,
					'max' => 100,
				],
			],
		]
	);
} );

//////////////////////////
//Our Custom CSS section//
//////////////////////////
//Add custom CSS controls
add_action('elementor/element/after_section_end', function ( $element, $section_id, $args ){
	if ( 'section_custom_css_pro' !== $section_id ) {
		return;
	}

	$element->start_controls_section(
		'exs_section_custom_css',
		[
			'label' =>  esc_html__('ExS Custom CSS', 'exs'),
			'tab' => Controls_Manager::TAB_ADVANCED
		]
	);

	$element->add_control(
		'exs_custom_css',
		[
			'type' => Controls_Manager::CODE,
			'show_label' => false,
			'language' => 'css',
			'render_type' => 'ui',
		]
	);

	$element->add_control(
		'exs_custom_css_description',
		[
			'raw' => esc_html__('Use "selector" keyword to target wrapper element.', 'exs'),
			'type' => Controls_Manager::RAW_HTML,
			'separator' => 'none',
		]
	);

	$element->end_controls_section();
}, 10, 3 );
//Print Custom CSS
add_action('elementor/element/parse_css', function ( $css_processor, $element ){

	$element_settings = $element->get_settings();

	if ( empty( $element_settings['exs_custom_css'] ) ) {
		return;
	}

	//clean up custom CSS
	$custom_css = trim( str_replace( ["\n", "\t"], '', $element_settings['exs_custom_css'] ) );

	if ( empty( $custom_css ) ) {
		return;
	}

	//changing wrapper. Adding '#box' to override existing styles if they exists
	$custom_css = str_replace('selector', '#box ' . $css_processor->get_element_unique_selector( $element ), $custom_css );

	$css_processor->get_stylesheet()->add_raw_css( $custom_css );

}, 10, 2 );
//Live Preview Custom CSS
//https://developers.elementor.com/docs/scripts-styles/editor-scripts/
if ( ! function_exists( 'exs_action_enqueue_elementor_editor_assets' ) ) :
	function exs_action_enqueue_elementor_editor_assets() {
		$min = ! EXS_DEV_MODE ? 'min/' : '';
		wp_enqueue_script(
			'exs-elementor-editor-script',
			EXS_THEME_URI . '/assets/js/' . $min . 'elementor.js',
			array( 'elementor-editor' ),
			EXS_THEME_VERSION,
			true
		);
	}
endif;
add_action( 'elementor/editor/after_enqueue_scripts', 'exs_action_enqueue_elementor_editor_assets' );
