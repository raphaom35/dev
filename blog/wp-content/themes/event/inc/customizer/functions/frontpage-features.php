<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
class Event_Category_Control extends WP_Customize_Control {
	public $type = 'select';
	public function render_content() {
	$event_settings = event_get_theme_options();
	$event_categories = get_categories(); ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
			<?php
				foreach ( $event_categories as $category) :?>
						<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $event_settings) ) { echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
			</select>
		</label>
	<?php 
	}
}

/******************** EVENT FRONTPAGE  *********************************************/
/* Frontpage Event Booking */
$event_settings = event_get_theme_options();
$wp_customize->add_section( 'event_frontpage_booking', array(
	'title' => __('Frontpage Event Booking','event'),
	'priority' => 400,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_frontpage_features', array(
	'title' => __('Frontpage Features','event'),
	'priority' => 500,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_upcoming_features', array(
	'title' => __('Upcoming Event','event'),
	'priority' => 600,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_our_speaker_features', array(
	'title' => __('Our Speaker','event'),
	'priority' => 700,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_program_schedule_features', array(
	'title' => __('Program Schedule','event'),
	'priority' => 800,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_our_gallery_features', array(
	'title' => __('Our Gallery','event'),
	'priority' => 900,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_section( 'event_our_testimonial_features', array(
	'title' => __('Our Testimonial','event'),
	'priority' => 1000,
	'panel' =>'event_frontpage_panel'
));
$wp_customize->add_setting( 'event_theme_options[event_display_book_appoinment]', array(
	'default' => $event_settings['event_display_book_appoinment'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_display_book_appoinment]', array(
	'priority' => 410,
	'label' => __('Disable Appointment Booking', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'checkbox',
));
$wp_customize->add_setting('event_theme_options[event_title]', array(
	'default' =>$event_settings['event_title'],
	'sanitize_callback' =>'event_sanitize_page',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control( 'event_theme_options[event_title]', array(
	'priority' => 415,
	'label' => __('Event Page', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'dropdown-pages',
));
$wp_customize->add_setting( 'event_theme_options[event_date_picker]', array(
	'default'				=>$event_settings['event_date_picker'],
	'capability'			=> 'manage_options',
	'sanitize_callback'	=> 'esc_attr',
	'type'				=> 'option'
));
$wp_customize->add_control('event_theme_options[event_date_picker]',array(
	'priority' 				=> 418,
	'label'					=> __('Select Date','event'),
	'section'				=> 'event_frontpage_booking',
	'type'					=>'date',
	'input_attrs' => array(
	'id' => 'datepicker',
	'placeholder' => __( 'mm-dd-yyyy','event' ),
  ),
));
$wp_customize->add_setting('event_theme_options[event_date_time]', array(
	'default' =>$event_settings['event_date_time'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_date_time]', array(
	'priority' =>420,
	'label' => __('Event Time', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'text',
));
$wp_customize->add_setting('event_theme_options[event_venue]', array(
	'default' =>$event_settings['event_venue'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_venue]', array(
	'priority' =>425,
	'label' => __('Event Venue', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'text',
));
$wp_customize->add_setting('event_theme_options[event_book_appointment]', array(
	'default' =>$event_settings['event_book_appointment'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_book_appointment]', array(
	'priority' =>430,
	'label' => __('Book Appointment Text', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'text',
));
$wp_customize->add_setting('event_theme_options[event_book_appointment_url]', array(
	'default' =>$event_settings['event_book_appointment_url'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('event_theme_options[event_book_appointment_url]', array(
	'priority' =>435,
	'label' => __('Book Appointment Url', 'event'),
	'section' => 'event_frontpage_booking',
	'type' => 'text',
)); 

/* Frontpage Features */
$wp_customize->add_setting( 'event_theme_options[event_disable_features]', array(
	'default' => $event_settings['event_disable_features'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_features]', array(
	'priority' => 500,
	'label' => __('Disable Front Page Features', 'event'),
	'section' => 'event_frontpage_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting('event_theme_options[event_front_page_section]', array(
		'default' => $event_settings['event_front_page_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_front_page_section]', array(
	'priority' =>510,
	'label' => __('Display Front Page Section', 'event'),
	'section' => 'event_frontpage_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'below_upcoming_event' => __('Below Upcoming Event','event'),
		'below_our_speaker' => __('Below Our Speaker','event'),
		'below_program_schedule' => __('Below Program Schedule','event'),
		'below_our_gallery' => __('Below Our Gallery','event'),
		'below_our_testimonial' => __('Below Our Testimonial','event'),
	),
));
$wp_customize->add_setting( 'event_theme_options[event_disable_features_readmore]', array(
	'default' => $event_settings['event_disable_features_readmore'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_features_readmore]', array(
	'priority' => 520,
	'label' => __('Disable Read More Button', 'event'),
	'section' => 'event_frontpage_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'event_theme_options[event_features_title]', array(
	'default' => $event_settings['event_features_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_features_title]', array(
	'priority' => 530,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_frontpage_features',
	'settings' => 'event_theme_options[event_features_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_features_description]', array(
	'default' => $event_settings['event_features_description'],
	'sanitize_callback' => 'esc_textarea',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_features_description]', array(
	'priority' => 540,
	'label' => __( 'Description', 'event' ),
	'section' => 'event_frontpage_features',
	'settings' => 'event_theme_options[event_features_description]',
	'type' => 'textarea',
	)
);
for ( $i=1; $i <= $event_settings['event_total_features'] ; $i++ ) {
	$wp_customize->add_setting('event_theme_options[event_frontpage_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'event_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'event_theme_options[event_frontpage_features_'. $i .']', array(
		'priority' => 501 . $i,
		'label' => __(' Feature #', 'event') . ' ' . $i ,
		'section' => 'event_frontpage_features',
		'type' => 'dropdown-pages',
	));
}
/* Upcoming Event */
$wp_customize->add_setting( 'event_theme_options[event_disable_upcoming]', array(
	'default' => $event_settings['event_disable_upcoming'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_upcoming]', array(
	'priority' => 600,
	'label' => __('Disable Upcoming Event', 'event'),
	'section' => 'event_upcoming_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting('event_theme_options[event_upcoming_event_section]', array(
		'default' => $event_settings['event_upcoming_event_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_upcoming_event_section]', array(
	'priority' =>605,
	'label' => __('Display Upcoming Event', 'event'),
	'section' => 'event_upcoming_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'below_our_speaker' => __('Below Our Speaker','event'),
		'below_program_schedule' => __('Below Program Schedule','event'),
		'below_our_gallery' => __('Below Our Gallery','event'),
		'below_our_testimonial' => __('Below Our Testimonial','event'),
	),
));
$wp_customize->add_setting( 'event_theme_options[event_upcoming_title]', array(
	'default' => $event_settings['event_upcoming_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_upcoming_title]', array(
	'priority' => 610,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_upcoming_features',
	'settings' => 'event_theme_options[event_upcoming_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_upcoming_bg_image]',array(
	'default'	=> $event_settings['event_upcoming_bg_image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'event_theme_options[event_upcoming_bg_image]', array(
	'label' => __('Background Image','event'),
	'description' => __('Image will be displayed on background of Upcoming Event','event'),
	'priority'	=> 620,
	'section' => 'event_upcoming_features',
	)
));
$wp_customize->add_setting( 'event_theme_options[event_upcoming_category_list]', array(
		'default'				=>array(),
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'event_sanitize_upcoming_select',
		'type'				=> 'option'
	));
	$wp_customize->add_control(
		new Event_Category_Control(
		$wp_customize,
		'event_theme_options[event_upcoming_category_list]',
			array(
				'priority' 				=> 630,
				'label'					=> __('Select Category','event'),
				'section'				=> 'event_upcoming_features',
				'settings'				=> 'event_theme_options[event_upcoming_category_list]',
				'type'					=>'select'
			)
		)
	);
/* Our Speaker */
$wp_customize->add_setting( 'event_theme_options[event_disable_our_speaker]', array(
	'default' => $event_settings['event_disable_our_speaker'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_our_speaker]', array(
	'priority' => 700,
	'label' => __('Disable Our Speaker', 'event'),
	'section' => 'event_our_speaker_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'event_theme_options[event_our_speaker_title]', array(
	'default' => $event_settings['event_our_speaker_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_setting('event_theme_options[event_our_speaker_section]', array(
		'default' => $event_settings['event_our_speaker_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_our_speaker_section]', array(
	'priority' =>705,
	'label' => __('Display Our Speaker', 'event'),
	'section' => 'event_our_speaker_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'above_front_page_feature' => __('Above Front Page feature','event'),
		'below_program_schedule' => __('Below Program Schedule','event'),
		'below_our_gallery' => __('Below Our Gallery','event'),
		'below_our_testimonial' => __('Below Our Testimonial','event'),
	),
));
$wp_customize->add_control( 'event_theme_options[event_our_speaker_title]', array(
	'priority' => 710,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_our_speaker_features',
	'settings' => 'event_theme_options[event_our_speaker_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_our_speaker_description]', array(
	'default' => $event_settings['event_our_speaker_description'],
	'sanitize_callback' => 'esc_textarea',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_our_speaker_description]', array(
	'priority' => 720,
	'label' => __( 'Description', 'event' ),
	'section' => 'event_our_speaker_features',
	'settings' => 'event_theme_options[event_our_speaker_description]',
	'type' => 'textarea',
	)
);
for ( $i=1; $i <= $event_settings['event_total_our_speaker'] ; $i++ ) {
	$wp_customize->add_setting('event_theme_options[event_our_speaker_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'event_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'event_theme_options[event_our_speaker_features_'. $i .']', array(
		'priority' => 73 . $i,
		'label' => __(' Feature #', 'event') . ' ' . $i ,
		'section' => 'event_our_speaker_features',
		'type' => 'dropdown-pages',
	));
	$wp_customize->add_setting( 'event_theme_options[event_our_speaker_position_'. $i .']', array(
	'default' => '',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	) );
	$wp_customize->add_control( 'event_theme_options[event_our_speaker_position_'. $i .']', array(
	'priority' => 73 . $i,
	'label' => __( 'Speaker Position #', 'event' ) . ' ' . $i ,
	'section' => 'event_our_speaker_features',
	'settings' => 'event_theme_options[event_our_speaker_position_'. $i .']',
	'type' => 'text',
	) );
	$wp_customize->add_setting( 'event_theme_options[event_our_speaker_about_'. $i .']', array(
		'default' => '',
		'sanitize_callback' => 'esc_textarea',
		'type' => 'option',
		'capability' => 'manage_options'
		)
	);
	$wp_customize->add_control( 'event_theme_options[event_our_speaker_about_'. $i .']', array(
		'priority' => 73 . $i,
		'label' => __( 'Speaker About Brief #', 'event' ) . ' ' . $i ,
		'section' => 'event_our_speaker_features',
		'settings' => 'event_theme_options[event_our_speaker_about_'. $i .']',
		'type' => 'textarea',
	) );
}
/* Program Schedule */
$wp_customize->add_setting( 'event_theme_options[event_disable_program_schedule]', array(
	'default' => $event_settings['event_disable_program_schedule'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_program_schedule]', array(
	'priority' => 800,
	'label' => __('Disable Program Schedule', 'event'),
	'section' => 'event_program_schedule_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting('event_theme_options[event_program_schedule_section]', array(
		'default' => $event_settings['event_program_schedule_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_program_schedule_section]', array(
	'priority' =>805,
	'label' => __('Display Program Schedule', 'event'),
	'section' => 'event_program_schedule_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'above_front_page_feature' => __('Above Front Page feature','event'),
		'above_upcoming_event' => __('Above upcoming Event','event'),
		'below_our_gallery' => __('Below Our Gallery','event'),
		'below_our_testimonial' => __('Below Our Testimonial','event'),
	),
));
$wp_customize->add_setting( 'event_theme_options[event_program_schedule_title]', array(
	'default' => $event_settings['event_program_schedule_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_program_schedule_title]', array(
	'priority' => 810,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_program_schedule_features',
	'settings' => 'event_theme_options[event_program_schedule_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_program_schedule_description]', array(
	'default' => $event_settings['event_program_schedule_description'],
	'sanitize_callback' => 'esc_textarea',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_program_schedule_description]', array(
	'priority' => 820,
	'label' => __( 'Description', 'event' ),
	'section' => 'event_program_schedule_features',
	'settings' => 'event_theme_options[event_program_schedule_description]',
	'type' => 'textarea',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_program_schedule_bg_image]',array(
	'default'	=> $event_settings['event_program_schedule_bg_image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'event_theme_options[event_program_schedule_bg_image]', array(
	'label' => __('Background Image','event'),
	'description' => __('Image will be displayed on background of Program Schedule','event'),
	'priority'	=> 830,
	'section' => 'event_program_schedule_features',
	)
));

for ( $i=1; $i <= $event_settings['event_total_program_schedule'] ; $i++ ) {
	$wp_customize->add_setting( 'event_theme_options[event_program_schedule_features_'. $i .']', array(
		'default'				=>array(),
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'event_sanitize_upcoming_select',
		'type'				=> 'option'
	));
	$wp_customize->add_control(
		new Event_Category_Control(
		$wp_customize,
		'event_theme_options[event_program_schedule_features_'. $i .']',
			array(
				'priority' => 830 . $i,
				'label' => __(' Category Schedule #', 'event') . ' ' . $i ,
				'section'				=> 'event_program_schedule_features',
				'settings'				=> 'event_theme_options[event_program_schedule_features_'. $i .']',
				'type'					=>'select'
			)
		)
	);
}
/* Gallery */
$wp_customize->add_setting( 'event_theme_options[event_disable_our_gallery]', array(
	'default' => $event_settings['event_disable_our_gallery'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_our_gallery]', array(
	'priority' => 900,
	'label' => __('Disable Gallery', 'event'),
	'section' => 'event_our_gallery_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting('event_theme_options[event_our_gallery_section]', array(
		'default' => $event_settings['event_our_gallery_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_our_gallery_section]', array(
	'priority' =>905,
	'label' => __('Display Our Gallery', 'event'),
	'section' => 'event_our_gallery_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'above_front_page_feature' => __('Above Front Page feature','event'),
		'above_upcoming_event' => __('Above upcoming Event','event'),
		'above_our_speaker' => __('Aboove Our Speaker','event'),
		'below_our_testimonial' => __('Below Our Testimonial','event'),
	),
));
$wp_customize->add_setting( 'event_theme_options[event_our_gallery_title]', array(
	'default' => $event_settings['event_our_gallery_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_our_gallery_title]', array(
	'priority' => 910,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_our_gallery_features',
	'settings' => 'event_theme_options[event_our_gallery_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_our_gallery_description]', array(
	'default' => $event_settings['event_our_gallery_description'],
	'sanitize_callback' => 'esc_textarea',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'event_theme_options[event_our_gallery_description]', array(
	'priority' => 920,
	'label' => __( 'Description', 'event' ),
	'section' => 'event_our_gallery_features',
	'settings' => 'event_theme_options[event_our_gallery_description]',
	'type' => 'textarea',
	)
);
for ( $i=1; $i <= $event_settings['event_total_our_gallery'] ; $i++ ) {
	$wp_customize->add_setting('event_theme_options[event_our_gallery_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'event_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'event_theme_options[event_our_gallery_features_'. $i .']', array(
		'priority' => 93 . $i,
		'label' => __(' Gallery #', 'event') . ' ' . $i ,
		'section' => 'event_our_gallery_features',
		'type' => 'dropdown-pages',
	));
}
/* Testimonial Box */
$wp_customize->add_setting( 'event_theme_options[event_disable_our_testimonial]', array(
	'default' => $event_settings['event_disable_our_testimonial'],
	'sanitize_callback' => 'event_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'event_theme_options[event_disable_our_testimonial]', array(
	'priority' => 1000,
	'label' => __('Disable Testimonial', 'event'),
	'section' => 'event_our_testimonial_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'event_theme_options[event_our_testimonial_title]', array(
	'default' => $event_settings['event_our_testimonial_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_setting('event_theme_options[event_our_testimonial_section]', array(
		'default' => $event_settings['event_our_testimonial_section'],
		'sanitize_callback' => 'event_sanitize_select',
		'type' => 'option',
));
$wp_customize->add_control('event_theme_options[event_our_testimonial_section]', array(
	'priority' =>1005,
	'label' => __('Display Our Testimonial', 'event'),
	'section' => 'event_our_testimonial_features',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'default' => __('Default','event'),
		'above_front_page_feature' => __('Above Front Page feature','event'),
		'above_upcoming_event' => __('Above upcoming Event','event'),
		'above_our_speaker' => __('Aboove Our Speaker','event'),
		'above_program_schedule_event' => __('Above Program Schedule','event'),
		'above_our_gallery' => __('Aboove Our Gallery','event'),
	),
));
$wp_customize->add_control( 'event_theme_options[event_our_testimonial_title]', array(
	'priority' => 1010,
	'label' => __( 'Title', 'event' ),
	'section' => 'event_our_testimonial_features',
	'settings' => 'event_theme_options[event_our_testimonial_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'event_theme_options[event_our_testimonial_bg_image]',array(
	'default'	=> $event_settings['event_our_testimonial_bg_image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'event_theme_options[event_our_testimonial_bg_image]', array(
	'label' => __('Background Image','event'),
	'description' => __('Image will be displayed on background of Testimonial','event'),
	'priority'	=> 1030,
	'section' => 'event_our_testimonial_features',
	)
));
for ( $i=1; $i <= $event_settings['event_total_our_testimonial'] ; $i++ ) {
	$wp_customize->add_setting('event_theme_options[event_our_testimonial_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'event_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'event_theme_options[event_our_testimonial_features_'. $i .']', array(
		'priority' => 103 . $i,
		'label' => __(' Testimonial #', 'event') . ' ' . $i ,
		'section' => 'event_our_testimonial_features',
		'type' => 'dropdown-pages',
	));
}