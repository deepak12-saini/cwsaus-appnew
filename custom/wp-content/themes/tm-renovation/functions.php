<?php
/**
 * Define Constants
 * ================
 *
 * @since 3.0
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'TM_RENOVATION_THEME_NAME', $theme['Name'] );
define( 'TM_RENOVATION_THEME_SLUG', $theme['Template'] );
define( 'TM_RENOVATION_THEME_VERSION', $theme['Version'] );

define( 'TM_RENOVATION_DIR', get_template_directory() );
define( 'TM_RENOVATION_URI', get_template_directory_uri() );

define( 'TM_RENOVATION_INC_DIR', TM_RENOVATION_DIR . DS . 'inc' );

define( 'TM_RENOVATION_CUSTOMIZER_DIR', TM_RENOVATION_INC_DIR . DS . 'customizer' );
define( 'TM_RENOVATION_SETUP_DIR', TM_RENOVATION_CUSTOMIZER_DIR . DS . 'setups' );

define( 'TM_RENOVATION_CORE_DIR', TM_RENOVATION_DIR . DS . 'core' );
define( 'TM_RENOVATION_FW_DIR', TM_RENOVATION_CORE_DIR . DS . 'framework' );
/**
 * Load Core
 *
 * @since 3.0
 */
require_once( TM_RENOVATION_CORE_DIR . '/kirki/kirki.php' );


/**
 * Load Framework
 *
 * @since 3.0
 */
require_once( TM_RENOVATION_FW_DIR . DS . 'class-compatible.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-enqueue.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-extras.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-init.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-import.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-helper.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-metabox.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-preset.php' );
require_once( TM_RENOVATION_FW_DIR . DS . 'class-templates.php' );

if ( class_exists( 'WooCommerce' ) ) {
	require_once( TM_RENOVATION_FW_DIR . DS . 'class-woo.php' );
}

// Extend VC
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
	require_once( TM_RENOVATION_FW_DIR . DS . 'class-vc.php' );
}

if ( class_exists( 'Projects_Admin' ) ) {
	require_once( TM_RENOVATION_FW_DIR . DS . 'class-project.php' );
}

/**
 * Include customizer
 *
 * @since 3.0
 */
require_once TM_RENOVATION_INC_DIR . '/customizer/customizer.php';

// TGM
require_once TM_RENOVATION_INC_DIR . '/tgm-plugin-activation.php';
require_once TM_RENOVATION_INC_DIR . '/tgm-plugin-registration.php';