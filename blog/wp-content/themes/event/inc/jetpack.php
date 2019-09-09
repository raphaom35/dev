<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/*********** EVENT ADD THEME SUPPORT FOR INFINITE SCROLL **************************/
function event_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'event_jetpack_setup' );