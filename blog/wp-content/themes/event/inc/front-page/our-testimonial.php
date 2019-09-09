<?php
/**
 * Gallery
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
add_action('event_display_our_testimonial','event_our_testimonial');
function event_our_testimonial(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_our_testimonial'] != 1){
		$event_our_testimonial_total_page_no = 0;
		$event_our_testimonial_list_page	= array();
		for( $i = 1; $i <= $event_settings['event_total_our_testimonial']; $i++ ){
			if( isset ( $event_settings['event_our_testimonial_features_' . $i] ) && $event_settings['event_our_testimonial_features_' . $i] > 0 ){
				$event_our_testimonial_total_page_no++;

				$event_our_testimonial_list_page	=	array_merge( $event_our_testimonial_list_page, array( $event_settings['event_our_testimonial_features_' . $i] ) );
			}
		}
		if (( !empty( $event_our_testimonial_list_page ) || !empty($event_settings['event_our_testimonial_title']) )  && $event_our_testimonial_total_page_no > 0 ) { 
			echo '<!-- Testimonial Box============================================= -->';?>
			<div class="testimonial-box">
				<div class="testimonial-bg" <?php if($event_settings['event_our_testimonial_bg_image'] !=''){?>style="background-image:url('<?php echo esc_url($event_settings['event_our_testimonial_bg_image']); ?>');" <?php } ?>>
					<div class="container clearfix">
						<?php	$event_our_testimonial_get_featured_posts 		= new WP_Query(array(
							'posts_per_page'      	=> $event_settings['event_total_our_testimonial'],
							'post_type'           	=> array('page'),
							'post__in'            	=> $event_our_testimonial_list_page,
							'orderby'             	=> 'post__in',
						));
						if($event_settings['event_our_testimonial_title'] != ''){ ?>
							<h2 class="box-title"><?php echo esc_attr($event_settings['event_our_testimonial_title']);?> </h2>
						<?php } ?>
						<div class="testimonials">
							<div class="testimonial-slider">
								<ul class="slides">
									<?php
									while ($event_our_testimonial_get_featured_posts->have_posts()):$event_our_testimonial_get_featured_posts->the_post();
									$event_attachment_id = get_post_thumbnail_id();
									$event_image_attributes = wp_get_attachment_image_src($event_attachment_id);
									$i=1;
										$event_our_testimonial_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
										<li>
										<?php if(get_the_content()): ?>
											<div class="testimonial-quote">
												<i class="fa fa-quote-left"></i>
												<?php the_content(); ?>
												 <cite><?php the_title(); ?></cite>
												<i class="fa fa-caret-down"></i>
											</div>
											<?php endif;
											if (has_post_thumbnail()) {
													the_post_thumbnail();
											} ?>
										</li>
									<?php $i++;
									 endwhile; ?>
								</ul><!-- end .slides -->
							</div> <!-- end .testimonial-slider -->
					   	</div><!-- end .testimonials -->
					</div><!-- end .container -->
				</div><!-- end .testimonial-bg -->
			</div><!-- end .testimonial-box -->
	<?php }
		wp_reset_postdata();
	}

}
