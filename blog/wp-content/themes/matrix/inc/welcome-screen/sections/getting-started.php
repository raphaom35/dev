<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
$Matrix_lite = wp_get_theme( 'matrix' );
?>

<div id="getting_started" class="matrix-lite-tab-pane active">

	<div class="matrix-tab-pane-center">
		
		<h1 class="matrix-lite-welcome-title"><?php _e('Welcome to Matrix!','matrix'); if( !empty($Matrix_lite['Version']) ): ?> <sup id="matrix-lite-theme-version"><?php echo esc_attr( $Matrix_lite['Version'] ); ?> </sup><?php endif; ?></h1>
	</div>

	<hr />

	<div class="matrix-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'matrix' ); ?></h1>

		<h4><?php esc_html_e( 'Customize Whole theme in a single place.' ,'matrix' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'matrix' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'matrix' ); ?></a></p>
	</div>

	<hr />
	<div class="matrix-tab-pane-center">
		<h1><?php esc_html_e( 'FAQ', 'matrix' ); ?></h1>
	</div>
	<div class="matrix-tab-pane-half matrix-tab-pane-first-half">
		<h4><?php esc_html_e( 'Create a child theme', 'matrix' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'matrix' ); ?></p>
		<p><a href="http://demo.webhuntinfotech.com/blog/2016/01/11/how-to-create-a-child-theme/" class="button"><?php esc_html_e( 'View how to do this', 'matrix' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Gallery in Blog Posts', 'matrix' ); ?></h4>
		<p><?php esc_html_e( 'If you want to use more than one images in your post or want to make gallery images in your post. This can be accomplished by following the documention below.', 'matrix' ); ?></p>
		<p><a href="http://demo.webhuntinfotech.com/blog/2016/01/11/add-gallery-posts-in-matrix-or-kyma-theme/" class="button"><?php esc_html_e( 'View how to do this', 'matrix' ); ?></a></p>
	</div>

	<div class="matrix-tab-pane-half">
	
		<h4><?php esc_html_e( 'Translate matrix Lite', 'matrix' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to translate matrix Lite into your native language or any other language you need for you site.', 'matrix' ); ?></p>
		<p><a href="http://demo.webhuntinfotech.com/blog/2016/01/11/how-to-translate-any-translation-ready-theme/" class="button"><?php esc_html_e( 'View how to do this', 'matrix' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'How To Setup Home Page', 'matrix' ); ?></h4>
		<p><?php esc_html_e( 'See below document. It will help you to setup Home Page' , 'matrix' ); ?></p>
		<p><a href="http://demo.webhuntinfotech.com/blog/2016/02/02/how-to-setup-home-page-in-matrix-or-kyma-lite/" class="button"><?php esc_html_e( 'View how to do this', 'matrix' ); ?></a></p>
		
	</div>

	<div class="matrix-lite-clear"></div>

</div>
