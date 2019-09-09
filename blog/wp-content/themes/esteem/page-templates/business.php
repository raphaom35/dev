<?php
/**
 * Template Name: Business Template
 *
 * Displays the Business Template of the theme.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */

get_header(); // Loads the header.php template. ?>


	<div id="content" class="site-content">
		<?php
		if( is_active_sidebar( 'esteem_business_page_sidebar' ) ) {
			// Calling the business page top section sidebar if it exists.
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'esteem_business_page_sidebar' ) ):
			endif;
		}
		?>
	</div><!-- content -->

<?php get_footer(); // Loads the footer.php template. ?>
