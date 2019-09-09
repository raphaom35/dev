<?php
/**
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
?>
<?php
/************************* EVENT FOOTER DETAILS **************************************/

function event_site_footer() {
if ( is_active_sidebar( 'event_footer_options' ) ) :
		dynamic_sidebar( 'event_footer_options' );
	else:
		echo '<div class="copyright">' .'&copy; ' . date('Y') .' '; ?>
		<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
						<?php esc_html_e('Designed by:','event'); ?> <a title="<?php echo esc_attr__( 'Theme Freesia', 'event' ); ?>" target="_blank" href="<?php echo esc_url( 'https://themefreesia.com' ); ?>"><?php esc_html_e('Theme Freesia','event');?></a> | 
						<?php esc_html_e('Powered by:','event'); ?> <a title="<?php echo esc_attr__( 'WordPress', 'event' );?>" target="_blank" href="<?php echo esc_url( 'https://wordpress.org' );?>"><?php esc_html_e('WordPress','event'); ?></a>
					</div>
	<?php endif;
}
add_action( 'event_sitegenerator_footer', 'event_site_footer');