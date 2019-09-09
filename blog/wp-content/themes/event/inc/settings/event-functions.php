<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('event_theme_options') ) {
		set_theme_mod( 'event_theme_options', event_get_option_defaults_values() );
	}
/********************* EVENT RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function event_responsiveness() {
	$event_settings = event_get_theme_options();
	if( $event_settings['event_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php } else{ ?>
	<meta name="viewport" content="width=1070" />
	<?php  }
}
add_filter( 'wp_head', 'event_responsiveness');

/******************************** EXCERPT LENGTH *********************************/
function event_excerpt_length($length) {
	$event_settings = event_get_theme_options();
	$event_excerpt_length = $event_settings['event_excerpt_length'];
	return absint($event_excerpt_length);
}
add_filter('excerpt_length', 'event_excerpt_length');

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function event_continue_reading() {
	 return '&hellip; '; 
}
add_filter('excerpt_more', 'event_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function event_body_class($event_class) {
	$event_settings = event_get_theme_options();
	$event_blog_layout = $event_settings['event_blog_layout'];
	$event_site_layout = $event_settings['event_design_layout'];
	if ($event_site_layout =='boxed-layout') {
		$event_class[] = 'boxed-layout';
	}
	if ($event_site_layout =='small-boxed-layout') {
		$event_class[] = 'boxed-layout-small';
	}
	if(!is_single()){
		if ($event_blog_layout == 'medium_image_display'){
			$event_class[] = "small_image_blog";
		}elseif($event_blog_layout == 'two_column_image_display'){
			$event_class[] = "two_column_blog";
		}else{
			$event_class[] = "";
		}
	}
	if(is_page_template('page-templates/event-corporate.php')) {
			$event_class[] = 'event-corporate';
	}
	return $event_class;
}
add_filter('body_class', 'event_body_class');

/********************** SCRIPTS FOR DONATE/ UPGRADE BUTTON ******************************/
function event_customize_scripts() {
	wp_enqueue_style( 'event_customizer_custom', get_template_directory_uri() . '/inc/css/event-customizer.css');
}
add_action( 'customize_controls_print_scripts', 'event_customize_scripts');

/**************************** SOCIAL MENU *********************************************/
function event_social_links_display() {
		if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif; ?>
<?php }
add_action ('event_social_links', 'event_social_links_display');

/******************* DISPLAY BREADCRUMBS ******************************/
function event_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}

/*********************** event PAGE SLIDERS ***********************************/
function event_sticky_post_sliders() {
	$event_settings = event_get_theme_options();
	$excerpt = get_the_excerpt();
	global $event_excerpt_length;
	$slider_custom_text = $event_settings['event_secondary_text'];
	$slider_custom_url = $event_settings['event_secondary_url'];
	global $post;
	$query 		= new WP_Query(array( 'post_type' => 'post', 'category__not_in' => !get_option( 'sticky_posts' )
,'post__in'  => get_option( 'sticky_posts' )));
	if($query->have_posts() && get_option( 'sticky_posts' )){
			$event_sticky_post_sliders_display = '';
			$event_sticky_post_sliders_display 	.= '<div class="main-slider"> <div class="layer-slider"><ul class="slides">';
					
					$j=1;
			while ($query->have_posts()):$query->the_post();
			$cats = get_the_category();
			$cat_name = $cats[0]->name;
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'event_slider_image');
						$title_attribute       	 	 = apply_filters('the_title', get_the_title(get_queried_object_id()));
						$excerpt               	 	 = get_the_excerpt();
				$event_sticky_post_sliders_display    	.= '<li>';
				if ($image_attributes) {
					$event_sticky_post_sliders_display 	.= '<div class="image-slider" title="'.the_title('', '', false).'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}else{
					$event_sticky_post_sliders_display 	.= '<div class="image-slider">';
				}
				if ($title_attribute != '' || $excerpt != '') {
					$event_sticky_post_sliders_display 	.= '<article class="slider-content">';
				}
					$event_sticky_post_sliders_display 	.= '<h4 class="slider-sub-title">'.esc_attr($cat_name).'</h4><!-- .slider-title -->';
				$remove_link = $event_settings['event_slider_link'];
					if($remove_link == 0){
						if ($title_attribute != '') {
							$event_sticky_post_sliders_display .= '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title('', '', false).'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';
						}
					}else{
						$event_sticky_post_sliders_display .= '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
					}
					if ($excerpt != '') {
						$excerpt_text = $event_settings['event_tag_text'];
						$event_sticky_post_sliders_display .= '<p class="slider-text">'.$excerpt.'</p><!-- end .slider-text -->';
						}
						$event_sticky_post_sliders_display 	.='<div class="slider-buttons">';
						if(!empty($slider_custom_text)){
							$event_sticky_post_sliders_display 	.= '<a title="'.esc_attr($slider_custom_text).'"' .' href="'.esc_url($slider_custom_url). '"'. ' class="btn-default vivid" target="_blank">'.esc_attr($slider_custom_text). '</a>';
						}
						if($event_settings['event_slider_button'] == 0){
							if($excerpt_text == '' || $excerpt_text == 'Read More') :
								$event_sticky_post_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default light">'.__('Read More', 'event').'</a>';
							else:
								$event_sticky_post_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default">'.$event_settings[ 'event_tag_text' ].'</a>';
							endif;
						}
					
						$event_sticky_post_sliders_display 	.= '</div>';
						$event_sticky_post_sliders_display 	.='</article><!-- end .slider-content --> ';

				$event_sticky_post_sliders_display 	.='</div><!-- end .image-slider -->';
				$j++;
			
			endwhile;
			wp_reset_postdata();
			$event_sticky_post_sliders_display .= '</ul><!-- end .slides -->
				</div> <!-- end .layer-slider -->
			</div> <!-- end .main-slider -->';
				echo $event_sticky_post_sliders_display;
			}
}
/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function event_scripts() {
	$event_settings = event_get_theme_options();
	wp_enqueue_style( 'event-style', get_stylesheet_uri() );
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
	wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'));
	wp_enqueue_script('event-slider', get_template_directory_uri().'/js/event-flexslider-setting.js', array('jquery-flexslider'));
	$event_animation_effect   = esc_attr($event_settings['event_animation_effect']);
	$event_slideshowSpeed    = absint($event_settings['event_slideshowSpeed'])*1000; // Set the speed of the slideshow cycling, in milliseconds
	$event_animationSpeed = absint($event_settings['event_animationSpeed'])*100; //Set the speed of animations, in milliseconds
	$event_direction = esc_attr($event_settings['event_direction']);
	wp_localize_script(
		'event-slider',
		'event_slider_value',
		array(
			'event_animation_effect'   => $event_animation_effect,
			'event_slideshowSpeed'    => $event_slideshowSpeed,
			'event_animationSpeed' => $event_animationSpeed,
			'event_direction' => $event_direction,
		)
	);
	 wp_enqueue_script( 'event-slider' );
	wp_enqueue_script('event-main', get_template_directory_uri().'/js/event-main.js', array('jquery'), false, true);
	$event_stick_menu = $event_settings['event_stick_menu'];
	if($event_stick_menu != 1):
		wp_enqueue_script('jquery-sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
	wp_enqueue_script('event-sticky-settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);
	endif;
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'event-html5', 'conditional', 'lt IE 9' );
	
	wp_style_add_data('event-ie', 'conditional', 'lt IE 9');
	if( $event_settings['event_responsive'] == 'on' ) {
		wp_enqueue_style('event-responsive', get_template_directory_uri().'/css/responsive.css');
	}
	/********* Adding Fonts ********************/
	wp_register_style( 'event_google_fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700,300' );
	wp_enqueue_style( 'event_google_fonts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	/* Custom Css */
	$event_internal_css='';
	if ($event_settings['event_slider_content_bg_color'] =='on'){
		$event_internal_css .= '.slider-content {
		background-color: rgba(0, 0, 0, 0.3);
		padding: 40px;
		z-index: 1;
		}
		.slider-content:before {
			border: 1px solid rgba(255, 255, 255, 0.2);
			bottom: 8px;
			content: "";
			display: block;
			left: 11px;
			position: absolute;
			right: 11px;
			top: 8px;
			z-index: -1;
		}
		.slider-content:after {
			border: 1px solid rgba(255, 255, 255, 0.2);
			bottom: 11px;
			content: "";
			display: block;
			left: 8px;
			position: absolute;
			right: 8px;
			top: 11px;
			z-index: -1;
		}';
	}
	if ($event_settings['event_hide_event_archive'] == 1){
		$event_internal_css .= '.post-type-archive-tribe_events .page-header{
			display:none;
		}';
	}
	wp_add_inline_style( 'event-style', wp_strip_all_tags($event_internal_css) );
}
add_action( 'wp_enqueue_scripts', 'event_scripts' );
/*************************** Importing Custom CSS to the core option added in WordPress 4.7. ****************************************/
function event_custom_css_migrate(){
$ver = get_theme_mod( 'custom_css_version', false );
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$event_settings = event_get_theme_options();
		if ( $event_settings['event_custom_css'] != '' ) {
			$event_core_css = wp_get_custom_css(); // Preserve css which is added from core
			$return   = wp_update_custom_css_post( $event_core_css . $event_settings['event_custom_css'] );
			if ( ! is_wp_error( $return ) ) {
				unset( $event_settings['event_custom_css'] );
				set_theme_mod( 'event_theme_options', $event_settings );
				set_theme_mod( 'custom_css_version', '4.7' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'event_custom_css_migrate' );