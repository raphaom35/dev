<?php
/**
 * Theme Header Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
/**
 * This hook is important for wordpress plugins and other many things
 */
wp_head();
?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="inner-wrap">
				<div class="hgroup-wrap clearfix">
					<div class="site-branding">
						<?php if( ( get_theme_mod( 'esteem_show_header_logo_text', 'text_only' ) == 'both' || get_theme_mod( 'esteem_show_header_logo_text', 'text_only' ) == 'logo_only' ) ) {
						?>
							<div class="header-logo-image">
								<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
									the_custom_logo();
								} elseif ( get_theme_mod('esteem_header_logo_image', '') != '' ) { ?>
									<a rel="home" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo get_theme_mod( 'esteem_header_logo_image', '' ); ?>">
									</a>
								<?php } ?>
							</div><!-- .header-logo-image -->
						<?php }

                  		$screen_reader = '';
						if( get_theme_mod( 'esteem_show_header_logo_text', 'text_only' ) == 'logo_only' || get_theme_mod( 'esteem_show_header_logo_text', 'text_only' ) == 'none' ) {
                        	$screen_reader = 'screen-reader-text';
                  		}
						?>
							<div class="header-text <?php echo $screen_reader; ?>">
                        <?php if ( is_front_page() || is_home() ) : ?>
   								<h1 id="site-title">
   									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
   										<?php bloginfo( 'name' ); ?>
   									</a>
   								</h1>
                        <?php else : ?>
                           <h3 id="site-title">
                              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                 <?php bloginfo( 'name' ); ?>
                              </a>
                           </h3>
                        <?php endif; ?>
                        <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
   								<p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
							</div><!-- .header-text -->
					</div><!-- .site-branding -->
					<div class="hgroup-wrap-right">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h3 class="menu-toggle"></h3>
							<div class="nav-menu clearfix">
								<?php
									if ( has_nav_menu( 'primary' ) ) {
											wp_nav_menu( array( 'theme_location' => 'primary',
																'container' => false
																 ) );
									}
									else {
											wp_page_menu();
									}
								?>
							</div><!-- .nav-menu -->
						</nav><!-- #site-description -->
						<i class="icon-search search-top"></i>
						<div class="search-form-top">
							<?php get_search_form(); ?>
						</div><!-- .search-form-top -->
					</div><!-- .hgroup-wrap-right -->
				</div><!-- .hgroup-wrap -->
			</div><!-- .inner-wrap -->
			<?php esteem_render_header_image(); ?>

			<?php
   			if( get_theme_mod( 'esteem_activate_slider', '0' ) == '1' ) {
				if ( is_front_page() ) {
   					esteem_slider();
				}
   			}

			$esteem_slogan 				= get_theme_mod('esteem_slogan');
			$esteem_sub_slogan		 		= get_theme_mod('esteem_sub_slogan');
			$esteem_button_text 			= get_theme_mod('esteem_button_text');
			$esteem_button_redirect_link 	= get_theme_mod('esteem_button_redirect_link');
   			if ( is_front_page() && !empty( $esteem_slogan) && !empty( $esteem_sub_slogan ) ) { ?>
	   			<section id="promo-box">
	   				<div class="inner-wrap clearfix">
	   					<div class="promo-wrap">
	   						<?php if ( !empty( $esteem_slogan ) ) { ?>
			   					<div class="promo-title">
			   						<?php echo esc_html( $esteem_slogan ); ?>
			   					</div>
			   				<?php  } ?>

			   				<?php if ( !empty( $esteem_sub_slogan ) ) { ?>
			   					<div class="promo-text">
			   						<?php echo esc_html( get_theme_mod('esteem_sub_slogan') ); ?>
			   					</div>
			   				<?php  } ?>
		   				</div><!-- .promo-wrap -->
		   				<?php if ( !empty( $esteem_button_text ) && !empty( $esteem_button_redirect_link ) ) { ?>
	   					<a class="promo-action" title="<?php echo esc_attr( $esteem_button_text ); ?>" href="<?php echo esc_url( $esteem_button_redirect_link ); ?>"><?php echo esc_html( $esteem_button_text ); ?></a>
	   					<?php  } ?>
	   				</div>
	   			</section><!-- #promo-box -->
	   		<?php }
		   	if( !( is_front_page()) ) { ?>
				<section class="page-title-bar clearfix">
					<div class="inner-wrap">
						<?php if( '' != esteem_header_title() ) { ?>
                  <?php if ( is_home() ) : ?>
							<div class="page-title-wrap"><h2><?php echo esteem_header_title(); ?></h2></div>
                  <?php else : ?>
                     <div class="page-title-wrap"><h1><?php echo esteem_header_title(); ?></h1></div>
                  <?php endif; ?>
						<?php } ?>
						<?php if( function_exists( 'esteem_breadcrumb' ) ) { esteem_breadcrumb(); } ?>
					</div>
				</section>
			<?php } ?>
		</header><!-- #masthead -->
		<div id="main" class="site-main inner-wrap">
