<?php
/* Template Name: Blog */
get_header();
get_template_part('header', 'banner'); ?>
    <div id="content">
        <div class="container">
            <div class="row blog-page">
				<?php $page_layout = get_post_meta(get_the_ID(), 'page_layout', true);
				if ($page_layout == "fullwidth_left") {
					get_sidebar();
					$post_width = 'col-md-9';
					$imgsize = 'matrix_blog_image';
				} elseif ($page_layout == "fullwidth") {
					$post_width = 'col-md-12';
					$imgsize = 'matrix_blog_image_full';
				} elseif ($page_layout == "fullwidth_right") {
					$post_width = 'col-md-9';
					$imgsize = 'matrix_blog_image';
				} else {
					$page_layout = "fullwidth_right";
					$post_width = 'col-md-9';
					$imgsize = 'matrix_blog_image';
				} ?>
                <!-- Start Blog Posts -->
                <div class="<?php echo esc_attr($post_width); ?> blog-box"><?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array('post_type' => 'post', 'paged' => $paged);
					$wp_query = new WP_Query($args);
					while ($wp_query->have_posts()):
						$wp_query->the_post();
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
                                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div><?php
                                                the_post_thumbnail($imgsize, $img_class); ?>
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
                                    </div>
                                <?php
                                } elseif (has_post_thumbnail()) {
                                    $img_class = array('class' => 'img-responsive');
                                    $post_thumb_id = get_post_thumbnail_id();
                                    $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, true);    ?>
                                <a class="lightbox" href="<?php echo esc_url($post_thumb_url[0]); ?>">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div><?php
                                    the_post_thumbnail($imgsize, $img_class); ?>
                                    </a><?php
                                } ?>

                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-type"><i class="<?php echo $icon; ?>"></i></div>
                                <h2><a href="<?php the_permalink(); ?>"
                                       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                <?php matrix_entry_meta(); ?>
                                <?php the_content( sprintf(
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'matrix' ),
									get_the_title()
								) ); ?>
                                <?php
                                if (get_the_tag_list() != '') {
                                    ?>
                                    <div class="post-tags-list">
                                        <?php the_tags('', '  ', ''); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div><?php
                        endwhile;
                    //endif; ?>
                    <!-- End Post -->
                    <!-- Start Pagination -->
                    <?php
                    matrix_pagination();
                    ?>
                    <!-- End Pagination -->
                </div>
                <!-- End Blog Posts -->
                <!--Sidebar-->
                <?php if ($page_layout == "fullwidth_right") {
					get_sidebar();
				} ?>
                <!--End sidebar-->
            </div>
        </div>
    </div>
<?php get_footer(); ?>