<?php
/**
 * edsBootstrap Theme Customizer.
 *
 * @package edsBootstrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function edsbootstrap_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	class Custom_Text_Control extends WP_Customize_Control {
        public $type = 'customtext';
        public function render_content() {
        ?>
            <span><a target="_blank" href="https://edatastyle.com/product/eds-bootstrap-wp" >
					<?php _e('Upgrade pro','edsbootstrap'); ?>
				</a><?php echo esc_html( $this->label ); ?></span>
       
        <?php
        }
    }
	
	
	/**
	 Slider Section Panel and sub-sections
	 =====================================================
	 */
	$wp_customize->add_panel('slider_setting_panel', array(
		'title' => __('Slider Section', 'edsbootstrap'),
		'description' => __('Allows you to set up Slider section for OnePage Theme.', 'edsbootstrap'), //Descriptive tooltip
		'priority' => '30',
		'capability' => 'edit_theme_options'
			)
	);
	
	
	$slider_section=array(__('Slider # 1', 'edsbootstrap'),__('Slider # 2', 'edsbootstrap'),__('Slider # 3', 'edsbootstrap'),__('Slider # 4', 'edsbootstrap'));
	$i=0;
	foreach ($slider_section as $key => $sec): $i++;
	/*
	  Slider setting section
	 */
		$wp_customize->add_section('slider_section_'.$i, array(
			'title' =>$sec,
			'description' => __('Allows you to set up slider one for eDS Bootstrap Theme.', 'edsbootstrap'), //Descriptive tooltip
			'panel' => 'slider_setting_panel',
			'capability' => 'edit_theme_options'
		));
	 /*
	 	Slider image Upload
	 */
		$wp_customize->add_setting('eds_slider_options['.$i.'][image]', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			'default' =>''
		));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'eds_image_upload'.$i, array(
			'label' => __('Image', 'edsbootstrap'),
			'description' => __('Upload image for slider', 'edsbootstrap'),
			'section'  => 'slider_section_'.$i,
			'settings' => 'eds_slider_options['.$i.'][image]',
		)));
		
	/*
	  Slider Heading
	 */
		$wp_customize->add_setting('eds_slider_options['.$i.'][heading]', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			'default' =>''
		));
		
		$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'eds_heading'.$i, array(
			'label' => __('Heading', 'edsbootstrap'),
			'description' => __('Enter heading for slider', 'edsbootstrap'),
			'section'  => 'slider_section_'.$i,
			'settings' => 'eds_slider_options['.$i.'][heading]',
			'type' => 'textarea'
		)));
	 /*
	   Slider Dscription
	 */
		$wp_customize->add_setting('eds_slider_options['.$i.'][dscription]', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			'default' =>''
		));
		
		$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'eds_dscription'.$i, array(
			'label' => __('Dscription', 'edsbootstrap'),
		    'description' => __('Enter dscription for slider', 'edsbootstrap'),
			'section'  => 'slider_section_'.$i,
			'settings' => 'eds_slider_options['.$i.'][dscription]',
			'type' => 'textarea'
		)));
		
	 /*
	   Slider Dscription
	 */
		$wp_customize->add_setting('eds_slider_options['.$i.'][dscription]', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			'default' =>''
		));
		
		$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'eds_dscription'.$i, array(
			'label' => __('Dscription', 'edsbootstrap'),
		    'description' => __('Enter dscription for slider', 'edsbootstrap'),
			'section'  => 'slider_section_'.$i,
			'settings' => 'eds_slider_options['.$i.'][dscription]',
			'type' => 'textarea'
		)));
	
	 /*
	 Slider Button Text
	 */
	$wp_customize->add_setting('eds_slider_options['.$i.'][button_text]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		'default' =>''
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'eds_button_text'.$i, array(
		'label' => __('Button Text', 'edsbootstrap'),
		'description' => __('Enter text for button', 'edsbootstrap'),
		'section'  => 'slider_section_'.$i,
		'settings' => 'eds_slider_options['.$i.'][button_text]',
		'type' => 'text'
	)));
	 /*
	 * Slider Button link
	 */
	$wp_customize->add_setting('eds_slider_options['.$i.'][button_link]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
		'default' =>''
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'eds_button_link'.$i, array(
		'label' => __('Button Link', 'edsbootstrap'),
		'description' => __('Enter the button link', 'edsbootstrap'),
		'section'  => 'slider_section_'.$i,
		'settings' => 'eds_slider_options['.$i.'][button_link]',
		'type' => 'text'
	)));
	
		
	endforeach;

	
	
	/*
	Start edsbootstrap Options
	=====================================================
	*/
	$wp_customize->add_section( 'edsbootstrap_options', array(
	     'title'    => esc_attr__( 'Lite Theme Options', 'edsbootstrap' ),
	     'priority' => 35,
	) );
	
	/*
	Show social on header
	*/
	$wp_customize->add_setting('edsbootstrap_theme_options_socialheader', array(
        'default' => 1,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edsbootstrap_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('edsbootstrap_theme_options_socialheader', array(
        'label'      => __( 'Show Social Buttons on Header', 'edsbootstrap' ),
        'section'    => 'edsbootstrap_options',
        'settings'   => 'edsbootstrap_theme_options_socialheader',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show social on footer
	*/
	$wp_customize->add_setting('edsbootstrap_theme_options_socialfooter', array(
        'default'    => 1,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edsbootstrap_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('edsbootstrap_theme_options_socialfooter', array(
        'label'      => __( 'Show Social Buttons on Footer', 'edsbootstrap' ),
        'section'    => 'edsbootstrap_options',
        'settings'   => 'edsbootstrap_theme_options_socialfooter',
        'type'       => 'checkbox',
    ) );
	/*
	Show Contact Info on Header
	*/
	$wp_customize->add_setting('edsbootstrap_theme_options_contact_info', array(
        'default'    => 1,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edsbootstrap_sanitize_checkbox'
    ) );
	$wp_customize->add_control('edsbootstrap_theme_options_show_top', array(
        'label'      => __( 'Show Contact Info on Header', 'edsbootstrap' ),
        'section'    => 'edsbootstrap_options',
        'settings'   => 'edsbootstrap_theme_options_contact_info',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show Page Side Bar
	*/
	$wp_customize->add_setting('edsbootstrap_show_page_sidebar', array(
        'default'    => 0,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edsbootstrap_sanitize_checkbox'
    ) );
	$wp_customize->add_control('edsbootstrap_theme_options_show_top', array(
        'label'      => __( 'Show Sidebar Inside page layout', 'edsbootstrap' ),
        'section'    => 'edsbootstrap_options',
        'settings'   => 'edsbootstrap_show_page_sidebar',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show full post or excerpt
	=====================================================
	*/
	$wp_customize->add_setting('edsbootstrap_theme_options_postshow', array(
        'default'    => 'excerpt',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edsbootstrap_sanitize_select'
    ) );
	
	$wp_customize->add_control('edsbootstrap_theme_options_postshow', array(
        'label'      => __( 'Post show', 'edsbootstrap' ),
        'section'    => 'edsbootstrap_options',
        'settings'   => 'edsbootstrap_theme_options_postshow',
        'type'       => 'select',
		'choices' => array(
			'excerpt' => __( 'Show excerpt', 'edsbootstrap'),
			'full' => __( 'Show full post', 'edsbootstrap'),
			
		),
    ) );
	
	$edsbootstrap_options=array();
	/*
	Top Bar Contact Info
	*/
	$edsbootstrap_options['info']['icon_pin_alt']= array(
		'default' => '',
		'label' => __('Contact Location', 'edsbootstrap')
	);
	$edsbootstrap_options['info']['icon_mail_alt']= array(
		'default' => '',
		'label' => __('Contact Email', 'edsbootstrap')
	);
	$edsbootstrap_options['info']['icon_phone']= array(
		'default' => '',
		'label' => __('Contact Phone', 'edsbootstrap')
	);
	
	/*
	Social media
	*/
	$edsbootstrap_options['social']['fa-facebook']= array(
		'default' => '',
		'label' => __('Facebook URL', 'edsbootstrap')
	);
	$edsbootstrap_options['social']['fa-twitter']= array(
		'default' => '',
		'label' => __('Twitter URL', 'edsbootstrap')
	);
	$edsbootstrap_options['social']['fa-google-plus']= array(
		'default' => '',
		'label' => __('Google-plus URL', 'edsbootstrap')
	);
	$edsbootstrap_options['social']['fa-pinterest']= array(
		'default' => '',
		'label' => __('pinterest URL', 'edsbootstrap')
	);
	
	/*
	Footer
	*/
	$edsbootstrap_options['footer']['copyright']= array(
		'default' =>'',
		'label' => __('Copyright Text', 'edsbootstrap')
	);
	 /*
	 Blog Heading Text
	 */
	$wp_customize->add_setting('edsbootstrap_theme_options[blog][heading]', array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type'     => 'theme_mod',
		'default' => __('Blog - Posts List', 'edsbootstrap')
	));
	$wp_customize->add_control('edsbootstrap_theme_options_blog' , 
		array(
			'label' => __('Blog Posts List Page Title', 'edsbootstrap'),
			'section'    => 'edsbootstrap_options',
			'settings' =>'edsbootstrap_theme_options[blog][heading]',
		)
	);
	 /*
	 Blog Heading Text
	 */
	$wp_customize->add_setting('edsbootstrap_theme_options[blog][sub_heading]', array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type'     => 'theme_mod',
		'default' =>__('There are many variations of passages', 'edsbootstrap')
	));
	$wp_customize->add_control('edsbootstrap_theme_options_sub_heading' , 
		array(
			'label' => __('Blog Posts List Page Sub Title', 'edsbootstrap'),
			'section'    => 'edsbootstrap_options',
			'settings' =>'edsbootstrap_theme_options[blog][sub_heading]',
		)
	);
	
	foreach( $edsbootstrap_options as $key => $options ):
		foreach( $options as $k => $val ):
			// SETTINGS
			$wp_customize->add_setting('edsbootstrap_theme_options['.$key .']['. $k .']',
				array(
					'default' => $val['default'],
					'capability'     => 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
					'type'     => 'theme_mod',
				)
			);
			// CONTROLS
			$wp_customize->add_control('edsbootstrap_theme_options_text_field_' . $k , 
				array(
					'label' => $val['label'], 
					'section'    => 'edsbootstrap_options',
					'settings' =>'edsbootstrap_theme_options['.$key .']['. $k .']',
				)
			);
		
		endforeach;
	endforeach;
	
	
	
	$wp_customize->add_setting('edsbootstrap_upgrade_pro', array(
            'default' => '',
            'type' => 'customtext_control',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'edsbootstrap_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( new Custom_Text_Control( $wp_customize, 'eds_upgrade_pro_text_control', array(
        'label' => __(' get more social media link(linkedin, youtube, vimeo, instagram, vk, reddit, digg), Powerful theme options And Lot of .......', 'edsbootstrap'),
        'section' => 'edsbootstrap_options',
        'settings' => 'edsbootstrap_upgrade_pro',
        ) ) 
    );
	
}
add_action( 'customize_register', 'edsbootstrap_customize_register' );
if( ! function_exists('edsbootstrap_sanitize_checkbox') ){
	function edsbootstrap_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
}
if( ! function_exists('edsbootstrap_sanitize_select') ){
	function edsbootstrap_sanitize_select( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function edsbootstrap_customize_preview_js() {
	wp_enqueue_script( 'edsbootstrap_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'edsbootstrap_customize_preview_js' );

/*
Enqueue Script for top buttons
*/
if ( ! function_exists( 'edsbootstrap_customizer_controls' ) ){
	function edsbootstrap_customizer_controls(){

		wp_register_script( 'edsbootstrap_customizer_top_buttons', get_template_directory_uri() . '/inc/wp-admin/edsbootstrap_customizer.js', array( 'jquery' ), true  );
		wp_enqueue_script( 'edsbootstrap_customizer_top_buttons' );

		wp_localize_script( 'edsbootstrap_customizer_top_buttons', 'customBtns', array(
			'prodemo' => esc_html__( 'Demo PRO version', 'edsbootstrap' ),
            'proget' => esc_html__( 'Get PRO Version', 'edsbootstrap' )
		) );
	}
}//end if function_exists
add_action( 'customize_controls_enqueue_scripts', 'edsbootstrap_customizer_controls' );
