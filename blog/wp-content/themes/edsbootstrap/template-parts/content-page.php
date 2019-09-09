<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) :?>
    <!-- Post Image -->
    <div class="image">
    	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );  ?>
        <a href="<?php echo esc_url($image[0]);?>" class="image-popup">
            <div class="gallery-image">
                <?php the_post_thumbnail();?>
            </div>
        </a>
    </div>
    <!-- /Post Image -->
     <?php endif;?>
	<div class="entry-content content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edsbootstrap' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'edsbootstrap' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
