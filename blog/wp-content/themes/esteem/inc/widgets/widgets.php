<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage esteem
 * @since esteem 1.0
 */

add_action( 'widgets_init', 'esteem_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function esteem_widgets_init() {

	// Registering main right sidebar
	register_sidebar( array(
		'name' 				=> __( 'Right Sidebar', 'esteem' ),
		'id' 					=> 'esteem_right_sidebar',
		'description'   	=> __( 'Shows widgets at Right side.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name' 				=> __( 'Left Sidebar', 'esteem' ),
		'id' 					=> 'esteem_left_sidebar',
		'description'   	=> __( 'Shows widgets at Left side.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );


	// Registering Business Page section sidebar
	register_sidebar( array(
		'name' 				=> __( 'Business Page Sidebar', 'esteem' ),
		'id' 					=> 'esteem_business_page_sidebar',
		'description'   	=> __( 'Shows widgets on Business Page Template.', 'esteem' ),
		'before_widget' 	=> '<section id="%1$s" class="widget widget-home %2$s clearfix">',
		'after_widget'  	=> '</section>',
		'before_title'  	=> '<h6>',
		'after_title'   	=> '</h6>'
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar One', 'esteem' ),
		'id' 					=> 'esteem_footer_sidebar_one',
		'description'   	=> __( 'Shows widgets at footer sidebar one.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Two', 'esteem' ),
		'id' 					=> 'esteem_footer_sidebar_two',
		'description'   	=> __( 'Shows widgets at footer sidebar two.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar three
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Three', 'esteem' ),
		'id' 					=> 'esteem_footer_sidebar_three',
		'description'   	=> __( 'Shows widgets at footer sidebar three.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name' 				=> __( 'Contact Page Sidebar', 'esteem' ),
		'id' 					=> 'esteem_contact_page_sidebar',
		'description'   	=> __( 'Shows widgets on Contact Page Template.', 'esteem' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering custom widgets
	register_widget( "esteem_service_widget" );
	register_widget( "esteem_recent_work_widget" );
	register_widget( "esteem_call_to_action_widget" );
	register_widget( "esteem_testimonial_widget" );
}

/**
 * Widget for business layout that shows selected page content,title and corresponding icon.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class esteem_service_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget-services', 'description' => __( 'Display Services( Business Layout )', 'esteem' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Services', 'esteem' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
		$defaults['checkbox'] = '0';
 		$instance = wp_parse_args( (array) $instance, $defaults );
 		for ( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$checkbox = $instance[ 'checkbox' ] ? 'checked="checked"' : '';
	?>
		<p>
			<input class="checkbox" <?php echo $checkbox; ?> id="<?php echo $this->get_field_id( 'checkbox' ); ?>" name="<?php echo $this->get_field_name( 'checkbox' ); ?>" type="checkbox" />
			<label for="<?php echo $this->get_field_id('checkbox'); ?>"><?php _e( 'Check to display the Featured Image', 'esteem' ); ?></label>
			<?php _e('<strong>Note:</strong> Featured Image will overwrite the fontawesome icon.', 'esteem'); ?>
		</p>
		<?php for( $i=0; $i<3; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'esteem' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for( $i=0; $i<3; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}
		$instance[ 'checkbox' ] = isset( $new_instance[ 'checkbox' ] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$checkbox = !empty( $instance[ 'checkbox' ] ) ? 'true' : 'false';
 		$page_array = array();
 		for( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) );
		echo $before_widget; ?>
			<div class="services-block clearfix">
				<?php
				$j = 1;
	 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
					$page_title = get_the_title();
					if( $j == 3 ) {
						$service_class = "tg-one-third tg-one-third-last";
					}
					else {
						$service_class = "tg-one-third";
					}
					?>
					<div class="<?php echo $service_class; ?>">
					<?php if ( $checkbox == 'true' ) : ?>
						<div class="services-featured-image">
							<?php
							if ( has_post_thumbnail() ) {
                        echo'<div class="service-image">'.get_the_post_thumbnail( $post->ID, 'service-featured' ).'</div>';
							}
							?>
							<h3 class="service-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo $page_title; ?></a></h3>
							<?php the_excerpt(); ?>
							<a class="read-more" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'esteem' ); ?></a>
						</div>
					<?php else : ?>
						<?php $esteem_icon = get_post_meta( $post->ID, '_esteem_font_icon', true );
						if( !empty( $esteem_icon ) ) { ?>
							<div class="service-border">
								<div class="service-image-wrap">
									<?php
									//$values = get_post_custom( $post->ID );
									$esteem_icon = isset( $esteem_icon ) ? esc_attr( $esteem_icon ) : '';
									?>
									<i class="<?php echo esc_html( $esteem_icon ); ?>"></i>
								</div><!-- service-image-wrap" -->
							</div><!-- service-border -->
						<?php } ?>
						<h3 class="service-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo $page_title; ?></a></h3>
						<?php the_excerpt(); ?>
						<a class="read-more" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read more','esteem' ); ?></a>
						<?php endif; ?>
					</div><!-- .tg-one-third -->
					<?php $j++; ?>
				<?php endwhile;
		 		// Reset Post Data
	 			wp_reset_query();
	 			?>
			</div>
		<?php
		echo $after_widget;
 	}
 }

 /**
 * Widget for business layout that shows Featured page title and featured image.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
 class esteem_recent_work_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget-recent-work', 'description' => __( 'Use this widget to show recent work, portfolio or any pages as your wish ( Business Layout )', 'esteem' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Featured Widget', 'esteem' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<4; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$att_defaults = $defaults;
 		$att_defaults['title'] = '';
 		$instance = wp_parse_args( (array) $instance, $att_defaults );
 		for ( $i=0; $i<4; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$title = esc_attr( $instance[ 'title' ] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'esteem' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php
		for( $i=0; $i<4; $i++) {
			?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'esteem' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		for( $i=0; $i<4; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
 		$page_array = array();
 		for( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) );
		echo $before_widget;
		if ( !empty( $title ) ) { ?>
			<div class="fancy-tab">
				<?php echo $before_title . esc_html( $title ) . $after_title; ?>
			</div>
		<?php } ?>
			<div class="recent-work clearfix">
				<?php
	 			$i=1;
	 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
	 				if ( $i % 4 == 0 ) { $class = 'tg-one-fourth tg-one-fourth-last'.' tg-column-'.$i; }
	 				else { $class = 'tg-one-fourth'.' tg-column-'.$i; }
					$page_title = get_the_title();
					?>
					<div class="<?php echo $class; ?>">
						<?php
						if ( has_post_thumbnail( ) ) {
							echo '<a title="'.get_the_title().'" href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID,'recent-thumb').'</a>';?>
							<div class="recent-work-title">
								<h6><?php the_title(); ?></h6>
							</div>
						<?php
						}
						?>
						<!-- <h3 class="custom-gallery-title"><a href="<?php the_permalink(); ?>" title=""><?php echo $page_title; ?></a></h3> -->
					</div>
				<?php
					$i++;
				endwhile;
		 		// Reset Post Data
	 			wp_reset_query();
	 			?>
	 		</div><!-- .recent-work -->
		<?php echo $after_widget;
 	}
 }

/**
 * Widget for business page template that shows Call to Action section.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class esteem_call_to_action_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget-call-to-action', 'description' => __( 'Use this widget to show the call to action section', 'esteem' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'esteem' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		$esteem_defaults[ 'text_main' ] = '';
 		$esteem_defaults[ 'text_additional' ] = '';
 		$esteem_defaults[ 'button_text' ] = '';
 		$esteem_defaults[ 'button_url' ] = '';
 		$esteem_defaults[ 'new_tab' ] = '0';
 		$instance = wp_parse_args( (array) $instance, $esteem_defaults );
		$text_main = esc_textarea( $instance[ 'text_main' ] );
		$text_additional = esc_textarea( $instance[ 'text_additional' ] );
		$button_text = esc_attr( $instance[ 'button_text' ] );
		$button_url = esc_url( $instance[ 'button_url' ] );
		$new_tab = $instance['new_tab'] ? 'checked="checked"' : '';
		?>


		<?php _e( 'Call to Action Main Text','esteem' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
		<?php _e( 'Call to Action Additional Text','esteem' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_additional'); ?>" name="<?php echo $this->get_field_name('text_additional'); ?>"><?php echo $text_additional; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'esteem' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Redirect Link:', 'esteem' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $new_tab; ?> id="<?php echo $this->get_field_id('new_tab'); ?>" name="<?php echo $this->get_field_name('new_tab'); ?>" /> <label for="<?php echo $this->get_field_id('new_tab'); ?>"><?php _e( 'Open in new tab', 'esteem' ); ?></label>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( current_user_can('unfiltered_html') )
			$instance['text_main'] =  $new_instance['text_main'];
		else
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) ); // wp_filter_post_kses() expects slashed

		if ( current_user_can('unfiltered_html') )
			$instance['text_additional'] =  $new_instance['text_additional'];
		else
			$instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_additional']) ) ); // wp_filter_post_kses() expects slashed

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
		$instance[ 'new_tab' ] = isset( $new_instance[ 'new_tab' ] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$new_tab = !empty( $instance[ 'new_tab' ] ) ? 'true' : 'false';
 		$text_main = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
 		$text_additional = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
 		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
 		$button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

		echo $before_widget;
		?>
				<div class="call-to-action clearfix">
					<div class="call-to-action-text">
						<div class="call-to-action-text-inner-wrap">
						<?php
						if( !empty( $text_main ) ) {
						?>
							<h4><?php echo esc_html( $text_main ); ?></h4>
						<?php
						}
						if( !empty( $text_additional ) ) {
						?>
							<p><?php echo esc_html( $text_additional ); ?></p>
						<?php
						}
						?>
						</div>
					</div><!-- .call-to-action-text -->
					<?php
					if( !empty( $button_text ) ) {
					?>
						<div class="call-to-action-button">
							<div class="call-to-action-button-inner-wrap">
								<a class="call-to-action-link" <?php if( $new_tab == 'true' ) { echo 'target="_blank"'; } ?> href="<?php echo esc_url( $button_url ); ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
							</div>
						</div><!-- .call-to-action-button -->
					<?php
					}
					?>
				</div><!-- .call-to-action clearfix -->
		<?php
		echo $after_widget;
 	}
 }

/**
 * Testimonial widget
 */
class esteem_testimonial_widget extends WP_Widget {

	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_testimonial', 'description' => __( 'Display Testimonial', 'esteem' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Testimonial', 'esteem' ), $widget_ops, $control_ops);
 	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text1 = apply_filters( 'widget_text1', empty( $instance['text1'] ) ? '' : $instance['text1'], $instance );
		$name1 = apply_filters( 'widget_name1', empty( $instance['name1'] ) ? '' : $instance['name1'], $instance, $this->id_base );
		$image1 = apply_filters( 'widget_image1', empty( $instance['image1'] ) ? '' : $instance['image1'], $instance, $this->id_base );
		$byline1 = apply_filters( 'widget_byline1', empty( $instance['byline1'] ) ? '' : $instance['byline1'], $instance, $this->id_base );

		$company1 = apply_filters( 'widget_company1', empty( $instance['company1'] ) ? '' : $instance['company1'], $instance, $this->id_base );
		$company_link = apply_filters( 'widget_company_link', empty( $instance['company_link'] ) ? '' : $instance['company_link'], $instance, $this->id_base );


		$text2 = apply_filters( 'widget_text2', empty( $instance['text2'] ) ? '' : $instance['text2'], $instance );
		$image2 = apply_filters( 'widget_image2', empty( $instance['image2'] ) ? '' : $instance['image2'], $instance, $this->id_base );
		$name2 = apply_filters( 'widget_name2', empty( $instance['name2'] ) ? '' : $instance['name2'], $instance, $this->id_base );
		$byline2 = apply_filters( 'widget_byline2', empty( $instance['byline2'] ) ? '' : $instance['byline2'], $instance, $this->id_base );
		$company2 = apply_filters( 'widget_company2', empty( $instance['company2'] ) ? '' : $instance['company2'], $instance, $this->id_base );
		$company2_link = apply_filters( 'widget_company2_link', empty( $instance['company2_link'] ) ? '' : $instance['company2_link'], $instance, $this->id_base );


		echo $before_widget; ?>
		<?php if ( !empty( $title ) ) { ?>
			<div class="fancy-tab">
				<?php echo $before_title. esc_html( $title ) . $after_title; ?>
			</div>
		<?php } ?>
      <div class="testimonial">
         <?php if ( !empty( $name1 ) ) : ?>
   			<div class="tg-one-half">
   				<div class="testimonial-wrap">
   					<div class="testimonial-content clearfix">
   						<div class="author-image">
   							<img title="author" alt="author" src="<?php echo esc_url( $image1 ); ?>">
   						</div><!-- .testimonial-content -->
   						<div class="testimonial-text">
   							<p><?php echo esc_textarea( $text1 ); ?></p>
   						</div><!-- .testimonial-text -->
   					</div><!-- .testimonial-content -->
   					<div class="testimonial-byline">
   						<?php echo esc_html( $name1 ); ?>
   						<span class="author-desc"><?php echo esc_html( $byline1 ).' <a href="'.esc_url( $company_link).'" title="'.esc_html( $company1 ).'">'.esc_html( $company1 ).'</a>'?></span>
   					</div><!-- .byline -->
   				</div><!-- .testimonial-wrap -->
   			</div><!-- .tg-one-half -->
         <?php endif; ?>

         <?php if ( !empty( $name2 ) ) : ?>
   			<div class="tg-one-half tg-one-half-last">
   				<div class="testimonial-wrap">
   					<div class="testimonial-content clearfix">
   						<div class="author-image">
   							<img title="author" alt="author" src="<?php echo esc_url( $image2 ); ?>">
   						</div><!-- .testimonial-content -->
   						<div class="testimonial-text">
   							<p><?php echo esc_textarea( $text2 ); ?></p>
   						</div><!-- .testimonial-text -->
   					</div><!-- .testimonial-content -->
   					<div class="testimonial-byline">
   						<?php echo esc_html( $name2 ); ?>
   						<span class="author-desc"><?php echo esc_html( $byline2 ).' <a href = "'.esc_url( $company2_link).'" title="'.esc_html( $company2 ).'">'.esc_html( $company2 ).'</a>'?></span>
   					</div><!-- .byline -->
   				</div><!-- .testimonial-wrap -->
   			</div><!-- .tg-one-half -->
         <?php endif; ?>
      </div><!-- .testimonial -->

		<?php echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name1'] = strip_tags($new_instance['name1']);
		$instance['image1'] = esc_url_raw($new_instance['image1']);
		$instance['byline1'] = strip_tags($new_instance['byline1']);
		$instance['company1'] = strip_tags($new_instance['company1']);
		$instance['company_link'] = esc_url_raw($new_instance['company_link']);
		if ( current_user_can('unfiltered_html') )
			$instance['text1'] =  $new_instance['text1'];
		else
			$instance['text1'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text1']) ) ); // wp_filter_post_kses() expects slashed
		$instance['name2'] = strip_tags($new_instance['name2']);
		$instance['image2'] = esc_url_raw($new_instance['image2']);
		$instance['byline2'] = strip_tags($new_instance['byline2']);
		$instance['company2'] = strip_tags($new_instance['company2']);
		$instance['company2_link'] = esc_url_raw($new_instance['company2_link']);
		if ( current_user_can('unfiltered_html') )
			$instance['text2'] =  $new_instance['text2'];
		else
			$instance['text2'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text2']) ) ); // wp_filter_post_kses() expects slashed
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','name1' => '','image1' => '','byline1'=>'','text1' => '','company1' => '','company_link' => '','name2' =>'', 'image2' => '', 'text2' => '', 'byline2' => '','company2' => '','company2_link' => '' ) );
		$title = strip_tags($instance['title']);
		$name1 = strip_tags($instance['name1']);
		$image1 = esc_url( $instance['image1']);
		$byline1 = strip_tags($instance['byline1']);
		$text1 = esc_textarea($instance['text1']);
		$company1 = strip_tags($instance['company1']);
		$company_link = esc_url( $instance['company_link']);
		$name2 = strip_tags($instance['name2']);
		$image2 = esc_url( $instance['image2']);
		$byline2 = strip_tags($instance['byline2']);
		$text2 = esc_textarea($instance['text2']);
		$company2 = strip_tags($instance['company2']);
		$company2_link = esc_url( $instance['company2_link']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('name1'); ?>"><?php _e( 'Name:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name1'); ?>" name="<?php echo $this->get_field_name('name1'); ?>" type="text" value="<?php echo esc_attr($name1); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('image1'); ?>"><?php _e( 'Image link:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image1'); ?>" name="<?php echo $this->get_field_name('image1'); ?>" type="text" value="<?php echo esc_attr($image1); ?>" /></p>

		<?php _e( 'Testimonial Description','esteem'); ?>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text1'); ?>" name="<?php echo $this->get_field_name('text1'); ?>"><?php echo $text1; ?></textarea>

		<p><label for="<?php echo $this->get_field_id('byline1'); ?>"><?php _e( 'Byline:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('byline1'); ?>" name="<?php echo $this->get_field_name('byline1'); ?>" type="text" value="<?php echo esc_attr($byline1); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('company1'); ?>"><?php _e( 'Company:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('company1'); ?>" name="<?php echo $this->get_field_name('company1'); ?>" type="text" value="<?php echo esc_attr($company1); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('company_link'); ?>"><?php _e( 'Company link:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('company_link'); ?>" name="<?php echo $this->get_field_name('company_link'); ?>" type="text" value="<?php echo esc_attr($company_link); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('name2'); ?>"><?php _e( 'Name:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name2'); ?>" name="<?php echo $this->get_field_name('name2'); ?>" type="text" value="<?php echo esc_attr($name2); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e( 'Image link:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" type="text" value="<?php echo esc_attr($image2); ?>" /></p>

		<?php _e( 'Testimonial Description','esteem'); ?>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text2'); ?>" name="<?php echo $this->get_field_name('text2'); ?>"><?php echo $text2; ?></textarea>

		<p><label for="<?php echo $this->get_field_id('byline2'); ?>"><?php _e( 'Byline:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('byline2'); ?>" name="<?php echo $this->get_field_name('byline2'); ?>" type="text" value="<?php echo esc_attr($byline2); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('company2'); ?>"><?php _e( 'Company:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('company2'); ?>" name="<?php echo $this->get_field_name('company2'); ?>" type="text" value="<?php echo esc_attr($company2); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('company2_link'); ?>"><?php _e( 'Company link:', 'esteem' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('company2_link'); ?>" name="<?php echo $this->get_field_name('company2_link'); ?>" type="text" value="<?php echo esc_attr($company2_link); ?>" /></p>


<?php
	}
}
?>