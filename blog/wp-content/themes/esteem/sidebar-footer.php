<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'esteem_footer_sidebar_one' ) &&
	!is_active_sidebar( 'esteem_footer_sidebar_two' ) &&
	!is_active_sidebar( 'esteem_footer_sidebar_three' ) ){
	return;
}
?>
<div class="widget-wrap inner-wrap clearfix">
	<div class="tg-one-third">
		<?php
		// Calling the footer sidebar if it exists.
		if ( !dynamic_sidebar( 'esteem_footer_sidebar_one' ) ):
		endif;
		?>
	</div><!-- .tg-one-third -->

	<div class="tg-one-third">
		<?php
		// Calling the footer sidebar if it exists.
		if ( !dynamic_sidebar( 'esteem_footer_sidebar_two' ) ):
		endif;
		?>
	</div><!-- .tg-one-third -->

	<div class="tg-one-third tg-one-third-last">
		<?php
		// Calling the footer sidebar if it exists.
		if ( !dynamic_sidebar( 'esteem_footer_sidebar_three' ) ):
		endif;
		?>
	</div><!-- .last -->
</div><!-- .widget-wrap -->
