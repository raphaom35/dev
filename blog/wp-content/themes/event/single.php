<?php
/**
 * The template for displaying all single posts.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
get_header();
	$event_settings = event_get_theme_options();
	global $event_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'event_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //Settings from customizer
		if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="primary">
<?php }
	}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="primary">
	<?php }
	}?>
	<div id="main" class="clearfix">
	<?php global $event_settings;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<header class="entry-header">
					<?php 
					$entry_format_meta_blog = $event_settings['event_entry_meta_blog'];
					if($entry_format_meta_blog == 'show-meta' ){?>
					<div class="entry-meta">
						<?php	
						$format = get_post_format();
						if ( current_theme_supports( 'post-formats', $format ) ) {
							printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
								sprintf( ''),
								esc_url( get_post_format_link( $format ) ),
								get_post_format_string( $format )
							);
						} ?>
						<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author(); ?>">
						<?php the_author(); ?> </a></span> <span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>">
						<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
						<?php if ( comments_open() ) { ?>
						<span class="comments"><i class="fa fa-comments"></i>
						<?php comments_popup_link( __( 'No Comments', 'event' ), __( '1 Comment', 'event' ), __( '% Comments', 'event' ), '', __( 'Comments Off', 'event' ) ); ?> </span>
						<?php } ?>
					</div> <!-- end .entry-meta -->
					<?php } ?>
				</header> <!-- end .entry-header -->
				<?php $featured_image_display = $event_settings['event_single_post_image'];
					if($featured_image_display == 'on'):
						if( has_post_thumbnail() ) { ?>
							<div class="post-image-content">
								<figure class="post-featured-image">
									<?php the_post_thumbnail(); ?>
								</figure><!-- end.post-featured-image  -->
							</div> <!-- end.post-image-content -->
						<?php }
					endif;  ?>
		<div class="entry-content clearfix">
			<?php the_content();
			wp_link_pages( array( 
				'before'			=> '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'event' ),
				'after'			=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>',
				'pagelink'		=> '%',
				'echo'			=> 1
			) ); ?>
		</div> <!-- .entry-content -->
		<?php $disable_entry_format = $event_settings['event_entry_format_blog'];
			if($disable_entry_format =='show' || $disable_entry_format =='show-button' || $disable_entry_format =='hide-button'){ ?>
				<footer class="entry-footer">
					<div class="entry-meta">
						<?php if($disable_entry_format !='show-button'){ ?>
						<span class="cat-links">
						<?php the_category(', '); ?>
						</span> <!-- end .cat-links -->
						<?php $tag_list = get_the_tag_list( '', __( ', ', 'event' ) );
							if(!empty($tag_list)){ ?>
							<span class="tag-links">
							<?php   echo get_the_tag_list( '', __( ', ', 'event' ) ); ?>
							</span> <!-- end .tag-links -->
							<?php } 
						} ?>
					</div><!-- end .entry-meta -->
				</footer> <!-- .entry-meta -->
			<?php }
				if( is_attachment() ) { ?>
				<ul class="default-wp-page clearfix">
					<li class="previous"> <?php previous_image_link( false, __( '&larr; Previous', 'event' ) ); ?> </li>
					<li class="next">  <?php next_image_link( false, __( 'Next &rarr;', 'event' ) ); ?> </li>
				</ul>
				<?php } else { ?>
				<ul class="default-wp-page clearfix">
					<li class="previous"> <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'event' ) . '</span> %title' ); ?> </li>
					<li class="next"> <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'event' ) . '</span>' ); ?> </li>
				</ul>
					<?php }
				comments_template(); ?>
			</article>
		</section> <!-- .post -->
	<?php  }
		}
	else { ?>
	<h1 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'event' ); ?> </h1>
	<?php } ?>
	</div> <!-- #main -->
	<?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($event_settings['event_sidebar_layout_options'] != 'nosidebar') && ($event_settings['event_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}else{ // for page/post
	if(($layout != 'no-sidebar') && ($layout != 'full-width')){
		echo '</div><!-- #primary -->';
	}
}
get_sidebar();
get_footer();