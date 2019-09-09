<?php
/**
 * Esteem functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 642;

/**
 * $content_width global variable adjustment as per layout option.
 */
function esteem_content_width() {
   global $post;
   global $content_width;

   if( $post ) { $layout_meta = get_post_meta( $post->ID, '_esteem_layout', true ); }
   if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
   $esteem_default_layout = get_theme_mod( 'esteem_default_layout', 'right_sidebar' );

   if( $layout_meta == 'default_layout' ) {
      if ( $esteem_default_layout == 'no_sidebar_full_width' ) { $content_width = 978; /* pixels */ }
      else { $content_width = 642; /* pixels */ }
   }
   elseif ( $layout_meta == 'no_sidebar_full_width' ) { $content_width = 978; /* pixels */ }
   else { $content_width = 642; /* pixels */ }
}
add_action( 'template_redirect', 'esteem_content_width' );

add_action( 'after_setup_theme', 'esteem_setup' );

if( !function_exists( 'esteem_setup' ) ) :
/**
 * Adding the core functionality of WordPress.
 *
 * @since 1.0
 */
function esteem_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'esteem', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );

	// Supporting title tag via add_theme_support (since WordPress 4.1)
   add_theme_support( 'title-tag' );

	// Adds the support for the Custom Logo introduced in WordPress 4.5
	add_theme_support( 'custom-logo',
		array(
	    	'flex-width' => true,
	    	'flex-height' => true,
	   	)
	);

   // Added WooCommerce support.
   add_theme_support( 'woocommerce' );

	// Switches default core markup for comment form, and comments
	// to output valid HTML5.
   add_theme_support('html5', array(
       'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
   ));

	// Registering navigation menus.
	register_nav_menu( 'primary', 'Primary Menu' );

	// Cropping images to different sizes to be used in the theme
	add_image_size( 'blog-large', 642, 300, true ); 				// used on blog large template
	add_image_size( 'blog-medium', 306, 205, true ); 				// used on blog medium template
	add_image_size( 'recent-thumb', 350, 316, true );
	add_image_size( 'service-featured', 600, 330, true );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'esteem_custom_background_args', array(
		'default-color' => 'eaeaea'
	) ) );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );
}
endif;

add_action('after_setup_theme', 'esteem_options_migrate', 12);
if( !function_exists( 'esteem_options_migrate' ) ) :
/**
 * Migrate Options Framework data to Customizer
 *
 */
function esteem_options_migrate() {

	// Shifting Users data from Theme Option to Customizer
	if ( get_option( 'esteem_customizer_transfer' ) )
	   return;

	// Set transfer
	update_option( 'esteem_customizer_transfer', 1 );

	$esteem_themename = get_option( 'stylesheet' );
	$esteem_themename_preg = preg_replace("/\W/", "_", strtolower($esteem_themename) );
	if ( false === ( $mods = get_option( $esteem_themename_preg ) ) )
	   return;

	$esteem_theme_options = array();
	$esteem_theme_mods = array();

	// When child theme is active.
	if( is_child_theme() ) {
		$esteem_theme_options = get_option( $esteem_themename_preg );
		$esteem_theme_mods = get_theme_mods();

		foreach($esteem_theme_options as $key => $value ){
			$esteem_theme_mods[ $key ] = $value;
		}
		update_option( 'theme_mods_'. $esteem_themename, $esteem_theme_mods );
	}
	// For parent theme data Transfer
	if ( false !== ( $mods = get_option( 'esteem' ) ) ) {
		$esteem_theme_options = get_option( 'esteem' );
		$esteem_theme_mods = get_option( 'theme_mods_esteem' );

		foreach($esteem_theme_options as $key => $value ){
			$esteem_theme_mods[ $key ] = $value;
		}

		update_option( 'theme_mods_esteem', $esteem_theme_mods );
	}
}
endif;

/**
 * esteem_init hook
 *
 * Hooking some functions of functions.php file to this action hook.
 */


add_action( 'esteem_init', 'esteem_constants', 10 );

if( !function_exists( 'esteem_constants' ) ) {
/**
 * This function defines the Esteem theme constants
 *
 * @since 1.0
 */
function esteem_constants() {
	/**
	 * Define Directory Location Constants
	 */
	define( 'ESTEEM_PARENT_DIR', get_template_directory() );
	define( 'ESTEEM_CHILD_DIR', get_stylesheet_directory() );

	define( 'ESTEEM_IMAGES_DIR', ESTEEM_PARENT_DIR . '/images' );
	define( 'ESTEEM_INCLUDES_DIR', ESTEEM_PARENT_DIR. '/inc' );
	define( 'ESTEEM_CSS_DIR', ESTEEM_PARENT_DIR . '/css' );
	define( 'ESTEEM_JS_DIR', ESTEEM_PARENT_DIR . '/js' );
	define( 'ESTEEM_LANGUAGES_DIR', ESTEEM_PARENT_DIR . '/languages' );

	define( 'ESTEEM_ADMIN_DIR', ESTEEM_INCLUDES_DIR . '/admin' );
	define( 'ESTEEM_EXTENSIONS_DIR', ESTEEM_INCLUDES_DIR . '/extensions' );
	define( 'ESTEEM_SHORTCODES_DIR', ESTEEM_INCLUDES_DIR . '/shortcodes' );
	define( 'ESTEEM_WIDGETS_DIR', ESTEEM_INCLUDES_DIR . '/widgets' );

	define( 'ESTEEM_ADMIN_IMAGES_DIR', ESTEEM_ADMIN_DIR . '/images' );
	define( 'ESTEEM_ADMIN_JS_DIR', ESTEEM_ADMIN_DIR . '/js' );
	define( 'ESTEEM_ADMIN_CSS_DIR', ESTEEM_ADMIN_DIR . '/css' );

	define( 'ESTEEM_FONTAWESOME_DIR', ESTEEM_PARENT_DIR . '/fontawesome' );

	/**
	 * Define URL Location Constants
	 */
	define( 'ESTEEM_PARENT_URL', get_template_directory_uri() );
	define( 'ESTEEM_CHILD_URL', get_stylesheet_directory_uri() );

	define( 'ESTEEM_IMAGES_URL', ESTEEM_PARENT_URL . '/images' );
	define( 'ESTEEM_INCLUDES_URL', ESTEEM_PARENT_URL. '/inc' );
	define( 'ESTEEM_CSS_URL', ESTEEM_PARENT_URL . '/css' );
	define( 'ESTEEM_JS_URL', ESTEEM_PARENT_URL . '/js' );
	define( 'ESTEEM_LANGUAGES_URL', ESTEEM_PARENT_URL . '/languages' );

	define( 'ESTEEM_ADMIN_URL', ESTEEM_INCLUDES_URL . '/admin' );
	define( 'ESTEEM_EXTENSIONS_URL', ESTEEM_INCLUDES_URL . '/extensions' );
	define( 'ESTEEM_SHORTCODES_URL', ESTEEM_INCLUDES_URL . '/shortcodes' );
	define( 'ESTEEM_WIDGETS_URL', ESTEEM_INCLUDES_URL . '/widgets' );

	define( 'ESTEEM_ADMIN_IMAGES_URL', ESTEEM_ADMIN_URL . '/images' );
	define( 'ESTEEM_ADMIN_JS_URL', ESTEEM_ADMIN_URL . '/js' );
	define( 'ESTEEM_ADMIN_CSS_URL', ESTEEM_ADMIN_URL . '/css' );
}
}

add_action( 'esteem_init', 'esteem_include_files', 15 );

if( !function_exists( 'esteem_include_files' ) ) {
/**
 * Including the required files.
 *
 * @since 1.0
 */
function esteem_include_files() {

	/** Load functions */
	require_once( ESTEEM_INCLUDES_DIR . '/functions.php' );

	require_once( ESTEEM_INCLUDES_DIR . '/custom-header.php' );

	require_once( ESTEEM_FONTAWESOME_DIR . '/icons.php' );

	require_once( ESTEEM_ADMIN_DIR . '/meta-boxes.php' );

	/** Load Extensions files */
	require_once( ESTEEM_INCLUDES_DIR . '/header-functions.php' );

	/** Load Widgets and Widgetized Area */
	require_once( ESTEEM_WIDGETS_DIR . '/widgets.php' );

	/** Customizer */
	require_once( ESTEEM_INCLUDES_DIR . '/customizer.php' );

}
}
do_action( 'esteem_init' );


/**
 * Assign the Esteem version to a variable.
 */
$theme            = wp_get_theme( 'esteem' );
$esteem_version = $theme['Version'];

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-esteem-admin.php';
}

?>
