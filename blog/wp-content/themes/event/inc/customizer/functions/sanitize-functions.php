<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/********************* EVENT CUSTOMIZER SANITIZE FUNCTIONS *******************************/
function event_checkbox_integer( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}
function event_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}
function event_sanitize_upcoming_select($input) {
	if ( $input != '' ) {
		return $input;
	}else{
		return '';
	}

}

function event_numeric_value( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function event_sanitize_custom_css( $input ) {
	if ( $input != '' ) { 
		$input = wp_strip_all_tags($input); 
		return $input;
	}
	else {
		return '';
	}
}
function event_sanitize_page( $input ) {
	if(  get_post( $input ) ){
		return $input;
	}
	else {
		return '';
	}
}
function event_reset_alls( $input ) {
	if ( $input == 1 ) {
		delete_option( 'event_theme_options');
		$input=0;
		return $input;
	} 
	else {
		return '';
	}
}