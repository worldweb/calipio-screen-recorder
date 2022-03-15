<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */

if( !class_exists( 'Wp_Calipio_Scripts' ) ) {
	
	class Wp_Calipio_Scripts {

		//class constructor
		function __construct() {
			
		}
		
		/**
		 * Enqueue Scripts on Admin Side
		 * 
		 * @package Calipio Screen Recorder
		 * @since 1.0.0
		 */
		public function wp_calipio_admin_scripts( $hooks_suffix ) {

			global $post;		
			
			if( !empty($post->post_type) && $post->post_type == WP_CALIPIO_POST_TYPE ) {
				wp_register_style( 'wp-calipio-admin-style', WP_CALIPIO_INC_URL . '/css/wp-calipio-admin.css', array(), WP_CALIPIO_VERSION );
				wp_enqueue_style( 'wp-calipio-admin-style' );

				wp_register_script( 'wp-calipio-admin-script', WP_CALIPIO_INC_URL . '/js/wp-calipio-admin.js', array('jquery'), WP_CALIPIO_VERSION, TRUE );
				wp_localize_script( 'wp-calipio-admin-script', 'CALIPIO', array( 
						'alert_msg' => __('You have to select one source (screen, camera or microphone) at least (either allowed or mandatory)','wpcalipio')
					) );
				wp_enqueue_script( 'wp-calipio-admin-script');
			}
		}
		
		/**
		 * Adding Hooks
		 *
		 * Adding hooks for the styles and scripts.
		 *
		 * @package Calipio Screen Recorder
		 * @since 1.0.0
		 */
		function add_hooks() {
			
			//add admin scripts
			add_action('admin_enqueue_scripts', array($this, 'wp_calipio_admin_scripts'));
		}
	}
}