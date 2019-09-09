<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/******************** EVENT SLIDER SETTINGS ******************************************/
$event_settings = event_get_theme_options();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider Settings', 'event' ),
	'priority' => 140,
	'panel' => 'event_featuredcontent_panel'
));
$wp_customize->add_setting( 'event_theme_options[event_enable_slider]', array(
	'default' => $event_settings['event_enable_slider'],
	'sanitize_callback' => 'event_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_enable_slider]', array(
	'priority'=>10,
	'label' => __('Enable Slider', 'event'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'frontpage' => __('Front Page','event'),
		'enitresite' => __('Entire Site','event'),
		'disable' => __('Disable Slider','event'),
	),
));
$wp_customize->add_setting('event_theme_options[event_secondary_text]', array(
	'default' =>$event_settings['event_secondary_text'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_secondary_text]', array(
	'priority' =>20,
	'label' => __('Secondary Button Text', 'event'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting('event_theme_options[event_secondary_url]', array(
	'default' =>$event_settings['event_secondary_url'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_secondary_url]', array(
	'priority' =>30,
	'label' => __('Secondary Button Url', 'event'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'event_theme_options[event_animation_effect]', array(
	'default' => $event_settings['event_animation_effect'],
	'sanitize_callback' => 'event_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_animation_effect]', array(
	'priority'=>40,
	'label' => __('Animation Effect', 'event'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'slide' => __('Slide','event'),
		'fade' => __('Fade','event'),
	),
));
$wp_customize->add_setting( 'event_theme_options[event_slideshowSpeed]', array(
	'default' => $event_settings['event_slideshowSpeed'],
	'sanitize_callback' => 'event_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_slideshowSpeed]', array(
	'priority'=>50,
	'label' => __('Set the speed of the slideshow cycling', 'event'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'event_theme_options[event_animationSpeed]', array(
	'default' => $event_settings['event_animationSpeed'],
	'sanitize_callback' => 'event_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_animationSpeed]', array(
	'priority'=>60,
	'label' => __(' Set the speed of animations', 'event'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting( 'event_theme_options[event_direction]', array(
	'default' => $event_settings['event_direction'],
	'sanitize_callback' => 'event_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_direction]', array(
	'priority'=>70,
	'label' => __(' Controls the animation direction', 'event'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'horizontal' => __('Horizontal','event'),
		'vertical' => __('Vertical','event'),
	),
));
$wp_customize->add_setting('event_theme_options[event_slider_content_bg_color]', array(
	'default' =>$event_settings['event_slider_content_bg_color'],
	'sanitize_callback' => 'event_sanitize_select',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_slider_content_bg_color]', array(
	'priority' =>80,
	'label' => __('Slider Content With background color', 'event'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'on' => __('Show Background Color','event'),
	'off' => __('Hide Background Color','event'),
	),
));