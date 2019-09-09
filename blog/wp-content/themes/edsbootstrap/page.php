<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

get_header(); ?>

<!-- Section: Page Header -->
<section class="section-page-header page">
    <div class="container">
        <div class="row">

            <!-- Page Title -->
            <div class="col-md-12">
                <?php the_title( '<h1 class="title">', '</h1>' ); ?>
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
     	<?php if( get_theme_mod( 'edsbootstrap_show_page_sidebar','0') == 1 ):?> 
		<div class="col-md-9">
        <?php else: ?>
		<div class="col-md-12">
		<?php endif;?>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
        <?php if( get_theme_mod( 'edsbootstrap_show_page_sidebar','0') == 1 ):?> 
        <!-- Blog Sidebar -->
        <div class="col-md-3">
        	<?php echo get_sidebar();?>
        </div>
        <!-- Blog Sidebar -->
        <?php endif;?>
		</div>
    </div>
</main>
<!-- /Main -->
<?php

get_footer();
