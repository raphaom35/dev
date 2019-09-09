<?php
/**
 * The template used for displaying blog post full content.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'esteem_before_post_content' ); ?>
	<div class="blog-content">
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
			</h2><!-- .entry-title -->
		</header>

		<?php esteem_entry_meta(); ?>

		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</div>

	<?php do_action( 'esteem_after_post_content' ); ?>
</article>