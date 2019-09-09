<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

?>

<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	
	
		<?php
		if ( is_single() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
	

	<div class="entry-content content">
		<?php
		the_excerpt();
		?>
	</div><!-- .entry-content -->
 
    <!-- Read More Button -->
        <div>
             <a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-theme"><?php esc_html_e('Continue Reading', 'edsbootstrap'); ?> <i class="fa fa-fw fa-angle-double-right"></i></a>
        </div>
    <!-- /Read More Button -->

</article><!-- #post-## -->


