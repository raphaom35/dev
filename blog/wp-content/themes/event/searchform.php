<?php
/**
 * Displays the searchform
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
?>
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$event_settings = event_get_theme_options();
		$event_search_form = $event_settings['event_search_text'];
		if($event_search_form !='Search &hellip;'): ?>
	<input type="search" name="s" class="search-field" placeholder="<?php echo esc_attr($event_search_form); ?>" autocomplete="off" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php else: ?>
	<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search &hellip;', 'event' ); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php endif; ?>
</form> <!-- end .search-form -->