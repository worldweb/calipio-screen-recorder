<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortcode Class
 *
 * Handles shortcod functionality to the plugin
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */

if( !class_exists( 'Wp_Calipio_Shortcode' ) ) {
     
     class Wp_Calipio_Shortcode {

     	//class constructor
     	function __construct() {

     	}

     	public function wp_calipio_record_shortcode_render( $atts, $content ) {

               if( !empty( $atts['id'] ) ) {

                    $post_id = $atts['id'];
                    $_wp_calipio_token 		= get_post_meta( $post_id, '_wp_calipio_token',true );
                    $_wp_calipio_screen 	= get_post_meta( $post_id, '_wp_calipio_screen',true );
                    $_wp_calipio_camera 	= get_post_meta( $post_id, '_wp_calipio_camera',true );
                    $_wp_calipio_microphone 	= get_post_meta( $post_id, '_wp_calipio_microphone',true );
                    $_wp_calipio_startmode 	= get_post_meta( $post_id, '_wp_calipio_startmode',true );
                    $_wp_calipio_endmode 	= get_post_meta( $post_id, '_wp_calipio_endmode',true );
                    $_wp_calipio_hidepopup 	= get_post_meta( $post_id, '_wp_calipio_hidepopup',true );
                    $_wp_calipio_customcode 	= get_post_meta( $post_id, '_wp_calipio_customcode',true );
                    $_wp_calipio_pre_select_screen  = get_post_meta($post_id, '_wp_calipio_pre_select_screen',true);
                    $_wp_calipio_pre_select_camera  = get_post_meta($post_id, '_wp_calipio_pre_select_camera',true);
                    $_wp_calipio_pre_select_mic 	  = get_post_meta($post_id, '_wp_calipio_pre_select_mic',true);

                    if( empty( $_wp_calipio_hidepopup ) ) {
                         $_wp_calipio_hidepopup = array();
                    }

                    $allowedsources = $mandatorysources = $selectedsources = "";

                    if( $_wp_calipio_screen == "allowed" ) {
                         $allowedsources .= "screen ";
                    } elseif($_wp_calipio_screen == "mandatory"){
                         $allowedsources .= "screen ";
                         $mandatorysources .= "screen ";
                         $selectedsources .= "screen ";
                    }

                    if( $_wp_calipio_camera == "allowed"){
                         $allowedsources .= "camera ";
                    }elseif($_wp_calipio_camera == "mandatory"){
                         $allowedsources .= "camera ";
                         $mandatorysources .= "camera ";
                         $selectedsources .= "camera ";
                    }

                    if($_wp_calipio_microphone == "allowed"){
                         $allowedsources .= "microphone ";
                    }elseif($_wp_calipio_microphone == "mandatory"){
                         $allowedsources .= "microphone ";
                         $mandatorysources .= "microphone ";
                         $selectedsources .= "microphone ";
                    }

                    if(!empty($_wp_calipio_pre_select_screen)){
                         $selectedsources .= "screen ";
                    }
                    if(!empty($_wp_calipio_pre_select_camera)){
                         $selectedsources .= "camera ";
                    }
                    if(!empty($_wp_calipio_pre_select_mic)){
                         $selectedsources .= "microphone ";
                    }

                    wp_enqueue_script( 'wp-calipio-recorder', 'https://calipio.com/app/embeddable-recorder.js', array(), WP_CALIPIO_VERSION, true );

                    ob_start();
                    ?>
                         <calipio-recorder token="<?php echo esc_attr($_wp_calipio_token); ?>" allowedsources="<?php echo esc_attr($allowedsources); ?>" mandatorysources="<?php echo esc_attr($mandatorysources); ?>" selectedsources="<?php echo esc_attr($selectedsources); ?>" startmode="<?php echo esc_attr($_wp_calipio_startmode); ?>" endmode="<?php echo esc_attr($_wp_calipio_endmode); ?>" hidepopupwhile="<?php echo esc_attr(implode(" ",$_wp_calipio_hidepopup)); ?>" <?php echo !empty( $_wp_calipio_customcode )? ' onrecordingended="'.esc_attr($_wp_calipio_customcode).'"' : ''; ?> ></calipio-recorder>
                    <?php
                    $html = ob_get_clean();
               }

               return $html . $content;
     	}

     	/**
     	 * Adding Hooks
     	 *
     	 * @package Calipio Screen Recorder
     	 * @since 1.0.0
     	 */
     	function add_hooks() {

               // Calipio Recorder button shortcode
     		add_shortcode( 'calipio-record', array( $this, 'wp_calipio_record_shortcode_render' ) );
     	}
     }
}