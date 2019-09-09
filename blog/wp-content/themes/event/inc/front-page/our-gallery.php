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
add_action('event_display_our_gallery','event_our_gallery');
function event_our_gallery(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_our_gallery'] != 1){
		$event_our_gallery_total_page_no = 0;
		$event_our_gallery_list_page	= array();
		for( $i = 1; $i <= $event_settings['event_total_our_gallery']; $i++ ){
			if( isset ( $event_settings['event_our_gallery_features_' . $i] ) && $event_settings['event_our_gallery_features_' . $i] > 0 ){
				$event_our_gallery_total_page_no++;

				$event_our_gallery_list_page	=	array_merge( $event_our_gallery_list_page, array( $event_settings['event_our_gallery_features_' . $i] ) );
			}
		}
		if (( !empty( $event_our_gallery_list_page ) || !empty($event_settings['event_our_gallery_title']) || !empty($event_settings['event_our_gallery_description']))  && $event_our_gallery_total_page_no > 0 ) {
			echo '<!-- Portfolio Box ============================================= -->'; ?>
				<div class="portfolio-box">
					<div class="container clearfix">
								<?php	$event_our_gallery_get_featured_posts 		= new WP_Query(array(
									'posts_per_page'      	=> $event_settings['event_total_our_gallery'],
									'post_type'           	=> array('page'),
									'post__in'            	=> $event_our_gallery_list_page,
									'orderby'             	=> 'post__in',
								));
					if($event_settings['event_our_gallery_title'] != ''){ ?>
						<h2 class="widget-title"><?php echo esc_attr($event_settings['event_our_gallery_title']);?> </h2>
					<?php } 
					if($event_settings['event_our_gallery_description'] != ''){ ?>
						<p class="box-sub-title"><?php echo esc_attr($event_settings['event_our_gallery_description']);?> </p>
					<?php } ?>
						<div class="column clearfix">
						<?php
						while ($event_our_gallery_get_featured_posts->have_posts()):$event_our_gallery_get_featured_posts->the_post();
						$event_attachment_id = get_post_thumbnail_id();
						$event_image_attributes = wp_get_attachment_image_src($event_attachment_id,'full');
						$i=1;
							$event_our_gallery_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
							<div class="three-column">
								<?php if (has_post_thumbnail()) { ?>
									<div class="portfolio-img" <?php if ($event_image_attributes)?> style="background-image:url('<?php echo esc_url($event_image_attributes[0]); ?>')">
										<a class="portfolio-link" href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" alt="<?php the_title('', '', false);?>"></a>		
										<div class="portfolio-overlay">
											<h4><?php the_title();?></h4>
										</div>
									</div>
								<?php } ?>
							</div> <!-- end .three-column -->
						<?php $i++;
						 endwhile; ?>
						</div><!-- .end column-->
					</div><!-- end .container -->
				</div> <!-- end .portfolio-box -->
			<?php }
		wp_reset_postdata();
	}
}
