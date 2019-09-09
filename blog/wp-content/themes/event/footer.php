<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$event_settings = event_get_theme_options();
if(is_page_template('upcoming-event-template.php') || is_page_template('program-schedule-template.php') ){
 	// Code is poetry
}elseif(!is_page_template('page-templates/event-corporate.php') ){ ?>
	</div> <!-- end .container -->
<?php } ?>
</div> <!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer clearfix">
<?php
$footer_column = $event_settings['event_footer_column_section'];
	if( is_active_sidebar( 'event_footer_1' ) || is_active_sidebar( 'event_footer_2' ) || is_active_sidebar( 'event_footer_3' ) || is_active_sidebar( 'event_footer_4' )) { ?>
	<div class="widget-wrap">
		<div class="container">
			<div class="widget-area clearfix">
			<?php
				if($footer_column == '1' || $footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'event_footer_1' ) ) :
						dynamic_sidebar( 'event_footer_1' );
					endif;
				echo '</div><!-- end .column'.$footer_column. '  -->';
				}
				if($footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'event_footer_2' ) ) :
						dynamic_sidebar( 'event_footer_2' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'event_footer_3' ) ) :
						dynamic_sidebar( 'event_footer_3' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'event_footer_4' ) ) :
						dynamic_sidebar( 'event_footer_4' );
					endif;
				echo '</div><!--end .column'.$footer_column.  '-->';
				}
				?>
			</div> <!-- end .widget-area -->
		</div> <!-- end .container -->
	</div> <!-- end .widget-wrap -->
	<?php }
		if(class_exists('Event_Plus_Features')){
			if(is_page_template('page-templates/event-corporate.php') ){
				do_action('event_client_box');
			}
		} ?>
<div class="site-info" <?php if($event_settings['event-img-upload-footer-image'] !=''){?>style="background-image:url('<?php echo esc_url($event_settings['event-img-upload-footer-image']); ?>');" <?php } ?>>
	<div class="container">
	<?php
		if($event_settings['event_buttom_social_icons'] == 0):
			do_action('event_social_links');
		endif;
		if(class_exists('Event_Plus_Features')){
			do_action('event_footer_menu');
		}
		do_action('event_sitegenerator_footer'); ?>
			<div style="clear:both;"></div>
		</div> <!-- end .container -->
	</div> <!-- end .site-info -->
	<?php
		$disable_scroll = $event_settings['event_scroll'];
		if($disable_scroll == 0):?>
	<a class="go-to-top">
		<span class="icon-bg"></span>
		<span class="back-to-top-text"><?php esc_html_e('Top','event');?></span>
		<i class="fa fa-angle-up back-to-top-icon"></i>
	</a>
	<?php endif; ?>
</footer> <!-- end #colophon -->
</div><!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>