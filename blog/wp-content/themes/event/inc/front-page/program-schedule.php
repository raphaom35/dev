<?php
/**
 * Program Schedule
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
add_action('event_display_program_schedule','event_program_schedule');
function event_program_schedule(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_program_schedule'] != 1){
		echo '<!-- List Schedule Box ============================================= -->'; ?>
			<div class="schedule-list-box">
				<div class="container">
					<?php if($event_settings['event_program_schedule_title'] != ''){ ?>
						<h2 class="box-title"><?php echo esc_attr($event_settings['event_program_schedule_title']);?> </h2>
					<?php } ?>
					<?php if($event_settings['event_program_schedule_description'] != ''){ ?>
					<p class="box-sub-title"><?php echo esc_attr($event_settings['event_program_schedule_description']);?></p>
					<?php } ?>
					<div class="list-bg-box" <?php if($event_settings['event_program_schedule_bg_image'] !=''){?>style="background-image:url('<?php echo esc_url($event_settings['event_program_schedule_bg_image']); ?>');" <?php } ?>>
						<?php 
						$event_program_schedule_no = 0;
						$event_list_program_schedule	= array();
						for( $i = 1; $i <= $event_settings['event_total_program_schedule']; $i++ ){ 
							if( isset ( $event_settings['event_program_schedule_features_' . $i] ) ){ 
								$event_program_schedule_no++;

								$event_list_program_schedule	=	array_merge( $event_list_program_schedule, array( $event_settings['event_program_schedule_features_' . $i] ) );
							}

						} 
						if(!empty($event_list_program_schedule)): ?>
							<ul class="list-nav">
							<?php 
							$i = 1;
							foreach ( $event_list_program_schedule as $event_category) :
							if($i==1){ ?>
								<li class="tab-link current" data-tab="tab-<?php echo absint($i);?>"><?php echo esc_attr(get_cat_name($event_category)); ?></li>
							<?php }else{ ?>
								<li class="tab-link" data-tab="tab-<?php echo absint($i);?>"><?php echo esc_attr(get_cat_name($event_category)); ?></li>
							<?php } 
								$i++;
							endforeach; ?>
							</ul>
						<?php endif; ?>
						<div class="schedule-list-contents">
						<?php $j = 1;
						foreach ( $event_list_program_schedule as $event_category) :
							if($j==1){?>
							<div class="tab-contents current" id="tab-<?php echo absint($j); ?>">
							<?php }else{ ?>
							<div class="tab-contents" id="tab-<?php echo absint($j); ?>">
							<?php } ?>
								<ul class="schedule-list">
								<?php
								$get_program_schedule_posts = new WP_Query(array(
									'post_type' => array('post') ,
									'category__in' => $event_settings['event_program_schedule_features_'.$j],
								));
									while ($get_program_schedule_posts->have_posts()):$get_program_schedule_posts->the_post(); 
									?> 
									<li><span class="list-count"><?php the_title(); ?></span><?php the_content(); ?></li> 
									<?php endwhile;
								 ?>
								</ul>
							</div>
						<?php $j++;
						 endforeach; ?>
						</div><!-- end .schedule-list-contents -->
					</div><!-- end .list-bg-box -->
				</div><!-- end .container -->
			</div><!-- end .schedule-list-box -->		
		<?php
	wp_reset_postdata();
}
}
