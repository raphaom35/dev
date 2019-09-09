<?php
/**
 * Display all event functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'event_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function event_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'event' ),
		'social-link'  => __( 'Add Social Icons Only', 'event' ),
	) );

	/* 
	* Enable support for custom logo. 
	*
	*/ 
	add_theme_support( 'custom-logo', array(
		'flex-width' => true, 
		'flex-height' => true,
	) );

	//Indicate widget sidebars can use selective refresh in the Customizer. 
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'event_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css') );

	/**
	* Making the theme Woocommrece compatible
	*/

	add_theme_support( 'woocommerce' );
}
endif; // event_setup
add_action( 'after_setup_theme', 'event_setup' );

/***************************************************************************************/
function event_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'event_content_width' );

/***************************************************************************************/
if(!function_exists('event_get_theme_options')):
	function event_get_theme_options() {
	    return wp_parse_args(  get_option( 'event_theme_options', array() ), event_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/event-default-values.php';
require get_template_directory() . '/inc/settings/event-functions.php';
require get_template_directory() . '/inc/settings/event-common-functions.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/footer-details.php';

/************************ Event Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/contactus-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';

/************************ Event Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';
function event_customize_register( $wp_customize ) {
if(!class_exists('Event_Plus_Features')){
	class Event_Customize_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
			<a title="<?php esc_html_e( 'Review Event', 'event' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/event/' ); ?>" target="_blank" id="about_event">
			<?php esc_html_e( 'Review Event', 'event' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/event/' ); ?>" title="<?php esc_html_e( 'Theme Instructions', 'event' ); ?>" target="_blank" id="about_event">
			<?php esc_html_e( 'Theme Instructions', 'event' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/support-forum/' ); ?>" title="<?php esc_html_e( 'Forum', 'event' ); ?>" target="_blank" id="about_event">
			<?php esc_html_e( 'Forum', 'event' ); ?>
			</a><br/>
		<?php
		}
	}
	$wp_customize->add_section('event_upgrade_links', array(
		'title'					=> __('About Event', 'event'),
		'priority'				=> 2,
	));
	$wp_customize->add_setting( 'event_upgrade_links', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Event_Customize_upgrade(
		$wp_customize,
		'event_upgrade_links',
			array(
				'section'				=> 'event_upgrade_links',
				'settings'				=> 'event_upgrade_links',
			)
		)
	);
}	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'event_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'event_customize_partial_blogdescription',
		) );
	}
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php' ;
	require get_template_directory() . '/inc/customizer/functions/color-options.php' ;
}
if(!class_exists('Event_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}

	/* Color Styles */
	require get_template_directory() . '/inc/settings/color-option-functions.php' ;
/** 
* Render the site title for the selective refresh partial. 
* @see event_customize_register() 
* @return void 
*/ 
function event_customize_partial_blogname() { 
bloginfo( 'name' ); 
} 

/** 
* Render the site tagline for the selective refresh partial. 
* @see event_customize_register() 
* @return void 
*/ 
function event_customize_partial_blogdescription() { 
bloginfo( 'description' ); 
}
add_action( 'customize_register', 'event_customize_register' );
/**************************************************************************************/
function event_hide_previous_custom_css( $wp_customize ) { 
	// Bail if not WP 4.7. 
	if ( ! function_exists( 'wp_get_custom_css_post' ) ) { 
		return; 
	} 
		$wp_customize->remove_control( 'event_theme_options[event_custom_css]' ); 
} 
add_action( 'customize_register', 'event_hide_previous_custom_css'); 
/******************* Event Header Display *************************/
function event_header_display(){
	$event_settings = event_get_theme_options();
	$header_display = $event_settings['event_header_display'];
	if ($header_display == 'header_text') { ?>
		<div id="site-branding">
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
		<?php if(is_home() || is_front_page() || is_search()){ ?>
		</h1>  <!-- end .site-title -->
		<?php } else { ?> </h2> <!-- end .site-title --> <?php } 
		$site_description = get_bloginfo( 'description', 'display' );
		if($site_description){?>
		<p id ="site-description"> <?php bloginfo('description');?> </p> <!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php
	} elseif ($header_display == 'header_logo') { ?>
		<div id="site-branding"> <?php event_the_custom_logo(); ?></div> <!-- end #site-branding -->
		<?php } elseif ($header_display == 'show_both'){ ?>
		<div id="site-branding"> <?php event_the_custom_logo(); ?></a>
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
			<?php if(is_home() || is_front_page()){ ?> </h1> <!-- end .site-title -->
		<?php }else{ ?> </h2> <!-- end .site-title -->
		<?php }
		$site_description = get_bloginfo( 'description', 'display' );
			if($site_description){?>
			<p id ="site-description"> <?php bloginfo('description');?> </p><!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php }
}
add_action('event_site_branding','event_header_display');

if ( ! function_exists( 'event_the_custom_logo' ) ) : 
 	/** 
 	 * Displays the optional custom logo. 
 	 * Does nothing if the custom logo is not available. 
 	 */ 
 	function event_the_custom_logo() { 
 	    if ( function_exists( 'the_custom_logo' ) ) { 
 	        the_custom_logo(); 
 	    }
 	} 
 	endif;
/* Header Image */
function event_header_image_display(){
	$event_header_image = get_header_image();
	if(!empty($event_header_image)){ ?>
		<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($event_header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> </a>
	<?php }
}
add_action('event_header_image','event_header_image_display');

/* Event Template */
require get_template_directory() . '/inc/front-page/front-page-features.php';
require get_template_directory() . '/inc/front-page/upcoming-event.php';
require get_template_directory() . '/inc/front-page/our-speaker.php';
require get_template_directory() . '/inc/front-page/program-schedule.php';
require get_template_directory() . '/inc/front-page/our-gallery.php';
require get_template_directory() . '/inc/front-page/our-testimonial.php';