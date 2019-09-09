<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

get_header(); 
$blog_id = get_option( 'page_for_posts' );
$edsbootstrap_options = get_theme_mod( 'edsbootstrap_theme_options' );
?>

<!-- Section: Page Header -->
<section class="section-page-header">
    <div class="container">
        <div class="row">

            <!-- Page Title -->
            <div class="col-md-12">
				<?php if( ! empty( $blog_id ) ): ?>
                    <h1 class="title"><?php echo esc_html ( get_the_title($blog_id) ); ?></h1>
					<?php if ( function_exists( 'the_subtitle' ) ) { ?>
                    	<div class="subtitle"><?php the_subtitle();?></div>
                    <?php }?>
                <?php else : ?>
                	
                    <h1 class="title"> <?php esc_html_e('Blog - Posts List', 'edsbootstrap');?></h1>
                    <div class="subtitle">  <?php esc_html_e('There are many variations of passages', 'edsbootstrap');?> </div>
                  
                <?php endif;?>
            </div>
            <!-- /Page Title -->

        </div>
    </div>
</section>
<!-- /Section: Page Header -->

<!-- Main -->
<main class="main-container">
    <div class="container">
        <div class="row">
            <!-- Blog Content -->
            <div class="col-md-9">
            	 
                
				<?php
                if ( have_posts() ) :
                
				echo '<div class="posts-list">';
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );
                
                endwhile;
				echo ' </div>';
				
              
				
				the_posts_pagination( array(
					'format' => '/page/%#%',
					'type' => 'list',
					'mid_size' => 2,
					'prev_text' => __( 'Previous', 'edsbootstrap' ),
					'next_text' => __( 'Next', 'edsbootstrap' ),
					'screen_reader_text' => __( '&nbsp;', 'edsbootstrap' ),
				) );
				
                
                else :
                
                get_template_part( 'template-parts/content', 'none' );
                
                endif; ?>
                
               
            </div>
            <!-- /Blog Content -->
            
            <!-- Blog Sidebar -->
            <div class="col-md-3">
            	<?php get_sidebar(); ?>
            </div>
            <!-- /Blog Sidebar -->
        </div>
    </div>
</main>
<!-- /Main -->

<?php
get_footer();
