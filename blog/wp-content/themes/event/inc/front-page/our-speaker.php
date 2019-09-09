<?php
/**
 * Our Speakers
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
add_action('event_display_our_speaker','event_our_speaker');
function event_our_speaker(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_our_speaker'] != 1){
		$event_our_speaker_total_page_no = 0;
		$event_our_speaker_list_page	= array();
		for( $i = 1; $i <= $event_settings['event_total_our_speaker']; $i++ ){
			if( isset ( $event_settings['event_our_speaker_features_' . $i] ) && $event_settings['event_our_speaker_features_' . $i] > 0 ){
				$event_our_speaker_total_page_no++;

				$event_our_speaker_list_page	=	array_merge( $event_our_speaker_list_page, array( $event_settings['event_our_speaker_features_' . $i] ) );
			}
		}
		if (( !empty( $event_our_speaker_list_page ) || !empty($event_settings['event_our_speaker_title']) || !empty($event_settings['event_our_speaker_description']))  && $event_our_speaker_total_page_no > 0 ) {
			echo '<!-- Our Team Box ============================================= -->'; ?>
				<div class="our-team-box">
					<div class="container clearfix">
								<?php	$event_our_speaker_get_featured_posts 		= new WP_Query(array(
									'posts_per_page'      	=> $event_settings['event_total_our_speaker'],
									'post_type'           	=> array('page'),
									'post__in'            	=> $event_our_speaker_list_page,
									'orderby'             	=> 'post__in',
								));
					if($event_settings['event_our_speaker_title'] != ''){ ?>
						<h2 class="box-title"><?php echo esc_attr($event_settings['event_our_speaker_title']);?> </h2>
					<?php } 
					if($event_settings['event_our_speaker_description'] != ''){ ?>
						<p class="box-sub-title"><?php echo esc_attr($event_settings['event_our_speaker_description']);?> </p>
					<?php } ?>
						<div class="column clearfix">
						<?php
						$i=1;
						while ($event_our_speaker_get_featured_posts->have_posts()):$event_our_speaker_get_featured_posts->the_post();
							$event_our_speaker_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
							<div class="four-column">
								<div class="our-team">
								<?php if (has_post_thumbnail()) { ?>
									<div class="team-member">
										<a href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" alt="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
									</div> <!-- end .team-member -->
								<?php }
								if ($event_our_speaker_title_attribute != '') { ?>
								<a href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" rel="bookmark"><h5><?php the_title();?></h5></a>
								<?php }
								if($event_settings['event_our_speaker_position_'. $i .''] != ''){ ?>
									<p class="member-post"><?php echo esc_attr($event_settings['event_our_speaker_position_'. $i .'']);?> </p>
								<?php } 
								if($event_settings['event_our_speaker_about_'. $i .''] != '') { ?>
									<div class="speaker-topic-title">
										<h4><?php echo esc_attr($event_settings['event_our_speaker_about_'. $i .'']);?></h4>
									</div>
								<?php } ?>
		
								</div> <!-- end .our-team -->
							</div> <!-- end .four-column -->
						<?php $i++;
						 endwhile; ?>
						</div><!-- .end column-->
					</div><!-- end .container -->
				</div> <!-- end .our-team-box -->
			<?php }
		wp_reset_postdata();
	}
}
