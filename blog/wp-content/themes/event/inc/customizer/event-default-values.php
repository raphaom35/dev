<?php
if(!function_exists('event_get_option_defaults_values')):
	/******************** EVENT DEFAULT OPTION VALUES ******************************************/
	function event_get_option_defaults_values() {
		global $event_default_values;
		$event_default_values = array(
			'event_responsive'	=> 'on',
			'event_design_layout' => 'wide-layout',
			'event_sidebar_layout_options' => 'right',
			'event_blog_layout' => 'two_column_image_display',
			'event_search_custom_header' => 0,
			'event-img-upload-footer-image' => '',
			'event-footer-title'	=> '',
			'event-footer-link'	=> '#',
			'event_header_display'=> 'header_text',
			'event_header_image_display'=>'top',
			'event_categories'	=> array(),
			'event_date_picker'	=> '',
			'event_custom_css'	=> '',
			'event_scroll'	=> 0,
			'event_slider_button' => 0,
			'event_secondary_text' => '',
			'event_secondary_url' => '',
			'event_tag_text' => 'Read More',
			'event_excerpt_length'	=> '20',
			'event_search_text' => 'Search',
			'event_single_post_image' => 'off',
			'event_hide_event_archive'=> 0,
			'event_reset_all' => 0,
			'event_stick_menu'	=>0,
			'event_blog_post_image' => 'on',
			'event_entry_format_blog' => 'excerptblog_display',
			'event_search_text' => 'Search &hellip;',
			'event_blog_content_layout'	=> 'fullcontent_display',
			/* Slider Settings */
			'event_slider_type'	=> 'default_slider',
			'event_slider_link' =>0,
			'event_enable_slider' => 'frontpage',
			/* Layer Slider */
			'event_animation_effect' => 'slide',
			'event_slideshowSpeed' => '5',
			'event_animationSpeed' => '7',
			'event_direction' => 'horizontal',
			'event_slider_content_bg_color' => 'on',
			'event_display_page_featured_image'=>0,
			/* Frontpage Event Booking */
			'event_display_book_appoinment'	=> 0,
			'event_title'	=> '',
			'event_date_time'	=> '',
			'event_venue'	=> '',
			'event_book_appointment'	=> '',
			'event_book_appointment_url'	=> '',
			/* Front page feature */
			'event_disable_features'	=> 0,
			'event_disable_features_readmore'	=> 0,
			'event_total_features'	=> '3',
			'event_features_title'	=> '',
			'event_features_description'	=> '',
			'event_front_page_section'=>'default',
			'event_upcoming_event_section'=>'default',
			'event_our_speaker_section'=>'default',
			'event_program_schedule_section'=>'default',
			'event_our_gallery_section'=>'default',
			'event_our_testimonial_section'=>'default',
			/* Upcoming Event */
			'event_disable_upcoming'	=> 0,
			'event_total_upcoming'	=> '4',
			'event_upcoming_title'	=> '',
			'event_upcoming_bg_image' =>'',
			'event_upcoming_category_list' =>array(),
			/* Our Speaker */
			'event_disable_our_speaker'	=> 0,
			'event_total_our_speaker'	=> '4',
			'event_our_speaker_title'	=> '',
			'event_our_speaker_description'	=> '',
			/* Program Schedule */
			'event_disable_program_schedule'	=> 0,
			'event_total_program_schedule'	=> '4',
			'event_program_schedule_title'	=> '',
			'event_program_schedule_description'	=> '',
			'event_program_schedule_bg_image' =>'',
			'event_program_schedule_category_list' =>array(),
			/* Our Gallery */
			'event_disable_our_gallery'	=> 0,
			'event_total_our_gallery'	=> '6',
			'event_our_gallery_title'	=> '',
			'event_our_gallery_description'	=> '',
			/* Our Testimonial */
			'event_disable_our_testimonial'	=> 0,
			'event_total_our_testimonial'	=> '3',
			'event_our_testimonial_title'	=> '',
			'event_our_testimonial_bg_image'	=> '',


			'event_entry_format_blog' => 'show',
			'event_entry_meta_blog' => 'show-meta',
			'event_footer_column_section'	=>'4',
			/*Social Icons */
			'event_top_social_icons' =>0,
			'event_buttom_social_icons'	=>0,
			);
		return apply_filters( 'event_get_option_defaults_values', $event_default_values );
	}
endif;