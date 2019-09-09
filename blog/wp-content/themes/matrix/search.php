<?php get_header(); ?>
    <div class="page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php printf(__("Search Results For: %s", 'matrix'), '<span>"' . esc_attr(get_search_query()) . '"</span>'); ?></h2>
                </div>
                <div class="col-md-6">
                    <!-- BreadCrumb -->
                    <?php if (function_exists('matrix_breadcrumbs')) matrix_breadcrumbs(); ?>
                    <!-- BreadCrumb -->
                </div>
            </div>
        </div>
    </div>
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row blog-page">
                <!-- Start Blog Posts -->
                <div class="col-md-9 blog-box">
                    <?php if (have_posts()) { ?>
                        <?php while (have_posts()) {
                            the_post();
                            if (get_post_gallery()):
                                $class = 'gallery-post';
                                $icon = 'fa fa-picture-o';
                            elseif (has_post_thumbnail()):
                                $class = 'image-post';
                                $icon = 'fa fa-picture-o';
                            else:
                                $class = 'standard-post';
                                $icon = 'fa fa-pencil';
                            endif; ?>
                            <!-- Start Post -->
                            <div class="blog-post <?php echo $class; ?>">
                                <!-- Post Thumb -->
                                <div class="post-head">
                                    <!--If post has gallery--><?php if (get_post_gallery()) { ?>
                                        <div class="touch-slider post-slider">
                                            <?php    $gallery_thumb = get_post_gallery(get_the_ID(), false);
                                            if (has_post_thumbnail()) {
                                                $img_class = array('class' => 'img-responsive');
                                                $post_thumb_id = get_post_thumbnail_id();
                                                $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, true);    ?>
                                                <div class="item">
                                                <a class="lightbox" title="<?php the_title_attribute(); ?>"
                                                   href="<?php echo esc_url($post_thumb_url[0]); ?>"
                                                   data-lightbox-gallery="gallery1">
                                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i>
                                                    </div><?php
                                                    the_post_thumbnail('matrix_blog_image', $img_class); ?>
                                                </a>
                                                </div><?php
                                            }
                                            foreach ($gallery_thumb['src'] as $src_img) {
                                                ?>
                                                <div class="item">
                                                <a class="lightbox" title="<?php the_title_attribute(); ?>"
                                                   href="<?php echo esc_url($src_img); ?>"
                                                   data-lightbox-gallery="gallery1">
                                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                                    <img src="<?php echo esc_url($src_img); ?>"
                                                         alt="<?php the_title_attribute(); ?>" height="476px"/>
                                                </a>
                                                </div><?php
                                            } ?>
                                        </div>
                                    <?php
                                    } elseif (has_post_thumbnail()) {
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
                                    <ul class="post-meta">
                                        <li><?php _e('By : ', 'matrix'); ?> <a
                                                href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                        </li>
                                        <li><?php echo esc_attr(get_the_date(get_option('date_format'), get_the_ID())); ?></li>
                                        <?php $cat_list = get_the_category_list();
                                        if (!empty($cat_list)) {
                                            ?>
                                            <li><?php the_category(' , '); ?></li>
                                        <?php } ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>"><?php comments_number(__('0 Comment', 'matrix'), __('1 Comment', 'matrix'), __('% Comments', 'matrix')); ?></a>
                                        </li>
                                    </ul>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <!-- End Post -->
                        <?php }
                    } else { ?>
                        <div class="search_error">
                            <div class="search_err_heading"><h2><?php _e("Nothing Found", 'matrix'); ?></h2></div>
                            <div class="matrix_searching">
                                <p><?php _e("Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'matrix'); ?></p>
                            </div>

                        </div>
                        <?php get_search_form(); ?>
                    <?php } ?>
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