<?php $matrix_theme_options = matrix_theme_options();
if (isset($matrix_theme_options['home_slider_posts']) && ($matrix_theme_options['home_slider_posts']!="" ) && !empty($matrix_theme_options['home_slider_posts'])) { 
?>
    <!-- Start Home Page Slider -->
    <section id="home">
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for ($i = 1; $i <= count($matrix_theme_options['home_slider_posts']); $i++) { ?>
                        <li data-target="#main-slide"
                            data-slide-to="<?php echo $i; ?>" <?php echo $i == 1 ? 'class="active"' : ""; ?>></li>
                    <?php
                    }
                 ?>
            </ol>
            <!--/ Indicators end-->
            <!-- Carousel inner -->
            <div class="carousel-inner">
                <?php $i=1; foreach ($matrix_theme_options['home_slider_posts'] as $post_id) {
					$slider = get_post($post_id); ?>
                    <div class="<?php echo $i == 1 ? "item active" : "item"; ?>">
                        <?php echo get_the_post_thumbnail( $slider->ID, 'matrix_slider_post', array('class' => 'img-responsive') ); ?>
                        <div class="slider-content">
                            <div class="col-md-12 text-center">
                                <h2 class="animated2">
						  <span
                              id="slide-title-<?php echo $i; ?>">
						  <?php
                          $subtitle_count = explode(' ', $slider->post_title);
                          if (isset($subtitle_count[1])) {
                              $subtitle = preg_split("/\s+/", $slider->post_title);
                              // Replace the first word.
                              $subtitle[0] = "<strong>" . $subtitle[0] . "</strong>";
                              // Re-create the string.
                              $subtitle = join(" ", $subtitle);
                              echo stripslashes($subtitle);
                          } else {
                              echo "<strong>" . esc_attr($slider->post_title) . "</strong>";
                          }?>
						  </span>
                                </h2>

                                <h3 class="animated3 ">
                                    <span
                                        id="slide-subtitle-<?php echo $i; ?>"><?php echo esc_attr(wp_trim_words( $slider->post_content, 10, '...' )); ?></span>
                                </h3>

                                <div class="">
                                        <a id="slide<?php echo $i; ?>-btn1"
                                           class="animated4 slider slider-btn1 btn btn-primary btn-min-block"
                                           href="<?php echo esc_url(get_post_permalink($slider->ID)); ?>"><?php _e('Read More','matrix'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++; } ?>
            </div>
            <!-- Carousel inner end-->
            <!-- Controls -->
			<?php if(count($matrix_theme_options['home_slider_posts']) >1 ){ ?>
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
			<?php } ?>
        </div>
        <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->
<?php } else { ?>
<!-- Start Home Page Slider -->
    <section id="home">
      <!-- Carousel -->
      <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#main-slide" data-slide-to="0" class="active"></li>
          <li data-target="#main-slide" data-slide-to="1"></li>
          <li data-target="#main-slide" data-slide-to="2"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
          <div class="item active">
            <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/images/slide.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated2 white">
                              <span><?php _e('Welcome to ','matrix'); ?><strong><?php _e('Matrix','matrix'); ?></strong></span>
                              </h2>
                <h3 class="animated3 white">
                                <span><?php _e('The ultimate aim of your business','matrix'); ?></span>
                              </h3>
                <p class="animated4"><a href="#" class="slider btn btn-system btn-large"><?php _e('Check Now','matrix'); ?></a>
                </p>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
          <div class="item">
            <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/images/slide.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated4 white">
                                <span><strong><?php _e('Matrix','matrix'); ?></strong> <?php _e('for the highest','matrix'); ?></span>
                            </h2>
                <h3 class="animated5 white">
                              <span><?php _e('The Key of your Success','matrix'); ?></span>
                            </h3>
                <p class="animated6"><a href="#" class="slider btn btn-system btn-large"><?php _e('Buy Now','matrix'); ?></a>
                </p>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
          <div class="item">
            <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/images/slide.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated7 white">
                                <span><?php _e('The way of','matrix'); ?> <strong><?php _e('Success','matrix'); ?></strong></span>
                            </h2>
                <h3 class="animated8 white">
                              <span><?php _e('Why you are waiting','matrix'); ?></span>
                            </h3>
                <div class="">
                  <a class="animated4 slider btn btn-system btn-large btn-min-block" href="#"><?php _e('Get Now','matrix'); ?></a><a class="animated4 slider btn btn-default btn-min-block" href="#"><?php _e('Live Demo','matrix'); ?></a>
                </div>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
          <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
          <span><i class="fa fa-angle-right"></i></span>
        </a>
      </div>
      <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->
<?php } ?>