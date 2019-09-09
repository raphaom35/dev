<?php
/**
 * Upcoming Event
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
add_action('event_display_upcoming_box','event_upcoming_box');
function event_upcoming_box(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_upcoming'] != 1){
	$get_upcoming_posts = new WP_Query(array(
					'posts_per_page' =>  $event_settings['event_total_upcoming'],
					'post_type' => array(
						'post'
					) ,
					'category__in' => $event_settings['event_upcoming_category_list'],
				));
		if ( !empty($event_settings['event_upcoming_title']) || $get_upcoming_posts !='') { 
		echo '<!-- UPCOMING EVENTS BOX ============================================= -->';?>
		<div class="new-event-box">
			<div class="new-event-background" <?php if($event_settings['event_upcoming_bg_image'] !=''){?>style="background-image:url('<?php echo esc_url($event_settings['event_upcoming_bg_image']); ?>');" <?php } ?>>
				<div class="container">
					<div class="new-event-colorbox clearfix">
						<div class="new-event-content">
							<?php	
							if($event_settings['event_upcoming_title'] != ''){ ?>
								<h2 class="box-title"><?php echo esc_attr($event_settings['event_upcoming_title']);?> </h2>
							<?php } ?>
							<div class="column clearfix">
								<?php
								while ($get_upcoming_posts->have_posts()):$get_upcoming_posts->the_post();
									$event_upcoming_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
									<div class="four-column">
										<?php if (has_post_thumbnail()) { ?>
											<div class="event-img">
											<?php the_post_thumbnail(); ?>
												<div class="event-overlay">
													<a class="new-event-img" href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" alt="<?php the_title('', '', false);?>">
													<span class="link-ico"></span></a>
												</div> <!-- end .event-overlay -->
											</div> <!-- end .event-img -->
										<?php } ?>
										<div>
											<?php if ($event_upcoming_title_attribute != '') { ?>
												<h4 class="new-event-title"><a href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" rel="bookmark"><?php the_title();?></a></h4>
											<?php } ?>
										</div>
									</div><!-- end .four-column -->
								<?php endwhile; ?>
							</div><!-- .end column-->
						</div> <!-- end .new-event-content -->
					</div> <!-- end .new-event-colorbox -->
				</div><!-- end .container -->
			</div> <!-- end .new-event-background -->
		</div> <!-- end .new-event-box -->
		<?php }
	wp_reset_postdata();
	}
}
