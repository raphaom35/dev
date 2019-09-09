<?php
$banner_img = get_template_directory_uri() . '/images/banner.jpg';
function matrix_customizer_preview_js()
{
    wp_enqueue_script('custom_css_preview', get_template_directory_uri() . '/js/customize-preview.js', array('customize-preview', 'jquery'));
}
add_action('customize_preview_init', 'matrix_customizer_preview_js');
/* Modifying existing controls */
add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '#alogo',
		'render_callback' => function(){
			bloginfo( 'name' );
		},
	) );
	
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => function(){
			bloginfo( 'description' );
		},
	) );
} );
$matrix_theme_options = matrix_theme_options();
function matrix_partial_refresh_service_head(){
	$matrix_theme_options = matrix_theme_options();
	echo '<h1 id="service-head">'.$matrix_theme_options['home_service_title'].'</h1>';
}
function matrix_partial_refresh_service_desc(){
	$matrix_theme_options = matrix_theme_options();
	echo '<p id="service-desc">'.$matrix_theme_options['home_service_description'].'</p>';
}
function matrix_partial_refresh_service_icon($i){
	$act='';
	$matrix_theme_options = matrix_theme_options();
	$out = '<div id="service_box_'.$i.'" class="service-icon">';
	$out.= '<i id="service-icon-'.esc_attr($i).'" class="'.esc_attr($matrix_theme_options['service_icon_'.$i]).' icon-large"></i>';
	$out.='</div>';
	echo $out;
}
function matrix_partial_refresh_service_title($i){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<h4 id="service-title-'.esc_attr($i).'" >'.esc_attr($matrix_theme_options['service_title_'.$i]).'</h4>';
}
function matrix_partial_refresh_service_text($i){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<p id="service-desc-'.esc_attr($i).'" >'.esc_attr($matrix_theme_options['service_text_'.$i]).'</p>';	
}
function matrix_partial_refresh_callout_desc(){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<span id="banner_desc" >'.esc_attr($matrix_theme_options['home_callout_description']).'</span>';	
}
function matrix_partial_refresh_callout_btn($i){
	$matrix_theme_options = matrix_theme_options();
	echo '<a id="banner_btn_'.$i.'" href="#" class="slider btn btn-primary call_btn'.$i.' animated bounceInUp"><i id="banner_icon_'.$i.'" class="'.$matrix_theme_options['home_callout_btn'.$i.'_icon'].'"></i><span>'.$matrix_theme_options['home_callout_btn_'.$i].'</span></a>';
}
function matrix_partial_refresh_blog_title(){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<h1 id="blog-heading" >'.esc_attr($matrix_theme_options['home_blog_title']).'</h1>';
}
function matrix_partial_refresh_blog_desc(){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<p id="blog-desc" class="text-center">'.esc_attr($matrix_theme_options['home_blog_description']).'</p>';
}
function matrix_partial_refresh_extra_title(){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<h1 id="extra_title" >'.esc_attr($matrix_theme_options['home_extra_title']).'</h1>';
}function matrix_partial_refresh_extra_desc(){
	$matrix_theme_options = matrix_theme_options();
	echo $out = '<p id="extra_desc" class="text-center">'.esc_attr($matrix_theme_options['home_extra_description']).'</p>';
}
function matrix_partial_refresh_extra_content(){
	$matrix_theme_options = matrix_theme_options();
	echo '<div class="latest-posts">'.esc_attr($matrix_theme_options['extra_content_home']).'</div>';
}
function matrix_partial_refresh_copyright_text(){
	$matrix_theme_options = matrix_theme_options();
	echo '<span id="copyright-text">'.esc_attr($matrix_theme_options['footer_copyright_text']).'  </span>';
}
/* Add Customizer Panel */
Kirki::add_config('matrix_theme', array(
    'capability' => 'edit_theme_options',
    'option_type' => 'option',
    'option_name' => 'matrix_theme_options',
));
Kirki::add_panel('matrix_option_panel', array(
    'priority' => 10,
    'title' => __('Matrix Options', 'matrix'),
    'description' => __('Here you can customize all your site contents', 'matrix'),
));
/* Add control to the color section of customizer */
Kirki::add_field('matrix_theme', array(
    'settings'          => 'header_topbar_bg_color',
    'label'             => __('Header Top Bar Background Color', 'matrix'),
    'description'       => __('Change Top bar Background Color', 'matrix'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#AD0D1C',
    'sanitize_callback' => 'matrix_sanitize_color',
    'output'            => array(
        array(
            'element'  => '.top-bar',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.top-bar',
            'property' => 'border-bottom',
        ),
    ),
    'transport'         => 'auto'
));

Kirki::add_field('matrix_theme', array(
    'settings'          => 'header_topbar_color',
    'label'             => __('Header Top Bar Font Color', 'matrix'),
    'description'       => __('Change Top bar Font Color', 'matrix'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#fff',
    'sanitize_callback' => 'matrix_sanitize_color',
    'output'            => array(
        array(
            'element'  => '.top-bar a, .top-bar a:hover, #social-list-header li a',
            'property' => 'color',
        ),
    ),
    'transport'         => 'auto'
));

Kirki::add_field('matrix_theme', array(
    'settings'          => 'header_background_color',
    'label'             => __('Header Background Color', 'matrix'),
    'description'       => __('Change Header Background Color', 'matrix'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#fff',
    'sanitize_callback' => 'matrix_sanitize_color',
    'output'            => array(
        array(
            'element'  => '.navbar-top',
            'property' => 'background',
        ),
    ),
    'transport'         => 'auto'
));

Kirki::add_section('general_sec', array(
    'title' => __('General Options', 'matrix'),
    'description' => __('Here you can change basic settings of your site', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field( 'matrix_theme', array(
    'type'        => 'preset',
    'settings'    => 'color_scheme',
    'label'       => __( 'Color Scheme', 'matrix' ),
    'section'     => 'general_sec',
    'default'     => 'red',
    'priority'    => 10,
	'sanitize_callback' => 'matrix_sanitize_text',
    'choices'     => array(
        'red' => array(
            'label'    => __('Default','matrix'),
            'settings' => array(
                'matrix_theme_options[header_topbar_bg_color]' => '#ee3733',
				'header_textcolor'=>'#ee3733',
            ),
        ),
		'green' => array(
            'label'    => __('Green','matrix'),
            'settings' => array(
                'matrix_theme_options[header_topbar_bg_color]' => '#94c523',
				'header_textcolor'=>'#94c523',
            ),
        ),
		'cyan' => array(
            'label'    => __('Cyan','matrix'),
            'settings' => array(
                'matrix_theme_options[header_topbar_bg_color]' => '#27bebe',
				'header_textcolor'=>'#27bebe',
            ),
        ),
        
    ),
) );
Kirki::add_field('matrix_theme', array(
    'settings' => 'logo_top_spacing',
    'label' => __('Logo Top Spacing', 'matrix'),
    'section' => 'title_tagline',
    'type' => 'slider',
    'priority' => 40,
    'default' => 22,
    'choices' => array(
        'max' => 80,
        'min' => 22,
        'step' => 1
    ),
    'transport' => 'postMessage',
    'output' => array(
        array(
            'element' => '.site-title',
            'property' => 'padding-top',
            'units' => 'px'
        ),
        array(
            'element' => 'a.custom-logo-link img',
            'property' => 'padding-top',
            'units' => 'px'
        )
    ),
	'js_vars'   => array(
		array(
			'element'  => '.site-title',
			'function' => 'css',
			'property' => 'padding-top',
		),
		array(
			'element'  => 'a.custom-logo-link img',
			'function' => 'css',
			'property' => 'padding-top',
		),
	),
    'sanitize_callback' => 'matrix_sanitize_number'
));

Kirki::add_field('matrix_theme', array(
    'settings' => 'matrix_custom_css',
    'label' => __('Custom Css Editor', 'matrix'),
    'section' => 'general_sec',
    'type' => 'code',
    'priority' => 10,
    'default' => '',
    'sanitize_callback'    => 'wp_filter_nohtml_kses',
    'sanitize_js_callback' => 'wp_filter_nohtml_kses',
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'label'=>'Open Css Editor'
	),
));
/* Header Options */
Kirki::add_section('layout_sec', array(
    'title' => __('Custom Layout Settings', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'logo_layout',
    'label' => __('Logo Align', 'matrix'),
    'section' => 'layout_sec',
    'type' => 'radio-image',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 'left',
    'choices' => array(
        'left' => admin_url() . '/images/align-left-2x.png',
        'right' => admin_url() . '/images/align-right-2x.png',
    ),
    'sanitize_callback' => 'matrix_sanitize_text'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'site_layout',
    'label' => __('Site Layout', 'matrix'),
    'description' => __('Change your site layout to full width or boxed size.', 'matrix'),
    'section' => 'layout_sec',
    'type' => 'radio-image',
    'transport' => 'postMessage',
    'priority' => 10,
    'default' => '',
    'choices' => array(
        '' => get_template_directory_uri() . '/images/layout/1c.png',
        'boxed-page' => get_template_directory_uri() . '/images/layout/3cm.png',
    ),

));
Kirki::add_field('matrix_theme', array(
    'settings' => 'footer_layout',
    'label' => __('Footer Layout', 'matrix'),
    'description' => __('Change footer into 2, 3 or 4 column', 'matrix'),
    'section' => 'layout_sec',
    'type' => 'radio-image',
    'transport' => 'postMessage',
    'priority' => 10,
    'default' => 3,
    'choices' => array(
        6 => get_template_directory_uri() . '/images/layout/footer-widgets-2.png',
        4 => get_template_directory_uri() . '/images/layout/footer-widgets-3.png',
        3 => get_template_directory_uri() . '/images/layout/footer-widgets-4.png',
    ),
    'sanitize_callback' => 'matrix_sanitize_number'
));
Kirki::add_field('matrix_theme', array(
    'type' => 'switch',
    'settings' => 'headersticky',
    'section' => 'layout_sec',
    'label' => __('Fixed Header', 'matrix'),
    'default' => 0,
    'priority' => 10,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'headercolorscheme',
    'label' => __('Header Style', 'matrix'),
    'section' => 'header_sec',
    'type' => 'radio-buttonset',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 'light_header ',
    'choices' => array(
        'light_header ' => 'Light Header',
        '' => 'Dark Header',
    ),
    'sanitize_callback' => 'matrix_sanitize_text'
));
/* Typography */
Kirki::add_section('typography_sec', array(
    'title'       => __('Typography Section', 'matrix'),
    'description' => __('Here you can change Font Style of your site', 'matrix'),
    'panel'       => 'matrix_option_panel',
    'priority'    => 160,
    'capability'  => 'edit_theme_options',
));

Kirki::add_field('matrix_theme', array(
    'type'        => 'typography',
    'settings'    => 'logo_font',
    'label'       => __('Logo Font Style', 'matrix'),
    'description' => __('Change logo font family and font style.', 'matrix'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => 'Courgette',

    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
        'color'=> true,
    ),
    'output'      => array(
        array(
            'element' => 'a#alogo',
        ),
    ),
));
/* lOGO TAGLINE */
Kirki::add_field('matrix_theme', array(
    'type'        => 'typography',
    'settings'    => 'logo_tag_font',
    'label'       => __('Logo tag Line Font Style', 'matrix'),
    'description' => __('Change logo tag line font family and font style.', 'matrix'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => 'open sans',
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
        'color'=> true,
    ),
    'output'      => array(
        array(
            'element' => 'a#alogo p',
        ),
    ),
));

Kirki::add_field('matrix_theme', array(
    'type'        => 'typography',
    'settings'    => 'menu_font',
    'label'       => __('Menu Font Style', 'matrix'),
    'description' => __('Change Primary Menu font family and font style.', 'matrix'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Open Sans",
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
        'color' => true
    ),
    'output'      => array(
        array(
            'element' => '.navbar-default .navbar-nav > li > a,.navbar-default .navbar-nav > li:hover > a, .navbar-default .navbar-nav > li > a.active',
        ),
    ),
));
/* Full body typography */
Kirki::add_field('matrix_theme', array(
    'type'        => 'typography',
    'settings'    => 'site_font',
    'label'       => __('Site Font Style', 'matrix'),
    'description' => __('Change whole site font family and font style.', 'matrix'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Open Sans",
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
    ),
    'output'      => array(
        array(
            'element' => 'body, h1, h2, h3, h4, h5, h6, p, em, blockquote, .main_title h2',
        ),
    ),
));
/* Home title typography */
Kirki::add_field('matrix_theme', array(
    'type'        => 'typography',
    'settings'    => 'site_title_font',
    'label'       => __('Home Sections Title Font', 'matrix'),
    'description' => __('Change font style of home service, home portfolio, home blog', 'matrix'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Open Sans",
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
        'color' => true
    ),
    'output'      => array(
        array(
            'element' => '.big-title h1',
        ),
    ),
));
/* Slider */
Kirki::add_section('slider_sec', array(
    'title' => __('Slider Options', 'matrix'),
    'description' => sprintf(__('You can enable/disable and re-arrange slider from <a href="%s">Home Page Redorder Section.</a>', 'matrix'), admin_url('customize.php?autofocus[section]=home_customize_section')),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_list = get_posts( $args );
foreach($posts_list as $post){
	$posts[$post->ID] = $post->post_title;
}
Kirki::add_field( 'matrix_theme', array(
    'type'        => 'select',
    'settings'    => 'home_slider_posts',
    'label' => __('Select Posts to be Shown in Slider', 'matrix'),
	'help'=>   __('You can also be able to drag-n-drop the selected options and rearrange their order for maximum flexibility', 'matrix'),
    'section'     => 'slider_sec',
    'priority'    => 10,
    'choices'     => $posts,
    'multiple'    => 4,
) );

/* Service Options */
Kirki::add_section('service_sec', array(
    'title' => __('Service Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_service_title',
    'label' => __('Home Service Title', 'matrix'),
    'section' => 'service_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_service_title'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_service_title' => array(
			'selector'        => '#service-head',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_service_head',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_service_description',
    'label' => __('Home Service Description', 'matrix'),
    'section' => 'service_sec',
    'type' => 'textarea',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_service_description'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_service_description' => array(
			'selector'        => '#service-desc',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_service_desc',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_service_column',
    'label' => __('Service Column', 'matrix'),
    'section' => 'service_sec',
    'type' => 'select',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_service_column'],
    'choices' => array(
        6 => __('Two Column', 'matrix'),
        4 => __('Three Column', 'matrix'),
        3 => __('Four Column', 'matrix'),
    ),
    'sanitize_callback' => 'matrix_sanitize_number'
));
$num = array(1=>'One',2=>'Two',3=>'Three',4=>'Four');
for ($i = 1; $i <= 4; $i++) {
    Kirki::add_field('matrix_theme', array(
        'settings' => 'service_icon_' . $i,
        'label' => sprintf(__('Service %s Icon','matrix'), $num[$i]),
        'section' => 'service_sec',
        'type' => 'text',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['service_icon_' . $i],
        'sanitize_callback' => 'matrix_sanitize_text',
		'partial_refresh' => array(
        'service_icon_'.$i => array(
            'selector'            => '#service_box_'.$i,
			'container_inclusive' => true,
            'render_callback'     => function() use($i){
					matrix_partial_refresh_service_icon($i);
			},
        ),
    )
    ));
    Kirki::add_field('matrix_theme', array(
        'settings' => 'service_title_' . $i,
        'label' => sprintf(__('Service %s Title','matrix'), $num[$i]),
        'section' => 'service_sec',
        'type' => 'text',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['service_title_' . $i],
        'sanitize_callback' => 'matrix_sanitize_text',
		'partial_refresh' => array(
        'service_title_'.$i => array(
            'selector'            => '#service-title-'.$i,
			'container_inclusive' => true,
            'render_callback'     => function() use($i){
					matrix_partial_refresh_service_title($i);
			},
        ),
    )
    ));
    Kirki::add_field('matrix_theme', array(
        'settings' => 'service_text_' . $i,
        'label' => sprintf(__('Service %s Description','matrix'), $num[$i]),
        'section' => 'service_sec',
        'type' => 'textarea',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['service_text_' . $i],
        'sanitize_callback' => 'matrix_sanitize_text',
		'partial_refresh' => array(
        'service_text_'.$i => array(
            'selector'            => '#service-desc-'.$i,
			'container_inclusive' => true,
            'render_callback'     => function() use($i){
					matrix_partial_refresh_service_text($i);
			},
			),
		)
    ));
	Kirki::add_field('matrix_theme', array(
		'settings'          => 'service_link_' . $i,
		'label'             => sprintf(__('Service %s Link','matrix'), $num[$i]),
		'section'           => 'service_sec',
		'type'              => 'text',
		'priority'          => 10,
		'transport'         => 'postMessage',
		'default'           => $matrix_theme_options['service_link_' . $i],
		'sanitize_callback' => 'esc_url',
	));
}
/* portfolio */
Kirki::add_section('portfolio_sec', array(
    'title' => __('Portfolio Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'portfolio_four_column',
    'label' => __('Show Portfolio in Four Column', 'matrix'),
	'help' => __('This option work with only "Photo Video Gallery Master" plugin', 'matrix'),
    'section' => 'portfolio_sec',
    'type' => 'checkbox',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'portfolio_shortcode',
    'label' => __('Put Your Gallery Shortcode here', 'matrix'),
    'section' => 'portfolio_sec',
    'type' => 'text',
    'priority' => 10,	
    'default' => '',
    'sanitize_callback' => 'matrix_sanitize_text'
));
/* Extra Content */
Kirki::add_section('extra_sec', array(
    'title'      => __('Extra Content Options', 'matrix'),
    'panel'      => 'matrix_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_extra_title',
    'label' => __('Home Extra Content Section Title', 'matrix'),
    'section' => 'extra_sec',
    'type' => 'text',
    'priority' => 9,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_extra_title'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_extra_title' => array(
			'selector'        => '#extra_title',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_extra_title',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_extra_description',
    'label' => __('Home Extra Content Section Description', 'matrix'),
    'section' => 'extra_sec',
    'type' => 'textarea',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_extra_description'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_extra_description' => array(
			'selector'        => '#extra_desc',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_extra_desc',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings'          => 'extra_content_home',
    'label'             => __('Put Your Extra Content Here', 'matrix'),
    'description'       => __('This content will be shown on extra content section on Home. In this section you can also put content with HTML tags', 'matrix'),
    'section'           => 'extra_sec',
    'type'              => 'editor',
    'priority'          => 10,
    'default'           => $matrix_theme_options['extra_content_home'],
	'choices'     => array(
		'label'=>'Open Css Editor'
	),
	'partial_refresh' => array(
		'extra_content_home' => array(
			'selector'        => '.extra_section .latest-posts',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_extra_content',
		)
	),
));
/* Banner Options */
Kirki::add_section('banner_sec', array(
    'title' => __('Home Banner Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));

Kirki::add_field('matrix_theme', array(
    'settings' => 'callout_bg_image',
    'label' => __('Banner Background Image', 'matrix'),
    'section' => 'banner_sec',
    'type' => 'image',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $banner_img,
    'sanitize_callback' => 'esc_url_raw',
	'partial_refresh' => array(
		'callout_bg_image' => array(
			'selector'        => '#matrix_video',
			'container_inclusive' => true,
			'render_callback' => function(){
				get_template_part('home-callout');
			}
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'callout_external_bg_video',
    'label' => __('Or, enter a YouTube URL:', 'matrix'),
    'section' => 'banner_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => esc_url('https://www.youtube.com/watch?v=jnLSYfObARA'),
    'sanitize_callback' => 'esc_url_raw',
	'partial_refresh' => array(
		'callout_external_bg_video' => array(
			'selector'        => '#matrix_video',
			'container_inclusive' => true,
			'render_callback' => function(){
				get_template_part('home-callout');
			}
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'callout_bg_video_opt',
    'section' => 'banner_sec',
    'type' => 'custom',
    'priority' => 10,
    'default'     => '<div style="padding: 30px;background-color: #333; color: #fff; border-radius: 50px;">' . esc_html__( 'In Pro Version you can control auto play, audio, and video overlay effect like opacity, brightness, contrast, blur, sepia, gray scale etc.', 'matrix' ) . '</div>',
    'sanitize_callback' => 'esc_url_raw',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'anim_texts',
    'label' => __('Animated text', 'matrix'),
    'description' => __('Comma seperate text to be animate', 'matrix'),
    'section' => 'banner_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['anim_texts'],
    'sanitize_callback' => 'matrix_sanitize_text'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_callout_description',
    'label' => __('Banner Description', 'matrix'),
    'section' => 'banner_sec',
    'type' => 'textarea',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_callout_description'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
	'home_callout_description'=> array(
			'selector'            => '#banner_desc',
			'container_inclusive' => true,
			'render_callback'     => 'matrix_partial_refresh_callout_desc'
		),
	)
));
for ($i = 1; $i <= 2; $i++) {
    Kirki::add_field('matrix_theme', array(
        'settings' => 'home_callout_btn_' . $i,
        'label' => __('Banner Button ', 'matrix') . $num[$i] . __(' Text', 'matrix'),
        'section' => 'banner_sec',
        'type' => 'text',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['home_callout_btn_' . $i],
        'sanitize_callback' => 'matrix_sanitize_text',
		'partial_refresh' => array(
		'home_callout_btn_'.$i=> array(
			'selector'            => '#banner_btn_'.$i,
			'container_inclusive' => true,
			'render_callback'     => function()use($i){
				matrix_partial_refresh_callout_btn($i);
			}
		),
	)
    ));
    Kirki::add_field('matrix_theme', array(
        'settings' => 'home_callout_btn' . $i . '_link',
        'label' => __('Banner Button ', 'matrix') . $num[$i] . __(' URL', 'matrix'),
        'section' => 'banner_sec',
        'type' => 'text',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['home_callout_btn' . $i . '_link'],
        'sanitize_callback' => 'esc_url'
    ));
    Kirki::add_field('matrix_theme', array(
        'settings' => 'home_callout_btn' . $i . '_icon',
        'label' => __('Banner Button ', 'matrix') . $num[$i] . __(' Icon', 'matrix'),
        'section' => 'banner_sec',
        'type' => 'text',
        'priority' => 10,
        'transport' => 'postMessage',
        'default' => $matrix_theme_options['home_callout_btn' . $i . '_icon'],
        'sanitize_callback' => 'matrix_sanitize_text'
    ));
}
/* Blog Options */
Kirki::add_section('blog_sec', array(
    'title' => __('Home Blog Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_blog_title',
    'label' => __('Home Blog Title', 'matrix'),
    'section' => 'blog_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_blog_title'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_blog_title' => array(
			'selector'        => '#blog-heading',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_blog_title',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'home_blog_description',
    'label' => __('Home Blog Description', 'matrix'),
    'section' => 'blog_sec',
    'type' => 'textarea',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['home_blog_description'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'home_blog_description' => array(
			'selector'        => '#blog-desc',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_blog_desc',
		)
	),
));
$categories = get_categories( array(
	'orderby' => 'name',
	'order'   => 'ASC'
) );
foreach( $categories as $category ) {
	$cats[$category->term_id] = $category->name;
}
Kirki::add_field('matrix_theme', array(
    'settings'          => 'home_post_cat',
    'label'             => __('Category', 'matrix'),
    'description'       => __('Category For Home Blog Posts', 'matrix'),
    'help'              => __('With this option you can show home blog posts from selected  categories.', 'matrix'),
    'section'           => 'blog_sec',
    'type'              => 'select',
    'priority'          => 10,
    'default'           => 0,
	'multiple'          => 10,
    'choices'           => $cats
));
/* Social Options */
Kirki::add_section('social_sec', array(
    'title' => __('Social Media Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_media_header',
    'label' => __('Social Media in Header', 'matrix'),
    'description' => __('Enable Social Media icons in Header', 'matrix'),
    'section' => 'social_sec',
    'type' => 'checkbox',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_media_footer',
    'label' => __('Social Media in Footer', 'matrix'),
    'description' => __('Enable Social Media icons in Footer', 'matrix'),
    'section' => 'social_sec',
    'type' => 'checkbox',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_facebook_link',
    'label' => __('Facebook Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_facebook_link'],
    'sanitize_callback' => 'esc_url_raw'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_twitter_link',
    'label' => __('Twitter Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_twitter_link'],
    'sanitize_callback' => 'esc_url_raw'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_google_plus_link',
    'label' => __('Google+ Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_google_plus_link'],
    'sanitize_callback' => 'esc_url_raw'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_linkedin_link',
    'label' => __('LinkedIn Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_linkedin_link'],
    'sanitize_callback' => 'esc_url_raw'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_instagram_link',
    'label' => __('Instagram Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_instagram_link'],
    'sanitize_callback' => 'esc_url_raw'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'social_dribble_link',
    'label' => __('Dribble Link', 'matrix'),
    'section' => 'social_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['social_dribble_link'],
    'sanitize_callback' => 'esc_url_raw'
));
/* Contact Options */
Kirki::add_section('contact_sec', array(
    'title' => __('Contact Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'contact_info_header',
    'label' => __('Contact Info in Header', 'matrix'),
    'description' => __('Show Contact Info in Header', 'matrix'),
    'section' => 'contact_sec',
    'type' => 'switch',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'contact_address',
    'label' => __('Contact Address', 'matrix'),
    'section' => 'contact_sec',
    'type' => 'textarea',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['contact_address'],
    'sanitize_callback' => 'matrix_sanitize_text'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'contact_email',
    'label' => __('Email Address', 'matrix'),
    'section' => 'contact_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['contact_email'],
    'sanitize_callback' => 'sanitize_email'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'contact_phone',
    'label' => __('Phone No.', 'matrix'),
    'section' => 'contact_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['contact_phone'],
    'sanitize_callback' => 'matrix_sanitize_text'
));
/* Footer Options */
Kirki::add_section('footer_sec', array(
    'title' => __('Footer Options', 'matrix'),
    'panel' => 'matrix_option_panel',
    'priority' => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'footer_bg_color',
    'label' => __('Change Footer Background Color', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'color-alpha',
    'default'     => '#222	',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'footer',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
'sanitize_callback'=>'matrix_sanitize_color'		
));

Kirki::add_field('matrix_theme', array(
    'settings' => 'copyright_text_footer',
    'label' => __('Enable Footer Copyright Section', 'matrix'),
    'description' => __('Show Copyright Text in Footer', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'switch',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'show_footer_widget',
    'label' => __('Enable Footer Widget Section', 'matrix'),
    'description' => __('You can enable/disable footer widget area here', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'switch',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => 1,
    'sanitize_callback' => 'matrix_sanitize_checkbox'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'footer_copyright_text',
    'label' => __('Footer Copyright Text', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['footer_copyright_text'],
    'sanitize_callback' => 'matrix_sanitize_text',
	'partial_refresh' => array(
		'footer_copyright_text' => array(
			'selector'        => '#copyright-text',
			'container_inclusive' => true,
			'render_callback' => 'matrix_partial_refresh_copyright_text',
		)
	),
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'created_by_matrix_text',
    'label' => __('Developed By Text', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['created_by_matrix_text'],
    'sanitize_callback' => 'matrix_sanitize_text'
));
Kirki::add_field('matrix_theme', array(
    'settings' => 'created_by_link',
    'label' => __('Developed By Link', 'matrix'),
    'section' => 'footer_sec',
    'type' => 'url',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $matrix_theme_options['created_by_link'],
    'sanitize_callback' => 'esc_url_raw'
));
/* Home Page Re-order Sections */
Kirki::add_section('home_customize_section', array(
    'title'      => __('Home Page Reorder Sections', 'matrix'),
    'panel'      => 'matrix_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field( 'matrix_theme', array(
    'type'        => 'sortable',
    'settings'    => 'home_sections',
    'label'       => __( 'Here You can reorder your homepage section', 'matrix' ),
    'section'     => 'home_customize_section',
    'default'     => array(
        'slider',
		'service',
        'portfolio',
		'callout',
        'blog',
        
    ),
    'choices'     => array(
        'slider' => esc_attr__( 'Home Slider', 'matrix' ),
		'service' => esc_attr__( 'Home Service', 'matrix' ),
        'portfolio' => esc_attr__( 'Home Portfolio', 'matrix' ),
        'blog' => esc_attr__( 'Home Blog', 'matrix' ),
        'callout' => esc_attr__( 'Callout/Banner', 'matrix' ),
		'content' => esc_attr__( 'Extra Content', 'matrix' ),
    ),
    'priority'    => 10,
) );
/******************* End *********************/
function matrix_sanitize_text($input)
{
    return wp_kses_post(force_balance_tags($input));
}

function matrix_sanitize_checkbox($checked)
{
    return ((isset($checked) && (true == $checked || 'on' == $checked)) ? true : false);
}

/**
 * Sanitize number options
 */
function matrix_sanitize_number($value)
{
    return (is_numeric($value)) ? $value : intval($value);
}

function matrix_sanitize_color($color)
{

    if ($color == "transparent") {
        return $color;
    }

    $named = json_decode('{"transparent":"transparent", "aliceblue":"#f0f8ff","antiquewhite":"#faebd7","aqua":"#00ffff","aquamarine":"#7fffd4","azure":"#f0ffff", "beige":"#f5f5dc","bisque":"#ffe4c4","black":"#000000","blanchedalmond":"#ffebcd","blue":"#0000ff","blueviolet":"#8a2be2","brown":"#a52a2a","burlywood":"#deb887", "cadetblue":"#5f9ea0","chartreuse":"#7fff00","chocolate":"#d2691e","coral":"#ff7f50","cornflowerblue":"#6495ed","cornsilk":"#fff8dc","crimson":"#dc143c","cyan":"#00ffff", "darkblue":"#00008b","darkcyan":"#008b8b","darkgoldenrod":"#b8860b","darkgray":"#a9a9a9","darkgreen":"#006400","darkkhaki":"#bdb76b","darkmagenta":"#8b008b","darkolivegreen":"#556b2f", "darkorange":"#ff8c00","darkorchid":"#9932cc","darkred":"#8b0000","darksalmon":"#e9967a","darkseagreen":"#8fbc8f","darkslateblue":"#483d8b","darkslategray":"#2f4f4f","darkturquoise":"#00ced1", "darkviolet":"#9400d3","deeppink":"#ff1493","deepskyblue":"#00bfff","dimgray":"#696969","dodgerblue":"#1e90ff", "firebrick":"#b22222","floralwhite":"#fffaf0","forestgreen":"#228b22","fuchsia":"#ff00ff", "gainsboro":"#dcdcdc","ghostwhite":"#f8f8ff","gold":"#ffd700","goldenrod":"#daa520","gray":"#808080","green":"#008000","greenyellow":"#adff2f", "honeydew":"#f0fff0","hotpink":"#ff69b4", "indianred ":"#cd5c5c","indigo ":"#4b0082","ivory":"#fffff0","khaki":"#f0e68c", "lavender":"#e6e6fa","lavenderblush":"#fff0f5","lawngreen":"#7cfc00","lemonchiffon":"#fffacd","lightblue":"#add8e6","lightcoral":"#f08080","lightcyan":"#e0ffff","lightgoldenrodyellow":"#fafad2", "lightgrey":"#d3d3d3","lightgreen":"#90ee90","lightpink":"#ffb6c1","lightsalmon":"#ffa07a","lightseagreen":"#20b2aa","lightskyblue":"#87cefa","lightslategray":"#778899","lightsteelblue":"#b0c4de", "lightyellow":"#ffffe0","lime":"#00ff00","limegreen":"#32cd32","linen":"#faf0e6", "magenta":"#ff00ff","maroon":"#800000","mediumaquamarine":"#66cdaa","mediumblue":"#0000cd","mediumorchid":"#ba55d3","mediumpurple":"#9370d8","mediumseagreen":"#3cb371","mediumslateblue":"#7b68ee", "mediumspringgreen":"#00fa9a","mediumturquoise":"#48d1cc","mediumvioletred":"#c71585","midnightblue":"#191970","mintcream":"#f5fffa","mistyrose":"#ffe4e1","moccasin":"#ffe4b5", "navajowhite":"#ffdead","navy":"#000080", "oldlace":"#fdf5e6","olive":"#808000","olivedrab":"#6b8e23","orange":"#ffa500","orangered":"#ff4500","orchid":"#da70d6", "palegoldenrod":"#eee8aa","palegreen":"#98fb98","paleturquoise":"#afeeee","palevioletred":"#d87093","papayawhip":"#ffefd5","peachpuff":"#ffdab9","peru":"#cd853f","pink":"#ffc0cb","plum":"#dda0dd","powderblue":"#b0e0e6","purple":"#800080", "red":"#ff0000","rosybrown":"#bc8f8f","royalblue":"#4169e1", "saddlebrown":"#8b4513","salmon":"#fa8072","sandybrown":"#f4a460","seagreen":"#2e8b57","seashell":"#fff5ee","sienna":"#a0522d","silver":"#c0c0c0","skyblue":"#87ceeb","slateblue":"#6a5acd","slategray":"#708090","snow":"#fffafa","springgreen":"#00ff7f","steelblue":"#4682b4", "tan":"#d2b48c","teal":"#008080","thistle":"#d8bfd8","tomato":"#ff6347","turquoise":"#40e0d0", "violet":"#ee82ee", "wheat":"#f5deb3","white":"#ffffff","whitesmoke":"#f5f5f5", "yellow":"#ffff00","yellowgreen":"#9acd32"}', true);

    if (isset($named[strtolower($color)])) {
        /* A color name was entered instead of a Hex Value, convert and send back */
        return $named[strtolower($color)];
    }

    $color = str_replace('#', '', $color);
    if (strlen($color) == 3) {
        $color = $color . $color;
    }
    if (preg_match('/^[a-f0-9]{6}$/i', $color)) {
        return '#' . $color;
    }
    //$this->error = $this->field;
    return false;
} //function

function matrix_upgrade_info()
{
    wp_register_script('matrix_customizer_script', get_template_directory_uri() . '/js/matrix-customizer.js', array("jquery"));
    wp_enqueue_script('matrix_customizer_script');
    wp_localize_script('matrix_customizer_script', 'matrix_button', array(
        'proDesc' => __('The pro version includes more skin colors, the ability to add more slides in the slider, more font options, an animated Ajax contact form, testimonials carousel, Pricing Tables, Shortcodes and more!','matrix'),
        'prefixLabel'=>__('Upgrade To Pro','matrix'),
        'prefixURL'=>esc_url_raw('http://www.webhuntinfotech.com/webhunt_theme/matrix-premium-29'),
        'viewDemoLabel'=>__('View Live Demo','matrix'),
		'proDemo'=>esc_url_raw('http://demo.webhuntinfotech.com/demo/#matrix'),
		'supportLabel'=>__('Support','matrix'),
        'supportLink'=>esc_url_raw('https://wordpress.org/support/theme/matrix'),
    ));
}
add_action('customize_controls_enqueue_scripts', 'matrix_upgrade_info');

function matrix_customize_register( $wp_customize ) {	
	
	wp_enqueue_style('customizercustom_css',get_template_directory_uri().'/css/customizer.css');
	$wp_customize->add_section( 'matrix_pro' , array(
		'title'      	=> __( 'Upgrade to Matrix Premium', 'matrix' ),
		'priority'   	=> 999,
		'panel'=>'matrix_option_panel',
	) );

	$wp_customize->add_setting( 'matrix_pro', array(
		'default'    		=> null,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Matrix_Pro_Control( $wp_customize, 'matrix_pro', array(
		'label'    => __( 'Matrix Premium', 'matrix' ),
		'section'  => 'matrix_pro',
		'settings' => 'matrix_pro',
		'priority' => 1,
	) ) );
}
add_action( 'customize_register', 'matrix_customize_register', 11 );

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Matrix_Pro_Control' ) ) :
class Matrix_Pro_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		?>
		<label style="overflow: hidden; zoom: 1;">
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="https://www.webhuntinfotech.com/theme/matrix-premium-29/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Matrix Premium','matrix'); ?> </a>
			</div>
			<div class="col-md-4 col-sm-6">
				<img class="matrix_img_responsive " src="<?php echo get_template_directory_uri() .'/images/Matrix_Pro.png'?>">
			</div>			
			<div class="col-md-3 col-sm-6">
				<h3 style="margin-top:10px;margin-left: 20px;text-decoration:underline;color:#333;"><?php echo _e( 'Matrix Premium - Features','matrix'); ?></h3>
					<ul style="padding-top:10px">
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Responsive Design','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Beautiful & Amazing Shortcodes','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('More than 15 Page Templates','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Slider Section','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Service Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Portfolio Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Testimonial Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Banner Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Client Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Team Sections','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Magical Fun Facts Style','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Pricing Tables','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Footer Callout Section','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('6 Different Types of Blog Templates','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('4 Types of Portfolio Templates','matrix'); ?></li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Stylish Custom Widgets','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Redux Options Panel','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Unlimited Colors Scheme','matrix'); ?></li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Patterns Background','matrix'); ?>   </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('WPML Compatible','matrix'); ?>   </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Woo-commerce Compatible','matrix'); ?>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Portfolio layout with Isotope effect','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Coming Soon/Maintenance Mode Option','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Translation Ready','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Free Updates','matrix'); ?> </li>
						<li class="upsell-matrix"> <div class="dashicons dashicons-yes"></div> <?php _e('Quick Support','matrix'); ?> </li>
					</ul>
			</div>
			<div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">					
					<a style="margin-bottom:20px;margin-left:20px;" href="https://www.webhuntinfotech.com/theme/matrix-premium-29/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Matrix Premium','matrix'); ?> </a>
			</div>
			
			<p>
				<?php
					printf( __( 'If you Like our Products , Please Rate us 5 star on %sWordPress.org%s.  We\'d really appreciate it! </br></br>  Thank You', 'matrix' ), '<a target="" href="https://wordpress.org/support/view/theme-reviews/matrix?filter=5">', '</a>' );
				?>
			</p>
		</label>
		<?php
	}
}
endif;
?>