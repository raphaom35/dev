<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */

get_header(); ?>

	<?php do_action( 'esteem_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<section class="error-404 not-found">
				<div class="page-content">
						<header class="page-header">
							<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'esteem' ); ?></h2>
						</header>
						<p><?php _e( 'It looks like nothing was found at this location. Try the search below.', 'esteem' ); ?></p>
						<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- #content -->
	</div><!-- #primary -->

	<?php esteem_sidebar_select(); ?>

	<?php do_action( 'esteem_after_body_content' ); ?>

<?php get_footer(); ?>
