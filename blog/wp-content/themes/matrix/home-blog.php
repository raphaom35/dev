<?php $matrix_theme_options = matrix_theme_options(); ?>
<!-- Start Testimonials Section -->
<div id="home-blog" class="section service">
    <div class="container">
        <div class="row">
            <!-- Start Big Heading -->
            <?php if ($matrix_theme_options['home_blog_title']) { ?>
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1 id="blog-heading"><?php echo esc_attr($matrix_theme_options['home_blog_title']); ?></h1>
                </div>
            <?php } ?>
            <!-- End Big Heading -->
            <?php if ($matrix_theme_options['home_blog_description']) { ?>
                <p class="text-center"
                   id="blog-desc"><?php echo esc_attr($matrix_theme_options['home_blog_description']); ?></p>
            <?php } ?>
            <div class="col-md-12">
                <!-- Start Recent Posts Carousel -->
                <div class="latest-posts">
                    <h4 class="classic-title"><span></span></h4>

                    <div id="matrix_blog_section" class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2"><?php
						$all_posts = wp_count_posts('post')->publish;
						if(isset($matrix_theme_options['home_post_cat'])){
						$cat = $matrix_theme_options['home_post_cat'];
						}
						$args = array('post_type' => 'post', 'posts_per_page' => $all_posts , 'category__in'=>$cat);
						query_posts($args);
                        if (query_posts($args)) {
                            while (have_posts()):the_post(); ?>
                                <!-- Posts 1 -->
                                <div class="post-row item col-md-4 col-sm-6">
                                    <div class="left-meta-post">
                                        <div class="post-date"><span class="day"><?php echo get_the_date('d'); ?></span><span
                                                class="month"><?php echo get_the_date('M'); ?></span></div>
                                        <?php if (get_post_meta(get_the_ID(), 'post_image_icon', true)) { ?>
                                            <div class="post-type"><i
                                                    class="<?php echo get_post_meta(get_the_ID(), 'post_image_icon', true); ?>"></i>
                                            </div>
                                        <?php } else { ?>
                                            <div class="post-type"><i class="fa fa-picture-o"></i></div>
                                        <?php } ?>
                                    </div>
                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <?php
                                    if (has_post_thumbnail()):
                                        $img_class = array('class' => 'img-responsive'); ?>
                                        <div class="blog_img">
                                            <?php the_post_thumbnail('matrix_home_post_image', $img_class); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content">
										<?php the_excerpt(); ?>
									</div>
                                </div>
                            <?php endwhile;
                        } ?>

                    </div>
                </div>
                <!-- End Recent Posts Carousel -->
            </div>
        </div>
    </div>
	<?php if($all_posts > 3){ ?>
    <div class="matrix_carousel-navi home-blog-content">
        <div id="port-prev1" class="matrix_carousel-prev"><i class="fa fa-arrow-left"></i></div>
        <div id="port-next1" class="matrix_carousel-next"><i class="fa fa-arrow-right"></i></div>
    </div>
	<?php } ?>
</div>