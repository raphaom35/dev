<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$event_settings = event_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
<!-- Masthead ============================================= -->
<header id="masthead" class="site-header" role="banner">
<?php 
if($event_settings['event_header_image_display'] =='top'){
	do_action('event_header_image');
}?>
		<div class="top-header">
			<div class="container clearfix">
				<?php
				if( is_active_sidebar( 'event_header_info' )) {
					dynamic_sidebar( 'event_header_info' );
				}
				if($event_settings['event_top_social_icons'] == 0):
					echo '<div class="header-social-block">';
						do_action('event_social_links');
					echo '</div>'.'<!-- end .header-social-block -->';
				endif; ?>
			</div> <!-- end .container -->
		</div> <!-- end .top-header -->
		<?php 
if($event_settings['event_header_image_display'] =='bottom'){
	do_action('event_header_image');
}?>
		<!-- Main Header============================================= -->
				<div id="sticky-header" class="clearfix">
					<div class="container clearfix">
					<?php
						do_action('event_site_branding'); ?>	
						<!-- Main Nav ============================================= -->
						<div class="menu-toggle">			
							<div class="line-one"></div>
							<div class="line-two"></div>
							<div class="line-three"></div>
						</div><!-- end .menu-toggle -->
						<?php
						if (has_nav_menu('primary')) { ?>
						<?php $args = array(
							'theme_location' => 'primary',
							'container'      => '',
							'items_wrap'     => '<ul class="menu">%3$s</ul>',
							); ?>
						<nav id="site-navigation" class="main-navigation clearfix">

							<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
						</nav> <!-- end #site-navigation -->
						<?php } else {// extract the content from page menu only ?>
						<nav id="site-navigation" class="main-navigation clearfix">
							<?php	wp_page_menu(array('menu_class' => 'menu')); ?>
						</nav> <!-- end #site-navigation -->
						<?php }
						$search_form = $event_settings['event_search_custom_header'];
						if (1 != $search_form) { ?>
							<div id="search-toggle" class="header-search"></div>
							<div id="search-box" class="clearfix">
								<?php get_search_form();?>
							</div>  <!-- end #search-box -->
						<?php } ?>
					</div> <!-- end .container -->
				</div> <!-- end #sticky-header -->
				<?php
				$enable_slider = $event_settings['event_enable_slider'];
						if ($enable_slider=='frontpage'|| $enable_slider=='enitresite'){
							 if(is_front_page() && ($enable_slider=='frontpage') ) {
								if($event_settings['event_slider_type'] == 'default_slider') {
										event_sticky_post_sliders();
								}else{
									if(class_exists('Event_Plus_Features')):
										do_action('event_image_sliders');
									endif;
								}
							}
							if($enable_slider=='enitresite'){
								if($event_settings['event_slider_type'] == 'default_slider') {
										event_sticky_post_sliders();
								}else{
									if(class_exists('Event_Plus_Features')):
										do_action('event_image_sliders');
									endif;
								}
							}
						} ?>
</header> <!-- end #masthead -->
<!-- Main Page Start ============================================= -->
<div id="content">
<?php if(!is_page_template('page-templates/event-corporate.php') ){ ?>
	<div class="container clearfix">
	<?php 
}
if(!(is_front_page() || is_page_template('page-templates/event-corporate.php') ) ){
	$custom_page_title = apply_filters( 'event_filter_title', '' ); ?>
		<div class="page-header">
		<?php if(is_home() ){ ?>
			<h2 class="page-title"><?php  echo event_title(); ?></h2>
		<?php }else{ ?>
			<h1 class="page-title"><?php  echo event_title(); ?></h1>
		<?php } ?>
			<!-- .page-title -->
			<?php event_breadcrumb(); ?>
			<!-- .breadcrumb -->
		</div>
		<!-- .page-header -->
<?php }
if(is_page_template('upcoming-event-template.php') || is_page_template('program-schedule-template.php') ){
 	echo '</div><!-- end .container -->';
}