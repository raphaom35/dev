<?php get_header(); ?>
    <!-- Start Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php the_archive_title(); ?></h2>
                </div>
                <div class="col-md-6">
                    <!-- BreadCrumb -->
                    <?php if (function_exists('matrix_breadcrumbs')) matrix_breadcrumbs(); ?>
                    <!-- BreadCrumb -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row blog-page">
                <!-- Start Blog Posts -->
                <div class="col-md-9 blog-box">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            $icon = 'fa fa-pencil'; ?>
                            <!-- Start Post -->
                            <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post image-post quote-post'); ?>>
                                <!-- Post Thumb -->
                                <div class="post-head">
                                    <!--If post has gallery--><?php
                                    if (get_post_gallery()) {
                                        $icon = 'fa fa-picture-o'; ?>
                                        <div class="touch-slider post-slider"><?php
                                        $gallery_thumb = get_post_gallery(get_the_ID(), false);
                                        if (has_post_thumbnail()) {
                                            $img_class = array('class' => 'img-responsive');
                                            $post_thumb_id = get_post_thumbnail_id();
                                            $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, true);    ?>
                                            <div class="item">
                                            <a class="lightbox" title="<?php the_title_attribute(); ?>"
                                               href="<?php echo esc_url($post_thumb_url[0]); ?>"
                                               data-lightbox-gallery="gallery1">
                                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div><?php
                                                the_post_thumbnail('matrix_blog_image', $img_class); ?>
                                            </a>
                                            </div><?php
                                        }
                                        foreach ($gallery_thumb['src'] as $src_img) {
                                            ?>
                                            <div class="item">
                                            <a class="lightbox" title="<?php the_title_attribute(); ?>"
                                               href="<?php echo esc_url($src_img); ?>" data-lightbox-gallery="gallery1">
                                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                                <img src="<?php echo esc_url($src_img); ?>"
                                                     alt="<?php the_title_attribute(); ?>" height="476px"/>
                                            </a>
                                            </div><?php
                                        } ?>
                                        </div><?php
                                    } elseif (has_post_thumbnail()) {
                                        $icon = 'fa fa-picture-o';
                                        $img_class = array('class' => 'img-responsive');
                                        $post_thumb_id = get_post_thumbnail_id();
                                        $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, true);    ?>
                                    <a class="lightbox" href="<?php echo esc_url($post_thumb_url[0]); ?>">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div><?php
                                        the_post_thumbnail('matrix_blog_image', $img_class); ?>
                                        </a><?php
                                    } ?>

                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-type"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php matrix_entry_meta(); ?>
                                <?php the_content( sprintf(
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'matrix' ),
									get_the_title()
								) ); ?>
                                </div>
                            </div>
                            <!-- End Post -->
                        <?php }
                    } ?>
                    <!-- Start Pagination -->
                    <?php matrix_pagination(); ?>
                    <!-- End Pagination -->
                </div>
                <!-- End Blog Posts -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>