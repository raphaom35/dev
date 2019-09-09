<?php
/**
 * The template for displaying content.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$event_settings = event_get_theme_options(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
			<header class="entry-header">
				<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
				<?php  $entry_format_meta_blog = $event_settings['event_entry_meta_blog'];
				if($entry_format_meta_blog == 'show-meta' ){?>
				<div class="entry-meta">
					<?php $format = get_post_format();
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
		<?php
			$event_blog_post_image = $event_settings['event_blog_post_image'];
					if( has_post_thumbnail() && $event_blog_post_image == 'on') { ?>
						<div class="post-image-content">
							<figure class="post-featured-image">
								<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
								<?php the_post_thumbnail(); ?>
								</a>
							</figure><!-- end.post-featured-image  -->
						</div> <!-- end.post-image-content -->
					<?php } ?>
			
			<div class="entry-content">
				<?php $content_display = $event_settings['event_blog_content_layout'];
					if($content_display == 'excerptblog_display'):
						the_excerpt();
					else:
						the_content();
					endif;
					$disable_entry_format = $event_settings['event_entry_format_blog'];
					$event_tag_text = $event_settings['event_tag_text'];
						if($disable_entry_format !='hide-button' && $content_display == 'excerptblog_display'){ ?>
						<a class="more-link" title="<?php the_title_attribute('echo=0');?>" href="<?php the_permalink();?>">
						<?php
							if($event_tag_text == 'Read More' || $event_tag_text == ''):
								esc_html_e('Read More', 'event');
							else:
								echo esc_attr($event_tag_text);
							endif;?>
						<span></span> </a>
						<?php }  ?>
			</div> <!-- end .entry-content -->
			<?php
				
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
							}
							?>
						</div><!-- end .entry-meta -->
					</footer> <!-- .entry-meta -->
				<?php
				} ?>
			</article>