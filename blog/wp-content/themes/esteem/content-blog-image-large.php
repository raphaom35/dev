<?php
/**
 * The template used for displaying blog image large post.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'esteem_before_post_content' ); ?>
	<?php
		if( has_post_thumbnail() ) {
			$image = '';
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-large');
     		$title_attribute = the_title_attribute( 'echo=0' );
     		$image .= '<figure class="post-featured-image">';
  			$image .= '<a href="' . get_permalink() . '" title="'.the_title_attribute( 'echo=0' ).'">';
  			$image .= get_the_post_thumbnail( $post->ID, 'blog-large', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
  			$image .= '<div class="mask">
  						<div class="image-icon-wrap">
  							<a href="'.$large_image_url[0].'" class="img-icon img-search"><i class="icon-search"></i></a>
  							<a href="'.get_permalink().'" class="img-icon img-link"><i class="icon-link"></i></a>
  						</div>
  					</div>';
  			$image .= '</figure>';

  			echo $image;
  		}
	?>
	<div class="blog-content">
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
			</h2><!-- .entry-title -->
		</header>

		<?php esteem_entry_meta(); ?>

		<div class="entry-content clearfix">
			<?php the_excerpt(); ?>
			<div class="readmore-wrap"><a class="readmore" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'esteem' ); ?></a></div>
		</div><!-- .entry-content -->
	</div>

	<?php do_action( 'esteem_after_post_content' ); ?>
</article>