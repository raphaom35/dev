<?php
/**
 * The template for displaying navigation.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$event_settings = event_get_theme_options();
if ( !class_exists( 'Jetpack') || class_exists( 'Jetpack') && !Jetpack::is_module_active( 'infinite-scroll' ) ){
	if ( function_exists('wp_pagenavi' ) ) :
		wp_pagenavi();
	else: 
	global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
		<ul class="default-wp-page clearfix">
			<li class="previous">
				<?php next_posts_link( esc_html__( '&laquo; Previous Page', 'event' ) ); ?>
			</li>
			<li class="next">
				<?php previous_posts_link( esc_html__( 'Next Page &raquo;', 'event' ) ); ?>
			</li>
		</ul>
		<?php  endif;
	endif;
}