<?php
/**
 * Esteem Admin Class.
 *
 * @author  ThemeGrill
 * @package esteem
 * @since   1.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Esteem_Admin' ) ) :

/**
 * Esteem_Admin Class.
 */
class Esteem_Admin {

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

		$page = add_theme_page( esc_html__( 'About', 'esteem' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'esteem' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'esteem-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		global $esteem_version;

		wp_enqueue_style( 'esteem-welcome', get_template_directory_uri() . '/css/admin/welcome.css', array(), $esteem_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $esteem_version, $pagenow;

		wp_enqueue_style( 'esteem-message', get_template_directory_uri() . '/css/admin/message.css', array(), $esteem_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'esteem_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'esteem_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['esteem-hide-notice'] ) && isset( $_GET['_esteem_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_esteem_notice_nonce'], 'esteem_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'esteem' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'esteem' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['esteem-hide-notice'] );
			update_option( 'esteem_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated esteem-message">
			<a class="esteem-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'esteem-hide-notice', 'welcome' ) ), 'esteem_hide_notices_nonce', '_esteem_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'esteem' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing Esteem! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'esteem' ), '<a href="' . esc_url( admin_url( 'themes.php?page=esteem-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=esteem-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Esteem', 'esteem' ); ?></a>
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
		global $esteem_version;

		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $esteem_version, 0, 3 );
		?>
		<div class="esteem-theme-info">
			<h1>
				<?php esc_html_e('About', 'esteem'); ?>
				<?php echo $theme->display( 'Name' ); ?>
				<?php printf( '%s', $major_version ); ?>
			</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="esteem-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="esteem-actions">
			<a href="<?php echo esc_url( 'http://themegrill.com/themes/esteem/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'esteem' ); ?></a>

			<a href="<?php echo esc_url( 'http://demo.themegrill.com/esteem/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'esteem' ); ?></a>

			<a href="<?php echo esc_url( 'http://themegrill.com/themes/esteem-pro/' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'esteem' ); ?></a>

			<a href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/esteem?filter=5#postform' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'esteem' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'esteem-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'esteem-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'esteem-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Supported Plugins', 'esteem' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'esteem-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'esteem' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'esteem-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'esteem' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

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
						<h3><?php esc_html_e( 'Theme Customizer', 'esteem' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'esteem' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'esteem' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'esteem' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'esteem' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://docs.themegrill.com/esteem/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'esteem' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'esteem' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'esteem' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support Forum', 'esteem' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'esteem' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'esteem' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/themes/esteem-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View Pro', 'esteem' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got sales related question?', 'esteem' ); ?></h3>
						<p><?php esc_html_e( 'Please send it via our sales contact page.', 'esteem' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/contact/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Contact Page', 'esteem' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'esteem' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'esteem' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/esteem' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'esteem' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard esteem">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'esteem' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'esteem' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'esteem' ) : esc_html_e( 'Go to Dashboard', 'esteem' ); ?></a>
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

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'esteem' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'esteem_changelog_file', get_template_directory() . '/readme.txt' );

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
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'esteem' ); ?></p>
			<ol>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>" target="_blank"><?php esc_html_e( 'Social Icons', 'esteem' ); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'esteem'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>" target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'esteem' ); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'esteem'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>" target="_blank"><?php esc_html_e( 'Contact Form 7', 'esteem' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>" target="_blank"><?php esc_html_e( 'WP-PageNavi', 'esteem' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/breadcrumb-navxt/' ); ?>" target="_blank"><?php esc_html_e( 'Breadcrumb NavXT', 'esteem' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>" target="_blank"><?php esc_html_e( 'WooCommerce', 'esteem' ); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'esteem'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>" target="_blank"><?php esc_html_e( 'Polylang', 'esteem' ); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'esteem'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wpml.org/' ); ?>" target="_blank"><?php esc_html_e( 'WPML', 'esteem' ); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'esteem'); ?>
				</li>
			</ol>

		</div>
		<?php
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'esteem' ); ?></p>

			<table>
                <thead>
                    <tr>
                        <th class="table-feature-title"><h3><?php esc_html_e('Features', 'esteem'); ?></h3></th>
                        <th><h3><?php esc_html_e('Esteem', 'esteem'); ?></h3></th>
                        <th><h3><?php esc_html_e('Esteem Pro', 'esteem'); ?></h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h3><?php esc_html_e('Slider', 'esteem'); ?></h3></td>
                        <td><?php esc_html_e('4', 'esteem'); ?></td>
                        <td><?php esc_html_e('Unlimited Slides', 'esteem'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Google Fonts Option', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('600+', 'esteem'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Font Size options', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Primary Color', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Multiple Color Options', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('35+ color options', 'esteem'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Additional Top Header', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('Social Icons + Menu + Header text option', 'esteem'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social Icons', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Boxed & Wide layout option', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Content Demo', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('WP-PageNavi Compatible', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Breadcrumb NavXT Compatible', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Woocommerce Compatible', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Translation Ready', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('RTL Support', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('WPML Compatible', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Polylang Compatible', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Footer Widget Area', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Footer Copyright Editor', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Support', 'esteem'); ?></h3></td>
                        <td><?php esc_html_e('Forum', 'esteem'); ?></td>
                        <td><?php esc_html_e('Forum + Emails/Support Ticket', 'esteem'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Services widget', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Call to Action widget', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Featured widget', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Testimonial', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Featured Posts', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Our Clients', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Pricing Table', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Team', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('TG: Fun Facts', 'esteem'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'esteem_pro_theme_url', 'http://themegrill.com/themes/esteem/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php _e( 'View Pro', 'esteem' ); ?></a>
						</td>
					</tr>
                </tbody>
            </table>

		</div>
		<?php
	}
}

endif;

return new Esteem_Admin();
