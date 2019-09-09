<?php
/**
 * Implements a custom header for Esteem.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses esteem_header_style()
 * @uses esteem_admin_header_style()
 * @uses esteem_admin_header_image()
 *
 * @package esteem
 */
function esteem_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'esteem_custom_header_args', array(
		'default-image'				=> '',
		'default-text-color'		=> '',
		'width'						=> 1400,
		'height'					=> 400,
		'flex-width'				=> true,
		'flex-height'				=> true,
		'video'						=> true,
		'wp-head-callback'			=> '',
		'admin-head-callback'		=> '',
		'admin-preview-callback'	=> 'esteem_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'esteem_custom_header_setup' );

if ( ! function_exists( 'esteem_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function esteem_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( function_exists( 'the_custom_header_markup' ) ) {
			the_custom_header_markup();
		} else {
			if ( get_header_image() ) : ?>
				<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
			<?php endif;
		} ?>
	</div>
<?php
}
endif; // esteem_admin_header_image
