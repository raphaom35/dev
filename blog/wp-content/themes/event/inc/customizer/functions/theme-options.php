<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$event_settings = event_get_theme_options();
/********************  EVENT THEME OPTIONS ******************************************/
	$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'event'),
	'priority' => 10,
	'panel' => 'event_wordpress_default_panel'
	));
	$wp_customize->add_setting('event_theme_options[event_header_display]', array(
		'capability' => 'edit_theme_options',
		'default' => $event_settings['event_header_display'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('event_theme_options[event_header_display]', array(
		'label' => __('Site Logo/ Text Options', 'event'),
		'priority' => 102,
		'section' => 'title_tagline',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'header_text' => __('Display Site Title Only','event'),
			'header_logo' => __('Display Site Logo Only','event'),
			'show_both' => __('Show Both','event'),
			'disable_both' => __('Disable Both','event'),
		),
	));
	$wp_customize->add_section('header_image', array(
	'title' => __('Header Image', 'event'),
	'priority' => 20,
	'panel' => 'event_wordpress_default_panel'
	));
	$wp_customize->add_setting('event_theme_options[event_header_image_display]', array(
		'default' => $event_settings['event_header_image_display'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('event_theme_options[event_header_image_display]', array(
		'priority' =>10,
		'label' => __('Display Header Image', 'event'),
		'section' => 'header_image',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'top' => __('Top of the Page ','event'),
			'bottom' => __('Below Information Section','event'),
		),
	));
	$wp_customize->add_section('event_custom_header', array(
		'title' => __('Event Options', 'event'),
		'priority' => 503,
		'panel' => 'event_options_panel'
	));
	$wp_customize->add_setting( 'event_theme_options[event_search_custom_header]', array(
		'default' => $event_settings['event_search_custom_header'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_search_custom_header]', array(
		'priority'=>20,
		'label' => __('Disable Search Form', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_stick_menu]', array(
		'default' => $event_settings['event_stick_menu'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_stick_menu]', array(
		'priority'=>30,
		'label' => __('Disable Stick Menu', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_scroll]', array(
		'default' => $event_settings['event_scroll'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_scroll]', array(
		'priority'=>40,
		'label' => __('Disable Goto Top', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_top_social_icons]', array(
		'default' => $event_settings['event_top_social_icons'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_top_social_icons]', array(
		'priority'=>40,
		'label' => __('Disable Top Social Icons', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_buttom_social_icons]', array(
		'default' => $event_settings['event_buttom_social_icons'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_buttom_social_icons]', array(
		'priority'=>40,
		'label' => __('Disable Buttom Social Icons', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_hide_event_archive]', array(
		'default' => $event_settings['event_hide_event_archive'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_hide_event_archive]', array(
		'priority'=>45,
		'label' => __('Hide Event Archive title', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'event_theme_options[event_reset_all]', array(
		'default' => $event_settings['event_reset_all'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'event_reset_alls',
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting( 'event_theme_options[event_display_page_featured_image]', array(
		'default' => $event_settings['event_display_page_featured_image'],
		'sanitize_callback' => 'event_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'event_theme_options[event_display_page_featured_image]', array(
		'priority'=>48,
		'label' => __('Display Page Featured Image', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'event_theme_options[event_reset_all]', array(
		'priority'=>50,
		'label' => __('Reset all default settings. (Refresh it to view the effect)', 'event'),
		'section' => 'event_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_section( 'event_custom_css', array(
		'title' => __('Enter your custom CSS', 'event'),
		'priority' => 507,
		'panel' => 'event_options_panel'
	));
	$wp_customize->add_setting( 'event_theme_options[event_custom_css]', array(
		'default' => $event_settings['event_custom_css'],
		'sanitize_callback' => 'event_sanitize_custom_css',
		'type' => 'option',
		)
	);
	$wp_customize->add_control( 'event_theme_options[event_custom_css]', array(
		'label' => __('Custom CSS','event'),
		'section' => 'event_custom_css',
		'type' => 'textarea'
		)
	);
	$wp_customize->add_section('event_footer_image', array(
		'title' => __('Footer Background Image', 'event'),
		'priority' => 510,
		'panel' => 'event_options_panel'
	));
	$wp_customize->add_setting( 'event_theme_options[event-img-upload-footer-image]',array(
		'default'	=> $event_settings['event-img-upload-footer-image'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'event_theme_options[event-img-upload-footer-image]', array(
		'label' => __('Footer Background Image','event'),
		'description' => __('Image will be displayed on footer','event'),
		'priority'	=> 50,
		'section' => 'event_footer_image',
		)
	));
/********************** EVENT WORDPRESS DEFAULT PANEL ***********************************/
	$wp_customize->add_section('colors', array(
	'title' => __('Colors', 'event'),
	'priority' => 30,
	'panel' => 'event_wordpress_default_panel'
	));
	$wp_customize->add_section('background_image', array(
	'title' => __('Background Image', 'event'),
	'priority' => 40,
	'panel' => 'event_wordpress_default_panel'
	));
	$wp_customize->add_section('nav', array(
	'title' => __('Navigation', 'event'),
	'priority' => 50,
	'panel' => 'event_wordpress_default_panel'
	));
	$wp_customize->add_section('static_front_page', array(
	'title' => __('Static Front Page', 'event'),
	'priority' => 60,
	'panel' => 'event_wordpress_default_panel'
	));