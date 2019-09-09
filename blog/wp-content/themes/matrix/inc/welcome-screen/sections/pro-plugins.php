<?php
/**
 * Child themes template
 */
?>
<div id="pro_plugins" class="matrix-lite-tab-pane">

	<?php $current_theme = wp_get_theme(); ?>

	<div class="matrix-tab-pane-center">
		<h1><?php esc_html_e( 'Our Popular Plugins', 'matrix' ); ?></h1>
	</div>

	<div class="matrix-tab-pane-half matrix-tab-pane-first-half">
		<!-- PVGMP -->
		<div class="matrix-lite-child-theme-container">
			<div class="matrix-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/welcome-screen/img/PVGMP.jpg'; ?>" alt="<?php esc_html_e( 'Photo Video Gallery Master PRO', 'matrix' ); ?>" />
				<div class="matrix-lite-child-theme-description">
					<h2><?php esc_html_e( 'Photo Video Gallery Master PRO', 'matrix' ); ?></h2>
					<p><?php esc_html_e( 'Photo Video Gallery Master PRO (PVGMP) is a plugin to show your works, photos, Portfolios, videos, Galleries beautifully.', 'matrix' ); ?></p>
				</div>
			</div>
			<div class="matrix-lite-child-theme-details">
					<div class="theme-details">
						<span class="theme-name"><?php esc_html_e('PVGM PRO', 'matrix'); ?></span>
						<a href="http://webhuntinfotech.com/webhunt_plugin/photo-video-gallery-master-pro/" class="button button-primary install right"><?php printf( __( 'Get %s now', 'matrix' ), '<span class="screen-reader-text">Photo Video Gallery Master PRO</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="http://demo.webhuntinfotech.com/demo/#pvgmp"><?php esc_html_e( 'Live Preview','matrix'); ?></a>
						<div class="matrix-lite-clear"></div>
					</div>
			</div>
		</div>
		<hr/>
		<!-- END PVGMP -->

	</div>

	<div class="matrix-tab-pane-half">
		
		<!-- Ultimate Gallery Master Pro -->
		<div class="matrix-lite-child-theme-container">
			<div class="matrix-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/welcome-screen/img/UGMP.jpg'; ?>" alt="<?php esc_html_e( 'Ultimate Gallery Master Pro', 'matrix' ); ?>" />
				<div class="matrix-lite-child-theme-description">
					<h2><?php esc_html_e( 'Ultimate Gallery Master PRO', 'matrix' ); ?></h2>
					<p><?php esc_html_e( 'Ultimate Gallery Master Pro is indeed the ultimate responsive multimedia Gallery builder packed with an insane set of features that allows to create unlimited, filterable / sortable multimedia portfolios, product showcase, image galleries with unlimited possibilities. It includes four grid types with vertical or horizontal layout variation (dynamic, classic,masonry and infinite) that allow to display various multimedia content (like image, self hosted video, youtube, vimeo, audio, flash, iframe, google maps) in a highly customizable way. It runs on all major browsers with support for older browsers like IE8 and mobile devices like iPhone, iPad, IOS, Android or Windows mobile.', 'matrix' ); ?></p>
				</div>
			</div>
			<div class="matrix-lite-child-theme-details">
				<div class="theme-details">
					<span class="theme-name"><?php esc_html_e('UGM PRO','matrix'); ?></span>
					<a href="http://webhuntinfotech.com/amember/signup/ugmp" target="_blank" class="button button-primary install right"><?php printf( __( 'Get %s now', 'matrix' ), '<span class="screen-reader-text">Ultimate Gallery Master Pro</span>' ); ?></a>
					<a class="button button-secondary preview right" target="_blank" href="http://demo.webhuntinfotech.com/ultimate-gallery-master-pro/"><?php esc_html_e( 'Live Preview','matrix'); ?></a>
					<div class="matrix-lite-clear"></div>
				</div>
			</div>
		</div>
		<hr />
		<!-- Ultimate Gallery Master Pro -->
		
	</div>

</div>