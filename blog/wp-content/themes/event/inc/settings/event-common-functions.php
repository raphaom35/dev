<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
/****************** EVENT DISPLAY COMMENT NAVIGATION *******************************/
function event_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'event' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'event' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;
				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'event' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
/******************** Remove div and replace with ul**************************************/
add_filter('wp_page_menu', 'event_wp_page_menu');
function event_wp_page_menu($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass   = $matches[1];
	$replace    = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup;
}
/**************************** Display Header Title ***********************************/
function event_title() {
	$format = get_post_format();
	$event_settings = event_get_theme_options();
	$title='';
	if( is_archive() ) {
		if ( is_category() ) :
			$title = single_cat_title( '', FALSE );
		elseif ( is_tag() ) :
				$title = single_tag_title( '', FALSE );
		elseif ( is_author() ) :
			the_post();
			$title =  sprintf( __( 'Author: %s', 'event' ), '<span class="vcard">' . get_the_author() . '</span>' );
			rewind_posts();
		elseif ( is_day() ) :
			$title = sprintf( __( 'Day: %s', 'event' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			$title = sprintf( __( 'Month: %s', 'event' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif ( is_year() ) :
			$title = sprintf( __( 'Year: %s', 'event' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		elseif ( $format == 'audio' ) :
			$title = __( 'Audios', 'event' );
		elseif ( $format =='aside' ) :
			$title = __( 'Asides', 'event');
		elseif ( $format =='image' ) :
			$title = __( 'Images', 'event' );
		elseif ( $format =='gallery' ) :
			$title = __( 'Galleries', 'event' );
		elseif ( $format =='video' ) :
			$title = __( 'Videos', 'event' );
		elseif ( $format =='status' ) :
			$title = __( 'Status', 'event' );
		elseif ( $format =='quote' ) :
			$title = __( 'Quotes', 'event' );
		elseif ( $format =='link' ) :
			$title = __( 'links', 'event' );
		elseif ( $format =='chat' ) :
			$title = __( 'Chats', 'event' );
		elseif ( class_exists('WooCommerce') && (is_shop() || is_product_category()) ):
  			$title = woocommerce_page_title( false );
  		elseif ( class_exists('bbPress') && is_bbpress()) :
  			$title = get_the_title();
		else :
			$title = get_the_archive_title();
		endif;
	} elseif (is_home()){
		$title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$title = __('Page NOT Found', 'event');
	} elseif (is_search()) {
		$title = __('Search Results', 'event');
	} else {
		$title = get_the_title();
	}
	return $title;
}
/********************* Custom Header setup ************************************/
function event_custom_header_setup() {
	$args = array(
		'default-text-color'     => '',
		'default-image'          => '',
		'height'                 => apply_filters( 'event_header_image_height', 400 ),
		'width'                  => apply_filters( 'event_header_image_width', 2500 ),
		'random-default'         => false,
		'max-width'              => 2500,
		'flex-height'            => true,
		'flex-width'             => true,
		'random-default'         => false,
		'header-text'				 => false,
		'uploads'				 => true,
		'wp-head-callback'       => '',
		'admin-preview-callback' => 'event_admin_header_image',
		'default-image' => '',
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'event_custom_header_setup' );