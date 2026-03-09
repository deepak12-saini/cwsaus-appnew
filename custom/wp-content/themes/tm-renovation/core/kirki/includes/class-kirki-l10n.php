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
		protected $textdomain = 'kirki';

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
				'background-color'      => esc_attr__( 'Background Color', 'tm-renovation' ),
				'background-image'      => esc_attr__( 'Background Image', 'tm-renovation' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'tm-renovation' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'tm-renovation' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'tm-renovation' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'tm-renovation' ),
				'inherit'               => esc_attr__( 'Inherit', 'tm-renovation' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'tm-renovation' ),
				'cover'                 => esc_attr__( 'Cover', 'tm-renovation' ),
				'contain'               => esc_attr__( 'Contain', 'tm-renovation' ),
				'background-size'       => esc_attr__( 'Background Size', 'tm-renovation' ),
				'fixed'                 => esc_attr__( 'Fixed', 'tm-renovation' ),
				'scroll'                => esc_attr__( 'Scroll', 'tm-renovation' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'tm-renovation' ),
				'left-top'              => esc_attr__( 'Left Top', 'tm-renovation' ),
				'left-center'           => esc_attr__( 'Left Center', 'tm-renovation' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'tm-renovation' ),
				'right-top'             => esc_attr__( 'Right Top', 'tm-renovation' ),
				'right-center'          => esc_attr__( 'Right Center', 'tm-renovation' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'tm-renovation' ),
				'center-top'            => esc_attr__( 'Center Top', 'tm-renovation' ),
				'center-center'         => esc_attr__( 'Center Center', 'tm-renovation' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'tm-renovation' ),
				'background-position'   => esc_attr__( 'Background Position', 'tm-renovation' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'tm-renovation' ),
				'on'                    => esc_attr__( 'ON', 'tm-renovation' ),
				'off'                   => esc_attr__( 'OFF', 'tm-renovation' ),
				'all'                   => esc_attr__( 'All', 'tm-renovation' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'tm-renovation' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'tm-renovation' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'tm-renovation' ),
				'greek'                 => esc_attr__( 'Greek', 'tm-renovation' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'tm-renovation' ),
				'khmer'                 => esc_attr__( 'Khmer', 'tm-renovation' ),
				'latin'                 => esc_attr__( 'Latin', 'tm-renovation' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'tm-renovation' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'tm-renovation' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'tm-renovation' ),
				'arabic'                => esc_attr__( 'Arabic', 'tm-renovation' ),
				'bengali'               => esc_attr__( 'Bengali', 'tm-renovation' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'tm-renovation' ),
				'tamil'                 => esc_attr__( 'Tamil', 'tm-renovation' ),
				'telugu'                => esc_attr__( 'Telugu', 'tm-renovation' ),
				'thai'                  => esc_attr__( 'Thai', 'tm-renovation' ),
				'serif'                 => _x( 'Serif', 'font style', 'tm-renovation' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'tm-renovation' ),
				'monospace'             => _x( 'Monospace', 'font style', 'tm-renovation' ),
				'font-family'           => esc_attr__( 'Font Family', 'tm-renovation' ),
				'font-size'             => esc_attr__( 'Font Size', 'tm-renovation' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'tm-renovation' ),
				'line-height'           => esc_attr__( 'Line Height', 'tm-renovation' ),
				'font-style'            => esc_attr__( 'Font Style', 'tm-renovation' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'tm-renovation' ),
				'top'                   => esc_attr__( 'Top', 'tm-renovation' ),
				'bottom'                => esc_attr__( 'Bottom', 'tm-renovation' ),
				'left'                  => esc_attr__( 'Left', 'tm-renovation' ),
				'right'                 => esc_attr__( 'Right', 'tm-renovation' ),
				'center'                => esc_attr__( 'Center', 'tm-renovation' ),
				'justify'               => esc_attr__( 'Justify', 'tm-renovation' ),
				'color'                 => esc_attr__( 'Color', 'tm-renovation' ),
				'add-image'             => esc_attr__( 'Add Image', 'tm-renovation' ),
				'change-image'          => esc_attr__( 'Change Image', 'tm-renovation' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'tm-renovation' ),
				'add-file'              => esc_attr__( 'Add File', 'tm-renovation' ),
				'change-file'           => esc_attr__( 'Change File', 'tm-renovation' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'tm-renovation' ),
				'remove'                => esc_attr__( 'Remove', 'tm-renovation' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'tm-renovation' ),
				'variant'               => esc_attr__( 'Variant', 'tm-renovation' ),
				'subsets'               => esc_attr__( 'Subset', 'tm-renovation' ),
				'size'                  => esc_attr__( 'Size', 'tm-renovation' ),
				'height'                => esc_attr__( 'Height', 'tm-renovation' ),
				'spacing'               => esc_attr__( 'Spacing', 'tm-renovation' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'tm-renovation' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'tm-renovation' ),
				'light'                 => esc_attr__( 'Light 200', 'tm-renovation' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'tm-renovation' ),
				'book'                  => esc_attr__( 'Book 300', 'tm-renovation' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'tm-renovation' ),
				'regular'               => esc_attr__( 'Normal 400', 'tm-renovation' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'tm-renovation' ),
				'medium'                => esc_attr__( 'Medium 500', 'tm-renovation' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'tm-renovation' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'tm-renovation' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'tm-renovation' ),
				'bold'                  => esc_attr__( 'Bold 700', 'tm-renovation' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'tm-renovation' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'tm-renovation' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'tm-renovation' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'tm-renovation' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'tm-renovation' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'tm-renovation' ),
				'add-new'           	=> esc_attr__( 'Add new', 'tm-renovation' ),
				'row'           		=> esc_attr__( 'row', 'tm-renovation' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'tm-renovation' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'tm-renovation' ),
				'back'                  => esc_attr__( 'Back', 'tm-renovation' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'tm-renovation' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'tm-renovation' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'tm-renovation' ),
				'none'                  => esc_attr__( 'None', 'tm-renovation' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'tm-renovation' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'tm-renovation' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'tm-renovation' ),
				'initial'               => esc_attr__( 'Initial', 'tm-renovation' ),
				'select-page'           => esc_attr__( 'Select a Page', 'tm-renovation' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'tm-renovation' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'tm-renovation' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'tm-renovation' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'tm-renovation' ),
			);

			// Apply global changes from the kirki/config filter.
			// This is generally to be avoided.
			// It is ONLY provided here for backwards-compatibility reasons.
			// Please use the kirki/{$config_id}/l10n filter instead.
			$config = apply_filters( 'kirki/config', array() );
			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			// Apply l10n changes using the kirki/{$config_id}/l10n filter.
			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
