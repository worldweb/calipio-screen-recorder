<?php
/**
 * Plugin Name: Calipio Screen Recorder
 * Description: Provide an instant Screen Recording option on your webpage. Without registration, just in your user’s browser, on all platforms.
 * Version: 1.0.0
 * Author: Calipio
 * Author URI: https://calipio.com/
 * Text Domain: wpcalipio
 * Domain Path: languages
 * 
 * @package Calipio Screen Recorder
 * @category Core
 * @author Calipio
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Define Some needed predefined variables 
 * 
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */
if( !defined( 'WP_CALIPIO_VERSION' ) ) {
	define( 'WP_CALIPIO_VERSION', '1.0.0' ); //version of plugin
}
if (!defined('WP_CALIPIO_TEXT_DOMAIN')) { // text domain
	define( 'WP_CALIPIO_TEXT_DOMAIN', 'wpcalipio' ); //this is for multi language support
}
if( !defined( 'WP_CALIPIO_DIR' ) ) {
	define( 'WP_CALIPIO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_CALIPIO_URL' ) ) {
	define( 'WP_CALIPIO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_CALIPIO_INC_DIR' ) ) {
	define( 'WP_CALIPIO_INC_DIR', WP_CALIPIO_DIR.'/includes' ); // Plugin include dir
}
if( !defined( 'WP_CALIPIO_INC_URL' ) ) {
	define( 'WP_CALIPIO_INC_URL', WP_CALIPIO_URL.'includes' ); // Plugin include url
}
if( !defined( 'WP_CALIPIO_ADMIN_DIR' ) ) {
	define( 'WP_CALIPIO_ADMIN_DIR', WP_CALIPIO_INC_DIR.'/admin' ); // Plugin admin dir
}
if( !defined( 'WP_CALIPIO_PREFIX' ) ) {
	define( 'WP_CALIPIO_PREFIX', 'WP_Calipio' ); // Plugin Prefix
}
if( !defined( 'WP_CALIPIO_POST_TYPE' ) ) {
	define('WP_CALIPIO_POST_TYPE', 'wp_calipio' ); //Post Type for Wp Calipio
}
if( !defined( 'WP_CALIPIO_BASENAME' ) ) {
	define( 'WP_CALIPIO_BASENAME', basename( WP_CALIPIO_DIR ) ); // base name
}

// Registring Post type functionality
require_once( WP_CALIPIO_INC_DIR . '/wp-calipio-post-type.php' );

/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 **/
function wp_calipio_load_plugin_textdomain() {

	// Set filter for plugin's languages directory
	$wp_c_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_c_lang_dir	= apply_filters( 'wp_calipio_languages_directory', $wp_c_lang_dir );
	
	// Traditional WordPress plugin locale filter
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wpcalipio' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wpcalipio', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $wp_c_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . WP_CALIPIO_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/wp-calipio folder
		load_textdomain( 'wpcalipio', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { // Look in local /wp-content/plugins/wp-calipio/languages/ folder
		load_textdomain( 'wpcalipio', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'wpcalipio', false, $wp_c_lang_dir );
	}
}
add_action( 'plugins_loaded', 'wp_calipio_load_plugin_textdomain' );

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */
function wp_calipio_install() {

	// call your CPT registration function here
    wp_calipio_register_post_types();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wp_calipio_install' );

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */
function wp_calipio_uninstall() {

}
register_deactivation_hook( __FILE__, 'wp_calipio_uninstall');

// Global variables
global $wp_calipio_scripts, $wp_calipio_admin, $wp_calipio_shortcode;

// Script class handles most of script functionalities of plugin
include_once( WP_CALIPIO_INC_DIR . '/class-wp-calipio-scripts.php' );
$wp_calipio_scripts = new Wp_Calipio_Scripts();
$wp_calipio_scripts->add_hooks();

// Admin class handles most of admin panel functionalities of plugin
include_once( WP_CALIPIO_ADMIN_DIR . '/class-wp-calipio-admin.php' );
$wp_calipio_admin = new Wp_Calipio_Admin();
$wp_calipio_admin->add_hooks();

// Shortcode class handles shortcod functionalities of plugin
include_once( WP_CALIPIO_INC_DIR . '/class-wp-calipio-shortcode.php' );
$wp_calipio_shortcode = new Wp_Calipio_Shortcode();
$wp_calipio_shortcode->add_hooks();