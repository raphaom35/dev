<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                    <h1 class="title"><?php echo esc_html ( get_the_title() );?></h1>
                    <?php if ( function_exists( 'the_subtitle' ) ) { ?>
                    	<div class="subtitle"><?php the_subtitle();?></div>
                    <?php }?>
                   
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
                while ( have_posts() ) : the_post();
        
                    get_template_part( 'template-parts/single', get_post_format() );
        
        
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
        
                endwhile; // End of the loop.
                ?>
			</div>
            <!--/ Blog Content -->
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
get_sidebar();
get_footer();
