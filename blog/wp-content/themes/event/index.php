<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
					$event_stickies = get_option('sticky_posts');
					if( $event_stickies ) {
					   $event_args = array( 'ignore_sticky_posts' => 1, 'post__not_in' => $event_stickies, 'category__in' => $event_settings['event_categories'] );
					   query_posts( array_merge($wp_query->query, $event_args) );
					}
					if( have_posts() ) {
						while(have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() );
						}
					}
					else { ?>
					<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'event' ); ?> </h2>
					<?php } ?>
				</div> <!-- #main -->
				<?php get_template_part( 'pagination', 'none' ); ?>
	<?php
	if( 'default' == $layout ) { //Settings from customizer
		if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')): ?>
			</div> <!-- #primary -->
			<?php endif;
	}
get_sidebar();
get_footer();