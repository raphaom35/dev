<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package 	ThemeGrill
 * @subpackage 	Esteem
 * @since 		Esteem 1.0
 */

/****************************************************************************************/
// Filter the get_header_image_tag() for option of adding the link back to home page option
function esteem_header_image_markup( $html, $header, $attr ) {
	$output = '';
	$header_image = get_header_image();

	if( ! empty( $header_image ) ) {
		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
	}

	return $output;
}

function esteem_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'esteem_header_image_markup', 10, 3 );
}

add_action( 'esteem_header_image_markup_render','esteem_header_image_markup_filter' );

/****************************************************************************************/

if ( ! function_exists( 'esteem_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function esteem_render_header_image() {
	if ( function_exists( 'the_custom_header_markup' ) ) {
		do_action( 'esteem_header_image_markup_render' );
		the_custom_header_markup();
	} else {
		$header_image = get_header_image();
		if( ! empty( $header_image ) ) {
		?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		<?php
		}
	}
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'esteem_slider' ) ) :
/**
 * display featured post slider
 */
function esteem_slider() { ?>
	<div class="slider-wrap">
		<div class="slider-cycle">
			<?php
			for( $i = 1; $i <= 4; $i++ ) {
				$esteem_slider_title = get_theme_mod( 'esteem_slider_title'.$i , '' );
				$esteem_slider_text = get_theme_mod( 'esteem_slider_text'.$i , '' );
				$esteem_slider_image = get_theme_mod( 'esteem_slider_image'.$i , '' );
				$esteem_slider_link = get_theme_mod( 'esteem_slider_link'.$i , '#' );

				if( !empty( $esteem_slider_image ) ) {
					if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
					?>
					<section id="featured-slider" class="<?php echo $classes; ?>">
						<figure class="slider-image-wrap">
							<img alt="<?php echo esc_attr( $esteem_slider_title ); ?>" src="<?php echo esc_url( $esteem_slider_image ); ?>">
					    </figure>
					    <?php if( !empty( $esteem_slider_title ) || !empty( $esteem_slider_text ) ) { ?>
						    <article id="slider-text-box">
					    		<div class="inner-wrap">
						    		<div class="slider-text-wrap">
						    			<?php if( !empty( $esteem_slider_title )  ) { ?>
							     			<span id="slider-title" class="clearfix"><a title="<?php echo esc_attr( $esteem_slider_title ); ?>" href="<?php echo esc_url( $esteem_slider_link ); ?>"><?php echo esc_html( $esteem_slider_title ); ?></a></span>
							     		<?php } ?>
							     		<?php if( !empty( $esteem_slider_text )  ) { ?>
							     			<span id="slider-content"><?php echo esc_html( $esteem_slider_text ); ?></span>
							     		<?php } ?>
							     	</div>
							    </div>
							</article>
						<?php } ?>
					</section><!-- .featured-slider -->
				<?php
				}
			}
			?>
		</div>
		<nav id="controllers" class="clearfix">
		</nav><!-- #controllers -->
	</div><!-- .slider-cycle -->
<?php
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'esteem_header_title' ) ) :
/**
 * Show the title in header
 */
function esteem_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$esteem_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$esteem_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$esteem_header_title =  sprintf( __( 'Author: %s', 'esteem' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_day() ) :
			$esteem_header_title = sprintf( __( 'Day: %s', 'esteem' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			$esteem_header_title = sprintf( __( 'Month: %s', 'esteem' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			$esteem_header_title = sprintf( __( 'Year: %s', 'esteem' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		else :
			$esteem_header_title = __( 'Archives', 'esteem' );

		endif;
	}
	elseif( is_404() ) {
		$esteem_header_title = __( 'Page NOT Found', 'esteem' );
	}
	elseif( is_search() ) {
		$esteem_header_title = __( 'Search Results', 'esteem' );
	}
	elseif( is_page() ) {
		$esteem_header_title = get_the_title();
	}
	elseif( is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		$esteem_header_title = get_the_title( $page_for_posts );
	}
	elseif( is_single()  ) {
		$esteem_header_title = get_the_title();
	}
	else {
		$esteem_header_title = '';
	}

	return $esteem_header_title;

}
endif;

/****************************************************************************************/

if ( ! function_exists( 'esteem_breadcrumb' ) ) :
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function esteem_breadcrumb() {
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
		echo '<span class="breadcrumb-title">'.__( 'You are here:', 'esteem' ).'</span>';
		bcn_display();
		echo '</div> <!-- .breadcrumb -->';
	}
}
endif;
?>
