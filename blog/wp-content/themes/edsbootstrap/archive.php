<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

get_header(); ?>

	<!-- Section: Page Header -->
<section class="section-page-header">
    <div class="container">
        <div class="row">

            <!-- Page Title -->
            <div class="col-md-12">
				<?php
					the_archive_title( '<h1 class="page-title title">', '</h1>' );
					the_archive_description( '<div class="archive-description subtitle">', '</div>' );
                ?>
                 
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
