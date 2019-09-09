<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Example_1_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {


		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'customizer/section-pro.php' );

		
		/*
		Start edsbootstrap Options
		=====================================================
		*/
		$manager->add_section( 'edsbootstrap_options', array(
			 'title'    => esc_attr__( 'Lite Theme Options', 'edsbootstrap' ),
			 'priority' => 35,
		) );
		
		/*
		Show social on header
		*/
		$manager->add_setting('edsbootstrap_theme_options_socialheader', array(
			'default' => 1,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'edsbootstrap_sanitize_checkbox')
		) );
		
		$manager->add_control('edsbootstrap_theme_options_socialheader', array(
			'label'      => __( 'Show Social Buttons on Header', 'edsbootstrap' ),
			'section'    => 'edsbootstrap_options',
			'settings'   => 'edsbootstrap_theme_options_socialheader',
			'type'       => 'checkbox',
		) );
		
		/*
		Show social on footer
		*/
		$manager->add_setting('edsbootstrap_theme_options_socialfooter', array(
			'default'    => 1,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'edsbootstrap_sanitize_checkbox')
		) );
		
		$manager->add_control('edsbootstrap_theme_options_socialfooter', array(
			'label'      => __( 'Show Social Buttons on Footer', 'edsbootstrap' ),
			'section'    => 'edsbootstrap_options',
			'settings'   => 'edsbootstrap_theme_options_socialfooter',
			'type'       => 'checkbox',
		) );
		/*
		Show Contact Info on Header
		*/
		$manager->add_setting('edsbootstrap_theme_options_contact_info', array(
			'default'    => 1,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'edsbootstrap_sanitize_checkbox')
		) );
		$manager->add_control('edsbootstrap_theme_options_show_top', array(
			'label'      => __( 'Show Contact Info on Header', 'edsbootstrap' ),
			'section'    => 'edsbootstrap_options',
			'settings'   => 'edsbootstrap_theme_options_contact_info',
			'type'       => 'checkbox',
		) );
		
		/*
		Show Page Side Bar
		*/
		$manager->add_setting('edsbootstrap_show_page_sidebar', array(
			'default'    => 0,
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'edsbootstrap_sanitize_checkbox')
		) );
		$manager->add_control('edsbootstrap_theme_options_show_top', array(
			'label'      => __( 'Show Sidebar Inside page layout', 'edsbootstrap' ),
			'section'    => 'edsbootstrap_options',
			'settings'   => 'edsbootstrap_show_page_sidebar',
			'type'       => 'checkbox',
		) );
		
		/*
		Show full post or excerpt
		=====================================================
		*/
		$manager->add_setting('edsbootstrap_theme_options_postshow', array(
			'default'    => 'excerpt',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'edsbootstrap_sanitize_select')
		) );
		
		$manager->add_control('edsbootstrap_theme_options_postshow', array(
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
		$manager->add_setting('edsbootstrap_theme_options[blog][heading]', array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type'     => 'theme_mod',
			'default' => __('Blog - Posts List', 'edsbootstrap')
		));
		$manager->add_control('edsbootstrap_theme_options_blog' , 
			array(
				'label' => __('Blog Posts List Page Title', 'edsbootstrap'),
				'section'    => 'edsbootstrap_options',
				'settings' =>'edsbootstrap_theme_options[blog][heading]',
			)
		);
		 /*
		 Blog Heading Text
		 */
		$manager->add_setting('edsbootstrap_theme_options[blog][sub_heading]', array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type'     => 'theme_mod',
			'default' =>__('There are many variations of passages', 'edsbootstrap')
		));
		$manager->add_control('edsbootstrap_theme_options_sub_heading' , 
			array(
				'label' => __('Blog Posts List Page Sub Title', 'edsbootstrap'),
				'section'    => 'edsbootstrap_options',
				'settings' =>'edsbootstrap_theme_options[blog][sub_heading]',
			)
		);
		
		foreach( $edsbootstrap_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				$manager->add_setting('edsbootstrap_theme_options['.$key .']['. $k .']',
					array(
						'default' => $val['default'],
						'capability'     => 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
						'type'     => 'theme_mod',
					)
				);
				// CONTROLS
				$manager->add_control('edsbootstrap_theme_options_text_field_' . $k , 
					array(
						'label' => $val['label'], 
						'section'    => 'edsbootstrap_options',
						'settings' =>'edsbootstrap_theme_options['.$key .']['. $k .']',
					)
				);
			
			endforeach;
		endforeach;

		// Register custom section types.
		$manager->register_section_type( 'Example_1_Customize_Section_Pro' );
		// Register sections.
		$manager->add_section(
			new Example_1_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'title'    => esc_html__( 'eds bootstrap Pro', 'edsbootstrap' ),
					'pro_text' => esc_html__( 'Go Pro',         'edsbootstrap' ),
					'pro_url'  => 'http://edatastyle.com/product/eds-bootstrap-wp/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'example-1-customize-controls', trailingslashit( get_template_directory_uri() ) . 'customizer/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'example-1-customize-controls', trailingslashit( get_template_directory_uri() ) . 'customizer/customize-controls.css' );
	}
	
	public function edsbootstrap_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	function edsbootstrap_sanitize_select( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}

// Doing this customizer thang!
Example_1_Customize::get_instance();
