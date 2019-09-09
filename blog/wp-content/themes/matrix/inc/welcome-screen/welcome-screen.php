<?php
/**
 * Welcome Screen Class
 */
  if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Matrix_Welcome')) {
class Matrix_Welcome {
	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {
		
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'Matrix_lite_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'Matrix_lite_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'Matrix_lite_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'Matrix_lite_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'Matrix_lite_welcome', array( $this, 'Matrix_lite_welcome_getting_started' ), 10 );
		
		add_action( 'Matrix_lite_welcome', array( $this, 'Matrix_lite_welcome_child_themes' ), 30 );
		
		add_action( 'Matrix_lite_welcome', array( $this, 'Matrix_lite_welcome_plugins' ), 40 );
		
		add_action( 'Matrix_lite_welcome', array( $this, 'Matrix_lite_welcome_changelog' ), 50 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_Matrix_lite_dismiss_required_action', array( $this, 'Matrix_lite_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_Matrix_lite_dismiss_required_action', array($this, 'Matrix_lite_dismiss_required_action_callback') );
		}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_register_menu() {
		add_theme_page( 'About matrix', 'About Matrix', 'activate_plugins', 'matrix-welcome', array( $this, 'Matrix_lite_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'Matrix_lite_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Matrix Theme! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'matrix' ), '<a href="' . esc_url( admin_url( 'themes.php?page=matrix-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=matrix-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with matrix', 'matrix' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function Matrix_lite_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_matrix-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'matrix-welcome-screen-css', get_template_directory_uri() . '/inc/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'matrix-welcome-screen-js', get_template_directory_uri() . '/inc/welcome-screen/js/welcome.js', array('jquery') );

			global $Matrix_required_actions;

			$nr_actions_required = 0;

			wp_localize_script( 'matrix-welcome-screen-js', 'matrixLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','matrix' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function Matrix_lite_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'matrix-lite-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'matrix-lite-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $Matrix_required_actions;

		$nr_actions_required = 0;

		wp_localize_script( 'matrix-lite-welcome-screen-customizer-js', 'matrixLiteWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=matrix-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','matrix'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_dismiss_required_action_callback() {

		global $Matrix_required_actions;

		$Matrix_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $Matrix_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($Matrix_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('Matrix_show_required_actions') ):

				$Matrix_show_required_actions = get_option('Matrix_show_required_actions');

				$Matrix_show_required_actions[$Matrix_dismiss_id] = false;

				update_option( 'Matrix_show_required_actions',$Matrix_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$Matrix_show_required_actions_new = array();

				if( !empty($Matrix_required_actions) ):

					foreach( $Matrix_required_actions as $Matrix_required_action ):

						if( $Matrix_required_action['id'] == $Matrix_dismiss_id ):
							$Matrix_show_required_actions_new[$Matrix_required_action['id']] = false;
						else:
							$Matrix_show_required_actions_new[$Matrix_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'Matrix_show_required_actions', $Matrix_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="matrix-lite-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','matrix'); ?></a></li>
			<li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Premium Themes','matrix'); ?></a></li>
			<li role="presentation"><a href="#pro_plugins" aria-controls="pro_plugins" role="tab" data-toggle="tab"><?php esc_html_e( 'Premium Plugins','matrix'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','matrix'); ?></a></li>
		</ul>

		<div class="matrix-lite-tab-content">

			<?php
			/**
			 * @hooked Matrix_lite_welcome_getting_started - 10
			 * @hooked Matrix_lite_welcome_actions_required - 20
			 * @hooked Matrix_lite_welcome_child_themes - 30
			 * @hooked Matrix_lite_welcome_plugins - 40
			 * @hooked Matrix_lite_welcome_changelog - 50
			 * @hooked Matrix_lite_welcome_free_pro - 60
			 */
			do_action( 'Matrix_lite_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Pro Themes
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_child_themes() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/pro-themes.php' );
	}
	
	/**
	 * Pro Plugins
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_plugins() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/pro-plugins.php' );
	}

	/**
	 * Changelog
	 * @since 1.8.2.4
	 */
	public function Matrix_lite_welcome_changelog() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/changelog.php' );
	}

}

$GLOBALS['Matrix_Welcome'] = new Matrix_Welcome();
}
?>