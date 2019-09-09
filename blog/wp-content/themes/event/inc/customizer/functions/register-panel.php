<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/******************** EVENT CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'event_customize_register_wordpress_default' );
function event_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'event_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event WordPress Settings', 'event' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'event_customize_register_options');
function event_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'event_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event Theme Options', 'event' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'event_customize_register_frontpage_options');
function event_customize_register_frontpage_options( $wp_customize ) {
	$wp_customize->add_panel( 'event_frontpage_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event Fronpage Template', 'event' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'event_customize_register_featuredcontent' );
function event_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'event_featuredcontent_panel', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event Slider Options', 'event' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'event_customize_register_widgets' );
function event_customize_register_widgets( $wp_customize ) {
	$wp_customize->add_panel( 'widgets', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event Widgets', 'event' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'event_customize_register_colors' );
function event_customize_register_colors( $wp_customize ) {
	$wp_customize->add_panel( 'colors', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Event Colors', 'event' ),
		'description' => '',
	) );
}