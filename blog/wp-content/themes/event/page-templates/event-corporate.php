<?php
/**
 * Template Name: Event Corporate Template
 *
 * Displays Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
get_header();
$event_settings = event_get_theme_options();
/********************************************************************/
?>
<div id="main" class="clearfix">
<?php
if($event_settings['event_display_book_appoinment'] ==0){
	$i =1;
	$event_booking_appointment	= array();
	$event_booking_appointment	=	array_merge( $event_booking_appointment, array( $event_settings['event_title'] ) );
	$event_get_booking_posts 		= new WP_Query(array(
							'posts_per_page'      	=> $event_settings['event_title'],
							'post_type'           	=> array('page'),
							'post__in'            	=> $event_booking_appointment,
							'orderby'             	=> 'post__in',
						));
				if($event_settings['event_date_time'] !='' || $event_settings['event_date_time'] !='' || $event_settings['event_venue'] !='' || $event_settings['event_book_appointment'] !=''){
				echo '<!-- Single Event ============================================= -->'; ?>
				<div class="single-event-info clearfix">
					<div class="container">
						<ul class="date-info">
						<?php if($event_get_booking_posts->have_posts()):$event_get_booking_posts->the_post();
							if($i==1 &&  $event_settings['event_title'] !=''){
								$event_booking_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
								<li><i class="fa fa-calendar"></i><?php echo esc_attr($event_booking_title_attribute); ?></li>
								<?php $i++;
							}
						endif;
							if($event_settings['event_date_time'] !=''){
								echo '<li>'.esc_attr($event_settings['event_date_picker']).'&nbsp;&nbsp;&nbsp;'.esc_attr($event_settings['event_date_time']).'</li>';
							}
							if($event_settings['event_venue'] !=''){
								echo '<li>'.esc_attr($event_settings['event_venue']).'</li>';
							} ?>
						</ul>
						<?php if($event_settings['event_book_appointment'] !=''){ ?>
						<div class="alignright">
						<?php if($event_settings['event_book_appointment_url']!=''){ ?>
							<a class="appointment-btn btn-eff" href="<?php echo esc_url_raw($event_settings['event_book_appointment_url']); ?>"><i class="fa fa-pencil-square-o"></i><?php echo esc_attr($event_settings['event_book_appointment']); ?></a>
						<?php }else{ ?>
							<a class="appointment-btn btn-eff" href="<?php the_permalink(); ?>"><i class="fa fa-pencil-square-o"></i><?php echo esc_attr($event_settings['event_book_appointment']); ?></a>
						<?php } ?>
						</div>
						<?php  } ?>
					</div>	
				</div> 	<!-- end .single-event-info -->
				<?php }
	wp_reset_postdata();
}
/********************************************************************/
if($event_settings['event_our_speaker_section'] =='above_front_page_feature'){
	do_action('event_display_our_speaker');
}
if($event_settings['event_program_schedule_section'] =='above_front_page_feature'){
	do_action('event_display_program_schedule');
}
if($event_settings['event_our_gallery_section'] =='above_front_page_feature'){
	do_action('event_display_our_gallery');
}
if($event_settings['event_our_testimonial_section'] =='above_front_page_feature'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_front_page_section'] =='default'){
	do_action('event_display_front_page_features');
}
/********************************************************************/
if($event_settings['event_our_testimonial_section'] =='above_upcoming_event'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_upcoming_event_section'] =='default'){
	do_action('event_display_upcoming_box');
}
if($event_settings['event_program_schedule_section'] =='above_upcoming_event'){
	do_action('event_display_program_schedule');
}
if($event_settings['event_our_gallery_section'] =='above_upcoming_event'){
	do_action('event_display_our_gallery');
}
if($event_settings['event_front_page_section'] =='below_upcoming_event'){
	do_action('event_display_front_page_features');
}
/*****************************************************************/
if($event_settings['event_our_testimonial_section'] =='above_our_speaker'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_our_speaker_section'] =='default'){
	do_action('event_display_our_speaker');
}
if($event_settings['event_our_gallery_section'] =='above_our_speaker'){
	do_action('event_display_our_gallery');
}
if($event_settings['event_front_page_section'] =='above_our_speaker'){
	do_action('event_display_front_page_features');
}
if($event_settings['event_upcoming_event_section'] =='below_our_speaker'){
	do_action('event_display_upcoming_box');
}
/*****************************************************************/
if($event_settings['event_our_testimonial_section'] =='above_program_schedule_event'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_program_schedule_section'] =='default'){
	do_action('event_display_program_schedule');
}
if($event_settings['event_front_page_section'] =='below_program_schedule'){
	do_action('event_display_front_page_features');
}
if($event_settings['event_upcoming_event_section'] =='below_program_schedule'){
	do_action('event_display_upcoming_box');
}
if($event_settings['event_our_speaker_section'] =='below_program_schedule'){
	do_action('event_display_our_speaker');
}
/*****************************************************************/
if(class_exists('Event_Plus_Features')):
	do_action('event_display_timeline');
endif;
/*****************************************************************/
if(class_exists('Event_Plus_Features')):
	do_action('event_display_blog');
endif;
/*****************************************************************/
if($event_settings['event_our_testimonial_section'] =='above_our_gallery'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_our_gallery_section'] =='default'){
	do_action('event_display_our_gallery');
}
if($event_settings['event_front_page_section'] =='below_our_gallery'){
	do_action('event_display_front_page_features');
}
if($event_settings['event_upcoming_event_section'] =='below_our_gallery'){
	do_action('event_display_upcoming_box');
}
if($event_settings['event_our_speaker_section'] =='below_our_gallery'){
	do_action('event_display_our_speaker');
}
if($event_settings['event_program_schedule_section'] =='below_our_gallery'){
	do_action('event_display_program_schedule');
}

/*****************************************************************/
if($event_settings['event_our_testimonial_section'] =='default'){
	do_action('event_display_our_testimonial');
}
if($event_settings['event_front_page_section'] =='below_our_testimonial'){
	do_action('event_display_front_page_features');
}
if($event_settings['event_upcoming_event_section'] =='below_our_testimonial'){
	do_action('event_display_upcoming_box');
}
if($event_settings['event_our_speaker_section'] =='below_our_testimonial'){
	do_action('event_display_our_speaker');
}
if($event_settings['event_program_schedule_section'] =='below_our_testimonial'){
	do_action('event_display_program_schedule');
}
if($event_settings['event_our_gallery_section'] =='below_our_testimonial'){
	do_action('event_display_our_gallery');
}
?>
</div>
<!-- end #main -->
<?php get_footer();