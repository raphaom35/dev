<?php get_header();
get_template_part('header', 'banner'); ?>
<div id="content">
	<div class="container">
		<div class="row blog-page">
			<?php $page_layout = get_post_meta(get_the_ID(), 'page_layout', true);
			if ($page_layout == "fullwidth_left") {
				get_sidebar();
				$page_width = 'col-md-9';
				$imgsize = 'matrix_blog_image';
			} elseif ($page_layout == "fullwidth") {
				$page_width = 'col-md-12';
				$imgsize = 'matrix_blog_image_full';
			} elseif ($page_layout == "fullwidth_right") {
				$page_width = 'col-md-9';
				$imgsize = 'matrix_blog_image';
			} else {
				$page_layout = "fullwidth_right";
				$page_width = 'col-md-9';
				$imgsize = 'matrix_blog_image';
			} ?>
			<!-- Start Blog Posts -->
			<div class="<?php echo esc_attr($page_width); ?> page-content">
				<?php while ( have_posts() ) : the_post(); ?>
				<!-- Start Post -->
				<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post image-post quote-post'); ?>>
					<!-- Post Thumb -->
					<?php if (has_post_thumbnail()):
					$img_class = array('class' => 'img-responsive');
					$post_image_id = get_post_thumbnail_id();
					$post_image_url = wp_get_attachment_url($post_image_id);
					?>
					<div class="post-head">
						<a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $post_image_url; ?>">
							<div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
							<?php the_post_thumbnail($imgsize, $img_class); ?>
						</a>
					</div>
					<?php endif; ?>
					<!-- Post Content -->
						<!-- Classic Heading -->
						<h4 class="classic-title"><span><?php the_title(); ?></span></h4>
						<?php the_content(); ?>
				</div>
				<?php comments_template('', true);
				 endwhile; ?>
			</div>
			<!-- End Post -->
			<!-- Divider -->
			<!--Sidebar-->
			<?php if ($page_layout == "fullwidth_right") {
				get_sidebar();
			} ?>
			<!--End sidebar-->
		</div>
		<!-- End Blog Posts -->
	</div>
</div>
<?php get_footer(); ?>