<?php /**
 * Register color schemes for Event.
 *
 * Can be filtered with {@see 'event_color_schemes'}.
 *
 * The order of colors in a colors array:
 * @since Event 1.1
 *
 * @return array An associative array of color scheme options.
 */
function event_get_color_schemes() {
	return apply_filters( 'event_color_schemes', array(
		'default_color' => array(
			'label'  => __( '--Default--', 'event' ),
			'colors' => array(
				'#dc143c',
				'#dc143c',
				'#dc143c',
				'#dc143c',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'event' ),
			'colors' => array(
				'#dc143c',
				'#111111',
				'#111111',
				'#111111',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'event' ),
			'colors' => array(
				'#dc143c',
				'#ffae00',
				'#ffae00',
				'#ffae00',
			),
		),
		'pink'    => array(
			'label'  => __( 'Red', 'event' ),
			'colors' => array(
				'#dc143c',
				'#ff0000',
				'#ff0000',
				'#ff0000',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'event' ),
			'colors' => array(
				'#dc143c',
				'#009eed',
				'#009eed',
				'#009eed',
			),
		),
		'purple'   => array(
			'label'  => __( 'Purple', 'event' ),
			'colors' => array(
				'#dc143c',
				'#9651cc',
				'#9651cc',
				'#9651cc',
			),
		),
		'vanburenborwn'    => array(
			'label'  => __( 'Van Buren Brown', 'event' ),
			'colors' => array(
				'#dc143c',
				'#a57a6b',
				'#a57a6b',
				'#a57a6b',
			),
		),
		'green'    => array(
			'label'  => __( 'Green', 'event' ),
			'colors' => array(
				'#dc143c',
				'#40ff00',
				'#40ff00',
				'#40ff00',
			),
		),
	) );
}

if ( ! function_exists( 'event_get_color_scheme' ) ) :
/**
 * Get the current Event color scheme.
 *
 * @since Event 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function event_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );
	$color_schemes       = event_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default_color']['colors'];
}
endif;

if ( ! function_exists( 'event_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Event.
 *
 * @since Event 1.0
 *
 * @return array Array of color schemes.
 */
function event_get_color_scheme_choices() {
	$color_schemes                = event_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // event_get_color_scheme_choices

if ( ! function_exists( 'event_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Event 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function event_sanitize_color_scheme( $value ) {
	$color_schemes = event_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default_color';
	}

	return $value;
}
endif; // event_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Event 1.0
 *
 * @see wp_add_inline_style()
 */
function event_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );

	// Don't do anything if the default_color color scheme is selected.
	if ( 'default_color' === $color_scheme_option ) {
		return;
	}

	$color_scheme = event_get_color_scheme();

	$colors = array(
		'site_page_nav_link_title_color'        => get_theme_mod('site_page_nav_link_title_color',$color_scheme[3]),
		'event_button_color'    => get_theme_mod('event_button_color',$color_scheme[3]),
		'event_feature_box_color'    => get_theme_mod('event_feature_box_color',$color_scheme[3]),
		'event_team_box_color'    => get_theme_mod('event_team_box_color',$color_scheme[3]),
		'event_schedule_list_box_color'    => get_theme_mod('event_schedule_list_box_color',$color_scheme[3]),
		'event_bbpress_woocommerce_color'        => get_theme_mod('event_bbpress_woocommerce_color',$color_scheme[3]),
	);

	$color_scheme_css = event_get_color_scheme_css( $colors );

	wp_add_inline_style( 'event-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'event_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Event 1.0
 */
function event_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls' ), '20160824', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', event_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'event_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Event 1.0.4
 */
function event_customize_preview_js() {
	wp_enqueue_script( 'event-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160824', true );
}

add_action( 'customize_preview_init', 'event_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Event 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function event_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'site_page_nav_link_title_color'        => '#dc143c',
		'event_button_color'    => '#dc143c',
		'event_feature_box_color'        => '#dc143c',
		'event_team_box_color'        => '#dc143c',
		'event_schedule_list_box_color'        => '#dc143c',
		'event_bbpress_woocommerce_color'        => '#dc143c',
		
	) );
	$css = <<<CSS
	/****************************************************************/
						/*.... Color Style ....*/
	/****************************************************************/
	/* Nav, links and hover */

	a,
	ul li a:hover,
	ol li a:hover,
	.top-header .widget_contact ul li a:hover, /* Top Header Widget Contact */
	.main-navigation a:hover, /* Navigation */
	.main-navigation ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor a,
	.main-navigation ul li.current-menu-ancestor a,
	.main-navigation ul li.current_page_item a,
	.main-navigation ul li:hover > a,
	.main-navigation li.current-menu-ancestor.menu-item-has-children > a:after,
	.main-navigation li.menu-item-has-children > a:hover:after,
	.main-navigation li.page_item_has_children > a:hover:after,
	.main-navigation ul li ul li a:hover,
	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li.current-menu-item ul li a:hover,
	.header-search:hover, .header-search-x:hover, /* Header Search Form */
	.entry-title a:hover, /* Post */
	.entry-title a:focus,
	.entry-title a:active,
	.entry-meta span:hover,
	.entry-meta a:hover,
	.widget ul li a:hover, /* Widgets */
	.widget-title a:hover,
	.widget_contact ul li a:hover,
	.our-team .member-post, /* Our Team Box */
	.site-info .copyright a:hover, /* Footer */
	#colophon .widget ul li a:hover,
	#footer-navigation a:hover {
		color:  {$colors['site_page_nav_link_title_color']};
	}
	.btn-eff:after,
	.entry-format,
	#colophon .widget-title:before,
	#colophon .widget-title:after {
		background-color:  {$colors['site_page_nav_link_title_color']};
	}
	/* Webkit */
	::selection {
		background:  {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}
	/* Gecko/Mozilla */
	::-moz-selection {
		background:  {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}

	/* Accessibility
	================================================== */
	.screen-reader-text:hover,
	.screen-reader-text:active,
	.screen-reader-text:focus {
		background-color: #f1f1f1;
		color:  {$colors['site_page_nav_link_title_color']};
	}

	/* Buttons reset, button, submit */

	input[type="reset"],/* Forms  */
	input[type="button"],
	input[type="submit"],
	.go-to-top a:hover {
		background-color:{$colors['event_button_color']};
	}
	/* Buttons reset, button, submit */

	input[type="reset"],/* Forms  */
	input[type="button"],
	input[type="submit"],
	a.more-link:after,
	.go-to-top .icon-bg {
		background-color:{$colors['event_button_color']};
	}

	/* Default Buttons */
	.btn-default:hover,
	.vivid,
	.search-submit {
		background-color: {$colors['event_button_color']};
		border: 1px solid {$colors['event_button_color']};
	}

	/* -_-_-_ Not for change _-_-_- */
	.light-color:hover,
	.vivid:hover {
		background-color: #fff;
		border: 1px solid #fff;
	}
	/* Our Feature Box
	================================================== */
	.feature-content:hover .feature-icon,
	.feature-content a.more-link:after {
		background-color: {$colors['event_feature_box_color']};
	}
	.our-feature-box .feature-title a:hover,
	.feature-content a.more-link {
		color: {$colors['event_feature_box_color']};
	}

	/* Our Team Box
	================================================== */
	.our-team .member-post {
		color: {$colors['event_team_box_color']};
	}
	.our-team:hover .speaker-topic-title h4 {
		background-color: {$colors['event_team_box_color']};
	}

	/* Schedule List Box
	================================================== */
	.schedule-list-box .box-title:before,
	.list-nav li:hover,
	.list-nav li.current,
	.schedule-list a.more-link:hover {
		color: {$colors['event_schedule_list_box_color']};
	}
	.list-nav li.current:after {
		background-color: {$colors['event_schedule_list_box_color']};
	}
}
	/* #bbpress
	================================================== */
	#bbpress-forums .bbp-topics a:hover {
		color: {$colors['event_bbpress_woocommerce_color']};
	}
	.bbp-submit-wrapper button.submit {
		background-color: {$colors['event_bbpress_woocommerce_color']};
		border: 1px solid {$colors['event_bbpress_woocommerce_color']};
	}

	/* Woocommerce
	================================================== */
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce-demo-store p.demo_store {
		background-color: {$colors['event_bbpress_woocommerce_color']};
	}
	.woocommerce .woocommerce-message:before {
		color: {$colors['event_bbpress_woocommerce_color']};
	}

CSS;

	return $css;
}
function event_color_scheme_css_template() {
	$colors = array(

		// Color Styles
		'site_page_nav_link_title_color'        => '{{ data.site_page_nav_link_title_color }}',
		'event_button_color'    => '{{ data.event_button_color }}',
		'event_feature_box_color'    => '{{ data.event_feature_box_color }}',
		'event_team_box_color'    => '{{ data.event_team_box_color }}',
		'event_schedule_list_box_color'    => '{{ data.event_schedule_list_box_color }}',
		'event_bbpress_woocommerce_color'        => '{{ data.event_bbpress_woocommerce_color }}',
	);
	?>
	<script type="text/html" id="tmpl-event-color-scheme">
		<?php echo event_get_color_scheme_css( $colors ); ?>
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'event_color_scheme_css_template' );