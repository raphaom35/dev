<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/**************** EVENT REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'event_widgets_init');
function event_widgets_init() {
	register_widget( "event_contact_widgets" );

	register_sidebar(array(
			'name' => __('Main Sidebar', 'event'),
			'id' => 'event_main_sidebar',
			'description' => __('Shows widgets at Main Sidebar.', 'event'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Display Contact Info at Header ', 'event'),
			'id' => 'event_header_info',
			'description' => __('Shows widgets on all page.', 'event'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
		));
	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'event'),
			'id' => 'event_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'event'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Shortcode For Contact Page', 'event'),
			'id' => 'event_form_for_contact_page',
			'description' => __('Add Contact Form 7 Shortcode using text widgets Ex: [contact-form-7 id="137" title="Contact form 1"]', 'event'),
			'before_widget' => '<div id="A%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'event'),
			'id' => 'event_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'event'),
			'before_widget' => '<div id="A%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	$event_settings = event_get_theme_options();
	for($i =1; $i<= $event_settings['event_footer_column_section']; $i++){
	register_sidebar(array(
			'name' => __('Footer Column ', 'event') . $i,
			'id' => 'event_footer_'.$i,
			'description' => __('Shows widgets at Footer Column ', 'event').$i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
}