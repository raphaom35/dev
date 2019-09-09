<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
			
                    <h1 class="title"><?php /* translators: used between list items, there is a space after the comma */ printf( esc_html__( 'Search Results for: %s', 'edsbootstrap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                
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
                
					/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

                
                endwhile;
				echo ' </div>';
				
              
				if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
					the_posts_navigation();
				else :
					the_posts_pagination( array(
						'format' => '/page/%#%',
						'type' => 'list',
						'mid_size' => 2,
						'prev_text' => __( 'Previous', 'edsbootstrap' ),
						'next_text' => __( 'Next', 'edsbootstrap' ),
						'screen_reader_text' => __( '&nbsp;', 'edsbootstrap' ),
					) );
				endif;
                
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
