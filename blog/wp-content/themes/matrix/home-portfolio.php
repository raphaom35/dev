<?php
$matrix_theme_options = matrix_theme_options();
global $post;
preg_match('/\[PVGM[^\]]*](.*)/uis', $post->post_content , $matches); ?>
<!-- Start Portfolio Section -->
<div class="section full-width-portfolio" style="border-top:0; border-bottom:0; background:#fff;">
		<?php if ((isset($matches[0]) || $matrix_theme_options['portfolio_shortcode']!="")) { ?>
        <!-- Start Recent Projects Carousel -->
        <?php 
		if(isset($matches[0])){
			echo do_shortcode($matches[0]);
		}elseif($matrix_theme_options['portfolio_shortcode']!=""){
			echo do_shortcode($matrix_theme_options['portfolio_shortcode']);
		} ?>
        <!-- End Recent Projects Carousel -->
		<?php } else { ?>
		<!-- Start Big Heading -->
      <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
        <h1><?php _e('This is Our Latest','matrix'); ?> <strong><?php _e('Work','matrix'); ?></strong></h1>
      </div>
      <!-- End Big Heading -->

      <p class="text-center"><?php _e('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.','matrix'); ?>
        <br/><?php _e('veritatis et quasi architecto beatae vitae dicta sunt explicabo.','matrix'); ?></p>


      <!-- Start Recent Projects Carousel -->
      <ul id="portfolio-list" data-animated="fadeIn">
        <li>
          <div class="portfolio-item-content">
            <span class="header"><?php _e('Town winter 2013','matrix'); ?></span>
            <p class="body"><?php _e('web develpment, design','matrix'); ?></p>
          </div>
          <a id="port-img-url-1" class="lightbox" data-lightbox-gallery="gallery1" href="<?php echo get_template_directory_uri();?>/images/portfolio.jpg"><i class="fa fa-search-plus more"></i><img src="<?php echo get_template_directory_uri();?>/images/portfolio.jpg" alt="port" class="port_img"></a>
         <a href="#"><i class="fa fa-link more margin-left"></i></a>
        </li>
        <li>
          <div class="portfolio-item-content">
            <span class="header"><?php _e('Quarterly Musashino','matrix'); ?></span>
            <p class="body"><?php _e('web develpment, design','matrix'); ?></p>
          </div>
          <a id="port-img-url-2" class="lightbox" data-lightbox-gallery="gallery1" href="<?php echo get_template_directory_uri();?>/images/portfolio.jpg"><i class="fa fa-search-plus more"></i><img src="<?php echo get_template_directory_uri();?>/images/portfolio.jpg" alt="port" class="port_img"></a>
         <a href="#"><i class="fa fa-link more margin-left"></i></a>

        </li>
        <li>
          <div class="portfolio-item-content">
            <span class="header"><?php _e('Mainichi April 2014','matrix'); ?></span>
            <p class="body"><?php _e('web develpment, design','matrix'); ?></p>
          </div>
          <a id="port-img-url-3" class="lightbox" data-lightbox-gallery="gallery1" href="<?php echo get_template_directory_uri();?>/images/portfolio.jpg"><i class="fa fa-search-plus more"></i><img src="<?php echo get_template_directory_uri();?>/images/portfolio.jpg" alt="port" class="port_img"></a>
         <a href="#"><i class="fa fa-link more margin-left"></i></a>

        </li>
        <li>
          <div class="portfolio-item-content">
            <span class="header"><?php _e('Shitamachi Rocket','matrix'); ?></span>
            <p class="body"><?php _e('web develpment, design','matrix'); ?></p>
          </div>
          <a id="port-img-url-4" class="lightbox" data-lightbox-gallery="gallery1" href="<?php echo get_template_directory_uri();?>/images/portfolio.jpg"><i class="fa fa-search-plus more"></i><img src="<?php echo get_template_directory_uri();?>/images/portfolio.jpg" alt="port" class="port_img"></a>
         <a href="#"><i class="fa fa-link more margin-left"></i></a>

        </li>
        
      </ul>

      <!-- End Recent Projects Carousel -->
	  
	<?php } ?>
</div>
<!-- End Portfolio Section -->