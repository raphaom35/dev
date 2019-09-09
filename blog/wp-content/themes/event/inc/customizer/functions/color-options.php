<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.1
 */
/********************* Color Option **********************************************/
	$wp_customize->add_section( 'colors', array(
		'title' 						=> __('Color Options','event'),
		'priority'					=> 90,
		'panel'					=>'colors'
	));
	$color_scheme = event_get_color_scheme();
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default_color',
		'sanitize_callback' => 'event_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'description'    => __( 'Select Color Style', 'event' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => event_get_color_scheme_choices(),
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'site_page_nav_link_title_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_page_nav_link_title_color', array(
		'description'       => __( 'Nav, links and Hover', 'event' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'event_button_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'event_button_color', array(
		'description'       => __( 'Buttons Reset/ Submit', 'event' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'event_feature_box_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'event_feature_box_color', array(
		'description'       => __( 'Our Feature Box', 'event' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'event_team_box_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'event_team_box_color', array(
		'description'       => __( ' Our Team Box', 'event' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'event_schedule_list_box_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'event_schedule_list_box_color', array(
		'description'       => __( 'Schedule List Box', 'event' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'event_bbpress_woocommerce_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'event_bbpress_woocommerce_color', array(
		'description'       => __( 'WooCommerce/ bbPress', 'event' ),
		'section'     => 'colors',
	) ) );