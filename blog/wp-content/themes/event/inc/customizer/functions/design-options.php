<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$event_settings = event_get_theme_options();
/******************** EVENT LAYOUT OPTIONS ******************************************/
	$wp_customize->add_section('event_layout_options', array(
		'title' => __('Layout Options', 'event'),
		'priority' => 102,
		'panel' => 'event_options_panel'
	));
	$wp_customize->add_setting('event_theme_options[event_responsive]', array(
		'default' => $event_settings['event_responsive'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('event_theme_options[event_responsive]', array(
		'priority' =>10,
		'label' => __('Responsive Layout', 'event'),
		'section' => 'event_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'on' => __('ON ','event'),
			'off' => __('OFF','event'),
		),
	));
	$wp_customize->add_setting('event_theme_options[event_blog_layout]', array(
		'default' => $event_settings['event_blog_layout'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('event_theme_options[event_blog_layout]', array(
		'priority' =>30,
		'label' => __('Blog Layout', 'event'),
		'section'    => 'event_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'large_image_display' => __('Blog with large Image','event'),
			'medium_image_display' => __('Blog with small Image','event'),
			'two_column_image_display' => __('Blog with Two Column','event'),
		),
	));
	$wp_customize->add_setting( 'event_theme_options[event_entry_format_blog]', array(
		'default' => $event_settings['event_entry_format_blog'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_entry_format_blog]', array(
		'priority'=>40,
		'label' => __('Disable Entry Format from Blog Page', 'event'),
		'section' => 'event_layout_options',
		'type' => 'select',
		'choices' => array(
		'show' => __('Display Entry Format','event'),
		'hide' => __('Hide Entry Format','event'),
		'show-button' => __('Show Button Only','event'),
		'hide-button' => __('Hide Button Only','event'),
	),
	));
	$wp_customize->add_setting( 'event_theme_options[event_entry_meta_blog]', array(
		'default' => $event_settings['event_entry_meta_blog'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_entry_meta_blog]', array(
		'priority'=>45,
		'label' => __('Disable Entry Meta from Blog Page', 'event'),
		'section' => 'event_layout_options',
		'type'	=> 'select',
		'choices' => array(
		'show-meta' => __('Display Entry Meta','event'),
		'hide-meta' => __('Hide Entry Meta','event'),
	),
	));
	$wp_customize->add_setting('event_theme_options[event_design_layout]', array(
		'default'        => $event_settings['event_design_layout'],
		'sanitize_callback' => 'event_sanitize_select',
		'type'                  => 'option',
	));
	$wp_customize->add_control('event_theme_options[event_design_layout]', array(
	'priority'  =>50,
	'label'      => __('Design Layout', 'event'),
	'section'    => 'event_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'wide-layout' => __('Full Width Layout','event'),
		'boxed-layout' => __('Boxed Layout','event'),
		'small-boxed-layout' => __('Small Boxed Layout','event'),
	),
));