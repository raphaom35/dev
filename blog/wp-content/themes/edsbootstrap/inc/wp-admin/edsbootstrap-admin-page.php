<?php
/**
 * edsbootstrap Admin Class.
 *
 * @author  eDataStyle
 * @package edsbootstrap
 * @since   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'EdsBootstrap_Admin' ) ) :

/**
 * edsbootstrap_Admin Class.
 */
class EdsBootstrap_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'edsbootstrap' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'edsbootstrap' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'edsbootstrap-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'edsbootstrap-welcome', get_template_directory_uri() . '/inc/wp-admin/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'edsbootstrap-message', get_template_directory_uri() . '/inc/wp-admin/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'edsbootstrap_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'edsbootstrap_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['edsbootstrap-hide-notice'] ) && isset( $_GET['_edsbootstrap_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_edsbootstrap_notice_nonce']), 'edsbootstrap_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'edsbootstrap' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'edsbootstrap' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['edsbootstrap-hide-notice'] ) );
			update_option( 'edsbootstrap_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'edsbootstrap-hide-notice', 'welcome' ) ), 'edsbootstrap_hide_notices_nonce', '_edsbootstrap_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'edsbootstrap' ); ?></a>
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing edsbootstrap! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'edsbootstrap' ), '<a href="' . esc_url( admin_url( 'themes.php?page=edsbootstrap-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=edsbootstrap-welcome' ) ); ?>"><?php esc_html_e( 'Get started with edsbootstrap', 'edsbootstrap' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="cresta-theme-info">
				<h1>
					<?php esc_html_e('About', 'edsbootstrap'); ?>
					<?php echo esc_html( $theme->get( 'Name' )) ." ". esc_html( $theme->get( 'Version' ) ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo esc_html( $theme->display( 'Description' ) ); ?>
				<p class="cresta-actions">
					<a href="<?php echo esc_url( 'https://edatastyle.com/product/eds-bootstrap-wp' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'edsbootstrap' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'edsbootstrap_pro_theme_url', 'https://edatastyle.com/demo/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'edsbootstrap' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'edsbootstrap_pro_theme_url', 'https://edatastyle.com/product/eds-bootstrap-wp' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version Demo', 'edsbootstrap' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'edsbootstrap_pro_theme_url', 'http://wordpress.org/support/view/theme-reviews/edsbootstrap?filter=5#postform' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'edsbootstrap' ); ?></a>
				</p>
				</div>

				<div class="cresta-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( sanitize_key( $_GET['tab'] ) ) && sanitize_key( $_GET['page'] ) == 'edsbootstrap-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'edsbootstrap-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo esc_html ( $theme->display( 'Name' )); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'edsbootstrap-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs PRO', 'edsbootstrap' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'edsbootstrap-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'edsbootstrap' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$tabs_data = sanitize_title( wp_unslash( $_GET['tab'] ) );
		$current_tab = empty( $tabs_data ) ? /* translators: About. */ esc_html('about','edsbootstrap') : $tabs_data;

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'edsbootstrap' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'edsbootstrap' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php /* translators: %s: plugin name. */ esc_html_e( 'Customize', 'edsbootstrap' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'edsbootstrap' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our support forum.', 'edsbootstrap' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://edatastyle.com/dwqa-questions/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'edsbootstrap' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'edsbootstrap' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'edsbootstrap' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://edatastyle.com/product/eds-bootstrap-wp' ); ?>" class="button button-secondary"><?php esc_html_e( 'Info about PRO version', 'edsbootstrap' ); ?></a></p>
					</div>

					
				</div>
			</div>

			<div class="return-to-dashboard cresta">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'edsbootstrap' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'edsbootstrap' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'edsbootstrap' ) : esc_html_e( 'Go to Dashboard', 'edsbootstrap' ); ?></a>
			</div>
		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'edsbootstrap' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'edsbootstrap_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'edsbootstrap' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'edsbootstrap'); ?></h3></th>
						<th width="25%"><h3><?php esc_html_e('edsbootstrap', 'edsbootstrap'); ?></h3></th>
						<th width="25%"><h3><?php esc_html_e('edsbootstrap PRO', 'edsbootstrap'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
                	<tr>
						<td><h3><?php esc_html_e('24/7 Priority Support', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Navigation Style', 'edsbootstrap'); ?></h3></td>
						<td>1</td>
						<td>3</td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Navigation Color', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Responsive Design', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h3><?php esc_html_e('4 Post format', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Change Background', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Unlimited Text Color', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Logo Upload', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Choose Social Icon ', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('jQuery Lightbox Popup ', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
                    
                    
					<tr>
						<td><h3><?php esc_html_e('Slider,Video & Image, Header Parallax  (Welcome section)', 'edsbootstrap'); ?></h3></td>
						<td><?php esc_html_e(' Slider only ', 'edsbootstrap'); ?></td>
						<td><?php esc_html_e('All', 'edsbootstrap'); ?></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('Extended Theme Options Panel', 'edsbootstrap'); ?></h3></td>
						<td><?php esc_html_e('Customizer', 'edsbootstrap'); ?></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Styling for all sections', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('Google Fonts Supported (500+ Fonts)', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Homepage Sections', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Welcome Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Brands/Service/offer Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Features Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Projects Grid Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Portfolio Grid Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Testimonials Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Team Members Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Call-to-Action 1 Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Call-to-Action 2 Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('About Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Skills Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e(' Latest Posts Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('Related Posts Box', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Contact Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('Page Layout Style', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Page Layout Style', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Blog Layout Style', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Blog Gird Style', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e('Breadcrumb', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('6+ Shortcodes', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h3><?php esc_html_e('10+ Shortcodes', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h3><?php esc_html_e(' Font switcher', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                   
                    
                      <tr>
						<td><h3><?php esc_html_e('  Footer/Copyright Section', 'edsbootstrap'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                  
                    
                    
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'edsbootstrap_pro_theme_url', 'https://edatastyle.com/demo/' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View PRO version demo', 'edsbootstrap' ); ?></a>
							<a href="<?php echo esc_url( apply_filters( 'edsbootstrap_pro_theme_url', 'https://edatastyle.com/product/eds-bootstrap-wp' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'More Information', 'edsbootstrap' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new EdsBootstrap_Admin();
