<?php
/**
 * edsBootstrap functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package edsBootstrap
 */

if ( ! function_exists( 'edsbootstrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function edsbootstrap_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on edsBootstrap, use a find and replace
	 * to change 'edsbootstrap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'edsbootstrap', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'edsbootstrap' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'video',
	) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'edsbootstrap_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'edsbootstrap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edsbootstrap_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'edsbootstrap_content_width', 900 );
}
add_action( 'after_setup_theme', 'edsbootstrap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function edsbootstrap_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'edsbootstrap' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'edsbootstrap' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'edsbootstrap' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'edsbootstrap' ),
		'before_widget' => '<div id="%1$s" class="col-md-3 col-xs-6 footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'edsbootstrap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function edsbootstrap_scripts() {
	wp_enqueue_style( 'edsbootstrap-raleway-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,300,600,500');
	wp_enqueue_style( 'edsbootstrap-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css');
    wp_enqueue_style( 'edsbootstrap-bootstrap-theme', get_template_directory_uri().'/assets/css/bootstrap-theme.css');
	wp_enqueue_style( 'edsbootstrap-font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css');
	wp_enqueue_style( 'edsbootstrap-owl-carousel', get_template_directory_uri().'/assets/css/owl.carousel.css');
	wp_enqueue_style( 'edsbootstrap-owl-theme', get_template_directory_uri().'/assets/css/owl.theme.css');
	wp_enqueue_style( 'edsbootstrap-owl-transitions', get_template_directory_uri().'/assets/css/owl.transitions.css');
  	wp_enqueue_style( 'edsbootstrap-magnific-popup', get_template_directory_uri().'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'edsbootstrap-elegant-icons', get_template_directory_uri().'/assets/css/elegant-icons.css');
	wp_enqueue_style( 'edsbootstrap-animate', get_template_directory_uri().'/assets/css/animate.css');
	wp_enqueue_style( 'edsbootstrap-style', get_stylesheet_uri() );
	
	wp_enqueue_script('edsbootstrap-bootstrap', get_template_directory_uri().'/assets/js/bootstrap.js',0,0,true);
	wp_enqueue_script('edsbootstrap-owl-carousel', get_template_directory_uri().'/assets/js/owl.carousel.js',0,0,true);
	wp_enqueue_script('edsbootstrap-jquery-stellar', get_template_directory_uri().'/assets/js/jquery.stellar.js',0,0,true);
	wp_enqueue_script('edsbootstrap-magnific-popup', get_template_directory_uri().'/assets/js/jquery.magnific-popup.js',0,0,true);
	wp_enqueue_script('edsbootstrap-animateNumber', get_template_directory_uri().'/assets/js/jquery.animateNumber.js',0,0,true);
	wp_enqueue_script('edsbootstrap-general', get_template_directory_uri().'/assets/js/general.js',0,0,true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'edsbootstrap_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */


require get_template_directory() . '/customizer/class-customize.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/wp-admin/edsbootstrap-admin-page.php';
}

/**
 * Load wp_bootstrap_navwalker file.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


/**
 * Load Custom Comment Layout ity file.
 */
require get_template_directory() . '/inc/comment-helper.php';

/** Include the TGM Plugin Activation class **/
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Registers an editor stylesheet for the theme.
 */
function eds_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'eds_theme_add_editor_styles' );



if( ! function_exists( 'edsbootstrap_spirit' ) ) {
	function edsbootstrap_spirit( $text ){
		$array = explode( ' ' , $text );
		$counter = count( $array );
		$last_word = array_pop( $array );
		unset( $array[ $counter ] );
		return implode(' ', $array) . ' <span class="text-theme">'. $last_word. '</span>';
	}
}


if( ! function_exists( 'edsbootstrap_remove_thumbnail_dimensions' ) ) {
	function edsbootstrap_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'edsbootstrap_remove_thumbnail_dimensions', 10, 3 );
}





add_action( 'tgmpa_register', 'edsbootstrap_register_required_plugins' );

/**
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function edsbootstrap_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Subtitles',
			'slug'      => 'subtitles',
			'required'  => false,
		),
		
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'edsbootstrap',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}

