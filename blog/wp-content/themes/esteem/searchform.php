<?php
/**
 * Displays the searchform of the theme.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="search-form" class="searchform clearfix" method="get">
	<div class="search-wrap">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'esteem' ); ?>" class="s field" name="s">
		<button type="submit"><?php _e( 'Search', 'esteem' ); ?></button>
	</div>
	<input type="submit" value="<?php esc_attr_e( 'Search', 'esteem' ); ?>" id="search-submit" name="submit" class="submit">
</form><!-- .searchform -->