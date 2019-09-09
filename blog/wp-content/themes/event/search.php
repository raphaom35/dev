<?php
/**
 * The template for displaying search results.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
get_header();
	$event_settings = event_get_theme_options();
	global $event_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'event_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //Settings from customizer
		if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')){ ?>
		<div id="primary">
			<?php }
		}?>
		<div id="main" class="clearfix">
			<?php
			if( have_posts() ) {
				while( have_posts() ) {
					the_post();
					get_template_part( 'content', get_post_format() );
				}
			} else { ?>
			<h2 class="entry-title">
				<?php get_search_form(); ?>
				<p>&nbsp; </p>
				<?php esc_html_e( 'No Posts Found.', 'event' ); ?>
			</h2>
			<?php } ?>
		</div> <!-- #main -->
		<?php get_template_part( 'pagination', 'none' );
		if( 'default' == $layout ) { //Settings from customizer
			if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')): ?>
		</div> <!-- #primary -->
	<?php endif;
	}
get_sidebar();
get_footer();