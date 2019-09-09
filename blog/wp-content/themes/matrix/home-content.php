<?php $matrix_theme_options = matrix_theme_options(); ?>
<!-- Start Blog Section -->
<div class="section extra_section">
    <div class="container extra_bg">
        <div class="row">
            <!-- Start Big Heading -->
            <?php if ($matrix_theme_options['home_extra_title']) { ?>
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1 id="extra_title"><?php echo esc_attr($matrix_theme_options['home_extra_title']); ?></h1>
                </div>
            <?php } ?>
            <!-- End Big Heading -->
            <?php if ($matrix_theme_options['home_extra_description']) { ?>
                <p id="extra_desc" class="text-center"><?php echo esc_attr($matrix_theme_options['home_extra_description']); ?></p>
            <?php } ?>
            <div class="col-md-12">
				<div class="latest-posts">
					<?php echo apply_filters('the_content', $matrix_theme_options['extra_content_home']); ?>
                <!-- End Recent Posts Carousel -->
				</div>
			</div>
        </div>
    </div>
</div>