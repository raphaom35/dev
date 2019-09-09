<?php
/**
 * Front Page Features
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0.1
 */
add_action('event_display_front_page_features','event_front_page_features');
function event_front_page_features(){
	global $post;
	$event_settings = event_get_theme_options();
	if($event_settings['event_disable_features'] != 1){
		$event_total_page_no = 0;
		$event_list_page	= array();
		for( $i = 1; $i <= $event_settings['event_total_features']; $i++ ){
			if( isset ( $event_settings['event_frontpage_features_' . $i] ) && $event_settings['event_frontpage_features_' . $i] > 0 ){
				$event_total_page_no++;

				$event_list_page	=	array_merge( $event_list_page, array( $event_settings['event_frontpage_features_' . $i] ) );
			}
		}
		if (( !empty( $event_list_page ) || !empty($event_settings['event_features_title']) || !empty($event_settings['event_features_description']) )  && $event_total_page_no > 0 ) {
		echo '<!-- Our Feature Box ============================================= -->'; ?>
			<div class="our-feature-box">
				<div class="container clearfix">
					<?php	$event_feature_box_get_featured_posts 		= new WP_Query(array(
						'posts_per_page'      	=> $event_settings['event_total_features'],
						'post_type'           	=> array('page'),
						'post__in'            	=> $event_list_page,
						'orderby'             	=> 'post__in',
					));
				if($event_settings['event_features_title'] != ''){ ?>
					<h2 class="box-title"><?php echo esc_attr($event_settings['event_features_title']);?> </h2>
				<?php }
				if($event_settings['event_features_description'] != ''){ ?>
					<p class="feature-sub-title"><?php echo esc_attr($event_settings['event_features_description']); ?></p>
				<?php } ?>
					<div class="column clearfix">
					<?php
					while ($event_feature_box_get_featured_posts->have_posts()):$event_feature_box_get_featured_posts->the_post();
						$event_featuredbox_title_attribute = apply_filters('the_title', get_the_title($post->ID)); ?>
						<div class="three-column">
							<div class="feature-content">
								<?php if (has_post_thumbnail()) { ?>
									<a class="feature-icon" href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" alt="<?php the_title('', '', false);?>"><?php the_post_thumbnail(); ?></a>
								<?php } ?>
							<article>
								<?php if ($event_featuredbox_title_attribute != '') { ?>
									<h3 class="feature-title"><a href="<?php the_permalink();?>" title="<?php the_title('', '', false);?>" rel="bookmark"><?php the_title();?></a></h3>
								<?php }
									the_excerpt(); ?>
							</article>
							<?php
							if($event_settings['event_disable_features_readmore'] == 0){
								$excerpt_text = $event_settings['event_tag_text'];
								if($excerpt_text == '' || $excerpt_text == 'Read More') : ?>
									<a title="<?php the_title();?>" href="<?php the_permalink();?>" class="more-link"><?php esc_html_e('Read More', 'event');?></a>
								<?php else: ?>
									<a title="<?php the_title();?>" href="<?php the_permalink();?>" class="more-link"><?php echo esc_attr($event_settings[ 'event_tag_text' ]);?></a>
								<?php endif;
							} ?>
							</div> <!-- end .feature-content -->
						</div><!-- end .three-column -->
					<?php endwhile; ?>
					</div><!-- .end column-->
				</div><!-- .container -->
			</div><!-- end .our-feature-box -->
		<?php }
	wp_reset_postdata();
	}
}
