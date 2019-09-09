<?php
/**
 * Esteem Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.2.7
 */
function esteem_customize_register($wp_customize) {

	// Theme important links started
   class Esteem_Important_Links extends WP_Customize_Control {

      public $type = "esteem-important-links";

      public function render_content() {
         //Add Theme instruction, Support Forum, Demo Link, Rating Link
         $important_links = array(
            'theme-info' => array(
               'link' => esc_url('http://themegrill.com/themes/esteem/'),
               'text' => __('Theme Info', 'esteem'),
            ),
            'support' => array(
               'link' => esc_url('http://themegrill.com/support-forum/'),
               'text' => __('Support Forum', 'esteem'),
            ),
            'documentation' => array(
               'link' => esc_url('http://docs.themegrill.com/esteem/'),
               'text' => __('Documentation', 'esteem'),
            ),
            'demo' => array(
               'link' => esc_url('http://themegrill.com/themes/esteem-pro/'),
               'text' => __('View Pro', 'esteem'),
            ),
            'view-pro' => array(
               'link' => esc_url('http://demo.themegrill.com/esteem/'),
               'text' => __('View Demo', 'esteem'),
            ),
            'rating' => array(
               'link' => esc_url('http://wordpress.org/support/view/theme-reviews/esteem?filter=5'),
               'text' => __('Rate this theme', 'esteem'),
            ),
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
      }

   }

   $wp_customize->add_section('esteem_important_links', array(
      'priority' => 1,
      'title' => __('Esteem Important Links', 'esteem'),
   ));

   /**
    * This setting has the dummy Sanitization function as it contains no value to be sanitized
    */
   $wp_customize->add_setting('esteem_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_links_sanitize'
   ));

   $wp_customize->add_control(new Esteem_Important_Links($wp_customize, 'important_links', array(
      'section' => 'esteem_important_links',
      'settings' => 'esteem_important_links'
   )));
   // Theme Important Links Ended

	/* Header Options Area */
   $wp_customize->add_panel('esteem_header_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 300,
      'title' => __('Header', 'esteem')
   ));

   // Header Logo upload option
	$wp_customize->add_section('esteem_header_title_logo', array(
		'title'     => __( 'Header Logo', 'esteem' ),
		'priority'  => 10,
  		'panel' => 'esteem_header_options'
	));

	if ( !function_exists('the_custom_logo') ) {
		$wp_customize->add_setting('esteem_header_logo_image', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'esteem_sanitize_url',
	      'sanitize_js_callback' => 'esteem_sanitize_js_url'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, 'esteem_header_logo_image', array(
				'label' 		=> __( 'Upload logo for your header.', 'esteem' ),
				'description' => sprintf(__( '%sInfo:%s This option will be removed in upcoming update. Please go to Site Identity section to upload the theme logo.', 'esteem'  ), '<strong>', '</strong>'),
				'section' 	=> 'esteem_header_title_logo',
				'settings' 	=> 'esteem_header_logo_image'
			))
		);
	}

	// Header logo and text display type option
	$wp_customize->add_section('esteem_show_logo_text_setting', array(
		'title'     => __( 'Show', 'esteem' ),
		'priority'  => 12,
  		'panel' => 'esteem_header_options'
	));

	$wp_customize->add_setting('esteem_show_header_logo_text', array(
      'default' => 'text_only',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control('esteem_show_header_logo_text', array(
      'type' => 'radio',
      'label' => __('Choose the option that you want.', 'esteem'),
      'section' => 'esteem_show_logo_text_setting',
      'choices' => array(
         'logo_only' => __('Header Logo Only', 'esteem'),
         'text_only' => __('Header Text Only', 'esteem'),
         'both' => __('Show Both', 'esteem'),
         'none' => __('Disable', 'esteem')
      )
   ));

   // New Responsive Menu
   $wp_customize->add_section('esteem_new_menu', array(
      'priority' => 14,
      'title'    => __('Responsive Menu Style', 'esteem'),
      'panel'    => 'esteem_header_options'
   ));

   $wp_customize->add_setting('esteem_new_menu_enable',	array(
		'default' => '1',
      	'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esteem_sanitize_checkbox'
	));
	$wp_customize->add_control('esteem_new_menu_enable',	array(
		'type' => 'checkbox',
		'label' => __('Switch to new responsive menu.', 'esteem' ),
		'section' => 'esteem_new_menu'
	));

   // Promo bar
   $wp_customize->add_section('esteem_slogan_setting', array(
      'priority' => 20,
      'title' => __('Promo box Primary Slogan', 'esteem'),
      'panel' => 'esteem_header_options'
   ));

	$wp_customize->add_setting('esteem_slogan', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_text_sanitize'
	));
	$wp_customize->add_control('esteem_slogan', array(
		'label' => __( 'Enter the main Slogan', 'esteem' ),
		'section' => 'esteem_slogan_setting'
	));

	// Promo Sub Slogan
   $wp_customize->add_section('esteem_sub_slogan_setting', array(
      'priority' => 30,
      'title' => __('Promo box secondary Slogan', 'esteem'),
      'panel' => 'esteem_header_options'
   ));

	$wp_customize->add_setting('esteem_sub_slogan', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_text_sanitize'
	));
	$wp_customize->add_control('esteem_sub_slogan', array(
		'label' => __( 'Enter the sub slogan', 'esteem' ),
		'section' => 'esteem_sub_slogan_setting'
	));

	// Promo Button Text
   $wp_customize->add_section('esteem_button_text_setting', array(
      'priority' => 40,
      'title' => __('Button Text', 'esteem'),
      'panel' => 'esteem_header_options'
   ));

	$wp_customize->add_setting('esteem_button_text', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control('esteem_button_text', array(
		'label' => __( 'Button Text', 'esteem' ),
		'section' => 'esteem_button_text_setting'
	));

	// Promo Button Text Link
   $wp_customize->add_section('esteem_button_link_setting', array(
      'priority' => 50,
      'title' => __('Button redirect link', 'esteem'),
      'panel' => 'esteem_header_options'
   ));

	$wp_customize->add_setting('esteem_button_redirect_link', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_text_sanitize'
	));
	$wp_customize->add_control('esteem_button_redirect_link', array(
		'label' => __( 'Enter redirect link', 'esteem' ),
		'section' => 'esteem_button_link_setting'
	));

 /**************************************************************************************/

	/* Design Options Area */
   $wp_customize->add_panel('esteem_design_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 310,
      'title' => __('Design', 'esteem')
   ));

	// Site Layout
	$wp_customize->add_section('esteem_site_layout_setting', array(
		'title'     => __( 'Site Layout', 'esteem' ),
		'priority'  => 10,
  		'panel' => 'esteem_design_options'
	));

	$wp_customize->add_setting('esteem_site_layout', array(
      'default' => 'box',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control('esteem_site_layout', array(
      'type' => 'radio',
      'label' => __('Choose your site layout. The change is reflected in whole site.', 'esteem'),
      'section' => 'esteem_site_layout_setting',
      'choices' => array(
         'box' => __('Boxed layout', 'esteem'),
         'wide' => __('Wide layout', 'esteem')
      )
   ));

   class ESTEEM_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<style>
				#esteem-img-container .esteem-radio-img-img {
					border: 3px solid #DEDEDE;
					margin: 0 5px 5px 0;
					cursor: pointer;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				#esteem-img-container .esteem-radio-img-selected {
					border: 3px solid #AAA;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				input[type=checkbox]:before {
					content: '';
					margin: -3px 0 0 -4px;
				}
			</style>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul class="controls" id = 'esteem-img-container'>
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'esteem-radio-img-selected esteem-radio-img-img':'esteem-radio-img-img';
					?>
					<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<script type="text/javascript">

				jQuery(document).ready(function($) {
					$('.controls#esteem-img-container li img').click(function(){
						$('.controls#esteem-img-container li').each(function(){
							$(this).find('img').removeClass ('esteem-radio-img-selected') ;
						});
						$(this).addClass ('esteem-radio-img-selected') ;
					});
				});

			</script>
			<?php
		}
	}

   // Default layout
	$wp_customize->add_section('esteem_default_layout_setting', array(
		'title' => __( 'Default layout', 'esteem' ),
		'priority' => 20,
  		'panel' => 'esteem_design_options'
	));

	$wp_customize->add_setting('esteem_default_layout', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new ESTEEM_Image_Radio_Control($wp_customize, 'esteem_default_layout', array(
	      'type' => 'radio',
	      'label' => __('Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.. The change is reflected in whole site.', 'esteem'),
	      'section' => 'esteem_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> ESTEEM_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'		=> ESTEEM_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			)
		))
   );

   // Default layout for pages only
	$wp_customize->add_section('esteem_pages_default_layout_setting', array(
		'title' => __( 'Default layout for pages only', 'esteem' ),
		'priority' => 30,
  		'panel' => 'esteem_design_options'
	));

	$wp_customize->add_setting('esteem_pages_default_layout', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new ESTEEM_Image_Radio_Control($wp_customize, 'esteem_pages_default_layout', array(
	      'type' => 'radio',
	      'label' => __('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'esteem'),
	      'section' => 'esteem_pages_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> ESTEEM_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'		=> ESTEEM_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			)
		))
   );

	// Default layout for single posts only
	$wp_customize->add_section('esteem_single_posts_default_layout_setting', array(
		'title' => __( 'Default layout for single posts only', 'esteem' ),
		'priority' => 40,
  		'panel' => 'esteem_design_options'
	));

	$wp_customize->add_setting('esteem_single_posts_default_layout', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new ESTEEM_Image_Radio_Control($wp_customize, 'esteem_single_posts_default_layout', array(
	      'type' => 'radio',
	      'label' => __('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'esteem'),
	      'section' => 'esteem_single_posts_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> ESTEEM_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'		=> ESTEEM_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> ESTEEM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			)
		))
   );

   // Blog page display type
	$wp_customize->add_section('esteem_posts_page_display_type_setting', array(
		'title' => __( 'Blog page display type', 'esteem' ),
		'priority' => 50,
  		'panel' => 'esteem_design_options'
	));

	$wp_customize->add_setting('esteem_posts_page_display_type', array(
      'default' => 'full_content',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_radio_sanitize'
   ));
   $wp_customize->add_control('esteem_posts_page_display_type', array(
   	'type' => 'radio',
   	'label' => __('Choose the display type for the latests posts view or posts page view (static front page).', 'esteem'),
   	'section' => 'esteem_posts_page_display_type_setting',
      'choices' => array(
	   	'large_image' 	=> __( 'Large featured image', 'esteem' ),
			'small_image' 	=> __( 'Small featured image', 'esteem' ),
			'full_content' 	=> __( 'Full Content', 'esteem' )
		)
	));

	// Site primary color option
   $wp_customize->add_section('esteem_primary_color_setting', array(
      'panel' => 'esteem_design_options',
      'priority' => 60,
      'title' => __('Primary color option', 'esteem')
   ));

   $wp_customize->add_setting('esteem_primary_color', array(
      'default' => '#ED564B',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esteem_color_option_hex_sanitize',
      'sanitize_js_callback' => 'esteem_color_escaping_option_sanitize'
   ));
   $wp_customize->add_control(
   	new WP_Customize_Color_Control($wp_customize, 'esteem_primary_color', array(
	      'label' => __('This will reflect in links, buttons and many others. Choose a color to match your site.', 'esteem'),
	      'section' => 'esteem_primary_color_setting',
	      'settings' => 'esteem_primary_color'
   	))
   );

   // Custom CSS setting
   class ESTEEM_Custom_CSS_Control extends WP_Customize_Control {

      public $type = 'custom_css';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }
   }

   if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
	   $wp_customize->add_section('esteem_custom_css_setting', array(
	      'priority' => 70,
	      'title' => __('Custom CSS', 'esteem'),
	      'panel' => 'esteem_design_options'
	   ));

	   $wp_customize->add_setting('esteem_custom_css', array(
	      'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'wp_filter_nohtml_kses',
	      'sanitize_js_callback' => 'wp_filter_nohtml_kses'
	   ));
	   $wp_customize->add_control(
	   	new ESTEEM_Custom_CSS_Control($wp_customize, 'esteem_custom_css', array(
		      'label' => __('Write your custom css.', 'esteem'),
		      'section' => 'esteem_custom_css_setting',
		      'settings' => 'esteem_custom_css'
	   	))
	   );
	}
   // End of the Design Options

 /**************************************************************************************/

	/* Additional Options Area */
   $wp_customize->add_panel('esteem_additional_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 320,
      'title' => __('Additional', 'esteem')
   ));

	if ( ! function_exists( 'has_site_icon' ) || ( ! has_site_icon() && ( get_theme_mod( 'esteem_favicon', '' ) != '' ) ) ) {
		// Favicon Activate Option
		$wp_customize->add_section('esteem_favicon_setting', array(
			'title'     => __( 'Activate favicon', 'esteem' ),
			'priority'  => 10,
	  		'panel' => 'esteem_additional_options'
		));

		$wp_customize->add_setting('esteem_activate_favicon',	array(
			'default' => 0,
	      'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esteem_sanitize_checkbox'
		));
		$wp_customize->add_control('esteem_activate_favicon',	array(
			'type' => 'checkbox',
			'label' => __('Check to activate favicon. Upload fav icon from below option', 'esteem' ),
			'section' => 'esteem_favicon_setting'
		));

		// Favicon Upload Option
		$wp_customize->add_section('esteem_favicon_upload_setting', array(
			'title'     => __( 'Upload favicon', 'esteem' ),
			'priority'  => 20,
	  		'panel' => 'esteem_additional_options'
		));

		$wp_customize->add_setting('esteem_favicon', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'esteem_sanitize_url',
	      'sanitize_js_callback' => 'esteem_sanitize_js_url'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, 'esteem_favicon', array(
				'label' 		=> __( 'Upload favicon for your site.', 'esteem' ),
				'section' 	=> 'esteem_favicon_upload_setting',
				'settings' 	=> 'esteem_favicon'
			))
		);
	}

 /**************************************************************************************/

	/* Slider Options Area */
   $wp_customize->add_panel('esteem_slider_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 330,
      'title' => __('Slider', 'esteem'),
   ));

   // Slider activate option
	$wp_customize->add_section('esteem_activate_slider_setting', array(
		'title'     => __( 'Activate slider', 'esteem' ),
		'priority'  => 10,
		'panel' => 'esteem_slider_options'
	));

	$wp_customize->add_setting('esteem_activate_slider',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esteem_sanitize_checkbox'
	));
	$wp_customize->add_control('esteem_activate_slider',	array(
		'type' => 'checkbox',
		'label' => __('Check to activate slider.', 'esteem' ),
		'section' => 'esteem_activate_slider_setting'
	));

	// Slide options
	for( $i=1; $i<=4; $i++) {
		// Slider Image upload
		$wp_customize->add_section('esteem_slider_image_setting'.$i, array(
			'title'	=> sprintf( __( 'Image Upload #%1$s', 'esteem' ), $i ),
			'priority'	=> $i+50,
			'panel' => 'esteem_slider_options'
		));

		$wp_customize->add_setting('esteem_slider_image'.$i, array(
			'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'esteem_sanitize_url',
	      'sanitize_js_callback' => 'esteem_sanitize_js_url'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, 'esteem_slider_image'.$i, array(
				'label' 		=> __( 'Upload slider image.', 'esteem' ),
				'section' 	=> 'esteem_slider_image_setting'.$i,
				'settings' 	=> 'esteem_slider_image'.$i
			))
		);

		// Slider Title
		$wp_customize->add_setting('esteem_slider_title'.$i, array(
			'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'wp_filter_nohtml_kses'

		));
		$wp_customize->add_control('esteem_slider_title'.$i, array(
			'label'	=> __( 'Enter title for your slider.', 'esteem' ),
			'section'	=> 'esteem_slider_image_setting'.$i,
			'settings' 	=> 'esteem_slider_title'.$i
		));

		// Slider Description
		$wp_customize->add_setting('esteem_slider_text'.$i, array(
			'default' => '',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'esteem_text_sanitize'

		));
		$wp_customize->add_control(
			new ESTEEM_Custom_CSS_Control($wp_customize,'esteem_slider_text'.$i, array(
				'label'	=> __( 'Enter your slider description.', 'esteem' ),
				'section' 	=> 'esteem_slider_image_setting'.$i,
				'settings' 	=> 'esteem_slider_text'.$i
			))
		);

		// Slider Link
		$wp_customize->add_setting('esteem_slider_link'.$i, array(
			'default' => '',
	      'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esteem_sanitize_url',
	      'sanitize_js_callback' => 'esteem_sanitize_js_url'

		));
		$wp_customize->add_control('esteem_slider_link'.$i, array(
			'label'	=> __( 'Enter link to redirect slider when clicked', 'esteem' ),
			'section'	=> 'esteem_slider_image_setting'.$i,
			'settings'	=> 'esteem_slider_link'.$i
		));
	}

 /**************************************************************************************/

	function esteem_sanitize_checkbox($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }
   function esteem_sanitize_url( $input ) {
		$input = esc_url_raw( $input );
		return $input;
	}
	function esteem_sanitize_js_url ( $input ) {
		$input = esc_url( $input );
		return $input;
	}

	// Color sanitization
   function esteem_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }

   function esteem_color_escaping_option_sanitize($input) {
      $input = esc_attr($input);
      return $input;
   }

	// Radio and Select Sanitization
   function esteem_radio_sanitize( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Text sanitization
	function esteem_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	// Sanitization of links
   function esteem_links_sanitize() {
      return false;
   }
}
add_action('customize_register', 'esteem_customize_register');

/*****************************************************************************************/

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'esteem_customizer_custom_scripts' );

function esteem_customizer_custom_scripts() { ?>
<style>
	/* Theme Instructions Panel CSS */
	li#accordion-section-esteem_important_links h3.accordion-section-title, li#accordion-section-esteem_important_links h3.accordion-section-title:focus { background-color: #ED564B !important; color: #fff !important; }
	li#accordion-section-esteem_important_links h3.accordion-section-title:hover { background-color: #ED564B !important; color: #fff !important; }
	li#accordion-section-esteem_important_links h3.accordion-section-title:after { color: #fff !important; }
	/* Upsell button CSS */
	.customize-control-esteem-important-links a {
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
		background: #008EC2;
		color: #fff;
		display: block;
		margin: 15px 0 0;
		padding: 5px 0;
		text-align: center;
		font-weight: 600;
	}

	.customize-control-esteem-important-links a{
		padding: 8px 0;
	}

	.customize-control-esteem-important-links a:hover {
		color: #ffffff;
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
		background:#2380BA;
	}
</style>
<?php
}
