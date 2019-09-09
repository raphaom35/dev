<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
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

<div id="secondary">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="secondary">
  <?php }
	}?>
  <?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'event_main_sidebar' ); ?>
</div> <!-- #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'event_main_sidebar' );
			echo '</div><!-- #secondary -->';
		}
	}