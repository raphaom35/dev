<?php
/**
 * The left sidebar widget area.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>

<div id="secondary">
	<?php do_action( 'esteem_before_sidebar' ); ?>
		<?php 
			if( is_page_template( 'page-templates/contact.php' ) ) {
				$sidebar = 'esteem_contact_page_sidebar';
			}
			else {
				$sidebar = 'esteem_left_sidebar';
			}
		?>

		<?php if ( ! dynamic_sidebar( $sidebar ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget widget_archive">
				<h3 class="widget-title"><span><?php _e( 'Archives', 'esteem' ); ?></span></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget widget_meta">
				<h3 class="widget-title"><span><?php _e( 'Meta', 'esteem' ); ?></span></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; ?>
	<?php do_action( 'esteem_after_sidebar' ); ?>
</div>