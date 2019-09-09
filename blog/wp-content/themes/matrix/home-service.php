<?php $matrix_theme_options = matrix_theme_options(); ?>
<!-- Start Services Section -->
<div class="section service">
	<div class="container">
		<div class="row">
			<!-- Start Big Heading -->
			<?php if ($matrix_theme_options['home_service_title']) { ?>
				<div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
					<h1 id="service-head"><?php echo esc_attr($matrix_theme_options['home_service_title']); ?></h1>
				</div>
			<?php } ?>
			<!-- End Big Heading -->
			<?php if ($matrix_theme_options['home_service_description']) { ?>
				<p id="service-desc"
				   class="text-center"><?php echo esc_attr($matrix_theme_options['home_service_description']); ?></p>
			<?php
			}
			for ($i = 1; $i <= 4; $i++) {
				?>
				<!-- Start Service Icon 1 -->
				<div class="col-md-<?php echo $matrix_theme_options['home_service_column']; ?> col-sm-6 service-box service-center" data-animation="fadeIn"
					 data-animation-delay="0<?php echo $i; ?>">
					<?php if ($matrix_theme_options['service_icon_' . $i]) {
						if ($matrix_theme_options['service_link_' . $i] != "") { ?>
						<a id="service-link-<?php echo $i; ?>" href="<?php echo esc_url($matrix_theme_options['service_link_' . $i]); ?>" target="_blank"><?php 
					} ?>
							<div id="service_box_<?php echo $i; ?>" class="service-icon">
								<i id="service-icon-<?php echo $i; ?>"
								   class="<?php echo esc_attr($matrix_theme_options['service_icon_' . $i]); ?> icon-large"></i>
							</div>
						<?php if ($matrix_theme_options['service_link_' . $i] != "") { ?>
							</a><?php
					} }?>
					<div class="service-content"><?php if ($matrix_theme_options['service_title_' . $i] != "") {
					if ($matrix_theme_options['service_link_' . $i] != "") { ?>
					<a id="service-link-1<?php echo $i; ?>" href="<?php echo esc_url($matrix_theme_options['service_link_' . $i]); ?>" target="_blank"><?php 
					} ?>
							<h4 id="service-title-<?php echo $i; ?>"><?php echo esc_attr($matrix_theme_options['service_title_' . $i]); ?></h4>
							<?php if ($matrix_theme_options['service_link_' . $i] != "") { ?>
							</a><?php
					} }?>
						<?php if ($matrix_theme_options['service_text_' . $i]) { ?>
							<p id="service-desc-<?php echo $i; ?>"><?php echo esc_attr($matrix_theme_options['service_text_' . $i]); ?></p>
						<?php } ?>
					</div>
				</div>
				<!-- End Service Icon 1 -->
			<?php } ?>
		</div>
		<!-- .row -->
	</div>
	<!-- .container -->
</div>
<!-- End Services Section -->