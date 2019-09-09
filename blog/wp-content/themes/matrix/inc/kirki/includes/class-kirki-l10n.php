<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'matrix';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'matrix' ),
				'background-image'      => esc_attr__( 'Background Image', 'matrix' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'matrix' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'matrix' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'matrix' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'matrix' ),
				'inherit'               => esc_attr__( 'Inherit', 'matrix' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'matrix' ),
				'cover'                 => esc_attr__( 'Cover', 'matrix' ),
				'contain'               => esc_attr__( 'Contain', 'matrix' ),
				'background-size'       => esc_attr__( 'Background Size', 'matrix' ),
				'fixed'                 => esc_attr__( 'Fixed', 'matrix' ),
				'scroll'                => esc_attr__( 'Scroll', 'matrix' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'matrix' ),
				'left-top'              => esc_attr__( 'Left Top', 'matrix' ),
				'left-center'           => esc_attr__( 'Left Center', 'matrix' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'matrix' ),
				'right-top'             => esc_attr__( 'Right Top', 'matrix' ),
				'right-center'          => esc_attr__( 'Right Center', 'matrix' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'matrix' ),
				'center-top'            => esc_attr__( 'Center Top', 'matrix' ),
				'center-center'         => esc_attr__( 'Center Center', 'matrix' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'matrix' ),
				'background-position'   => esc_attr__( 'Background Position', 'matrix' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'matrix' ),
				'on'                    => esc_attr__( 'ON', 'matrix' ),
				'off'                   => esc_attr__( 'OFF', 'matrix' ),
				'all'                   => esc_attr__( 'All', 'matrix' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'matrix' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'matrix' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'matrix' ),
				'greek'                 => esc_attr__( 'Greek', 'matrix' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'matrix' ),
				'khmer'                 => esc_attr__( 'Khmer', 'matrix' ),
				'latin'                 => esc_attr__( 'Latin', 'matrix' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'matrix' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'matrix' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'matrix' ),
				'arabic'                => esc_attr__( 'Arabic', 'matrix' ),
				'bengali'               => esc_attr__( 'Bengali', 'matrix' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'matrix' ),
				'tamil'                 => esc_attr__( 'Tamil', 'matrix' ),
				'telugu'                => esc_attr__( 'Telugu', 'matrix' ),
				'thai'                  => esc_attr__( 'Thai', 'matrix' ),
				'serif'                 => _x( 'Serif', 'font style', 'matrix' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'matrix' ),
				'monospace'             => _x( 'Monospace', 'font style', 'matrix' ),
				'font-family'           => esc_attr__( 'Font Family', 'matrix' ),
				'font-size'             => esc_attr__( 'Font Size', 'matrix' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'matrix' ),
				'line-height'           => esc_attr__( 'Line Height', 'matrix' ),
				'font-style'            => esc_attr__( 'Font Style', 'matrix' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'matrix' ),
				'top'                   => esc_attr__( 'Top', 'matrix' ),
				'bottom'                => esc_attr__( 'Bottom', 'matrix' ),
				'left'                  => esc_attr__( 'Left', 'matrix' ),
				'right'                 => esc_attr__( 'Right', 'matrix' ),
				'center'                => esc_attr__( 'Center', 'matrix' ),
				'justify'               => esc_attr__( 'Justify', 'matrix' ),
				'color'                 => esc_attr__( 'Color', 'matrix' ),
				'add-image'             => esc_attr__( 'Add Image', 'matrix' ),
				'change-image'          => esc_attr__( 'Change Image', 'matrix' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'matrix' ),
				'add-file'              => esc_attr__( 'Add File', 'matrix' ),
				'change-file'           => esc_attr__( 'Change File', 'matrix' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'matrix' ),
				'remove'                => esc_attr__( 'Remove', 'matrix' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'matrix' ),
				'variant'               => esc_attr__( 'Variant', 'matrix' ),
				'subsets'               => esc_attr__( 'Subset', 'matrix' ),
				'size'                  => esc_attr__( 'Size', 'matrix' ),
				'height'                => esc_attr__( 'Height', 'matrix' ),
				'spacing'               => esc_attr__( 'Spacing', 'matrix' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'matrix' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'matrix' ),
				'light'                 => esc_attr__( 'Light 200', 'matrix' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'matrix' ),
				'book'                  => esc_attr__( 'Book 300', 'matrix' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'matrix' ),
				'regular'               => esc_attr__( 'Normal 400', 'matrix' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'matrix' ),
				'medium'                => esc_attr__( 'Medium 500', 'matrix' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'matrix' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'matrix' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'matrix' ),
				'bold'                  => esc_attr__( 'Bold 700', 'matrix' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'matrix' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'matrix' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'matrix' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'matrix' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'matrix' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'matrix' ),
				'add-new'           	=> esc_attr__( 'Add new', 'matrix' ),
				'row'           		=> esc_attr__( 'row', 'matrix' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'matrix' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'matrix' ),
				'back'                  => esc_attr__( 'Back', 'matrix' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'matrix' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'matrix' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'matrix' ),
				'none'                  => esc_attr__( 'None', 'matrix' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'matrix' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'matrix' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'matrix' ),
				'initial'               => esc_attr__( 'Initial', 'matrix' ),
				'select-page'           => esc_attr__( 'Select a Page', 'matrix' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'matrix' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'matrix' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'matrix' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'matrix' ),
			);

			$config = apply_filters( 'kirki/config', array() );

			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
