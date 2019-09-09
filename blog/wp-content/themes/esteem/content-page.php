<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'esteem_before_post_content' ); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array( 
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'esteem' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div><!-- .entry-content -->
	
	<?php
	do_action( 'esteem_after_post_content' );
   ?>
</article><!-- #post -->