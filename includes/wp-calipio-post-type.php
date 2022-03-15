<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_calipio_register_post_types() {
	
	// Calipio Screen Recorder Post Type Labels 
	$labels = array(
				    'name'			=> __('Calipio', 'wpcalipio'),
				    'singular_name' 	=> __('Add Recorder Button', 'wpcalipio'),
				    'add_new' 			=> __('Add Recorder Button', 'wpcalipio'),
				    'add_new_item' 		=> __('New Recorder Button', 'wpcalipio'),
				    'edit_item' 		=> __('Edit Recorder Button', 'wpcalipio'),
				    'new_item' 		=> __('New Recorder Button', 'wpcalipio'),
				    'all_items' 		=> __('Recorder Button', 'wpcalipio'),
				    'view_item' 		=> __('View Recorder Button', 'wpcalipio'),
				    'search_items' 		=> __('Search Recorder Button', 'wpcalipio'),
				    'not_found' 		=> __('No Recorder Button found', 'wpcalipio'),
				    'not_found_in_trash' => __('No Recorder Button found in Trash', 'wpcalipio'),
				    'parent_item_colon'  => '',
				    'menu_name' 		=> __('Calipio', 'wpcalipio'),
				);
	// Calipio Screen Recorder Post Type Args
	$args = array(
			    'labels'			=> $labels,
			    'public'			=> false,
			    'publicly_queryable'	=> false,
			    'show_ui'			=> true, 
			    'show_in_menu'		=> true, 
			    'query_var'		=> true,
			    'rewrite'			=> array( 'slug' => WP_CALIPIO_POST_TYPE ),
			    'capability_type'	=> 'post',
			    'map_meta_cap'		=> true,
			    'has_archive'		=> true, 
			    'hierarchical'		=> false,
			    'supports'			=> array( 'title', 'author', ),
			    'menu_icon'          => WP_CALIPIO_INC_URL.'/images/Calipio.png',			    
		  );
	// Register Calipio Screen Recorder Post Type
	register_post_type( WP_CALIPIO_POST_TYPE, $args );
}
add_action( 'init', 'wp_calipio_register_post_types' );